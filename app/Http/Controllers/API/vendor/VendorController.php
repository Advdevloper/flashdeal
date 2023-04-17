<?php

namespace App\Http\Controllers\API\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Vendor;
use App\Models\Vendordetail;
use App\Models\Vendordocument;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;

class VendorController extends BaseController
{

  public function vendor_sign_in(Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($request->all(), [
      'email'    => 'required|email',
      'password' => 'required',

    ]);
    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }
    $email_match = DB::table('users')->where('email', $request->email)->first();
    if ($email_match == '') {
      return $this->sendError('email required', ['error' => 'user not match']);
      die();
    }
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      $user = Auth::user();
      $success['token'] = $user->createToken("API TOKEN")->plainTextToken;

      $id = $user->id;

      $data = Vendordetail::where('vendor_userid', $id)->first();
      $vanor_id = $data->id;
      $data['image'] = Vendordocument::where('vendordetails_id', $vanor_id)->get();
      // return $this->sendResponse(new Vendor( $success), 'vendor login successfully.');

      return $this->sendResponse($data, 'vendor login successfully.');
      die();
    } else {
      return $this->sendError('Unauthorised.', ['error' => 'doess not exist']);
      die();
    }
  }

  //================ SIGN UP====================//
  public function vendor_ragister(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'vendor_firstname' => 'required',
      'vendor_lastname' => 'required',
      'vendor_businessname' => 'required',
      'vendor_email' => 'required|email',
      'vendor_mobile' => 'required',
      'vendor_country' => 'required',
      'vendor_state' => 'required',
      'vendor_address'    => 'required',
      'vendor_images' => 'required',

    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }
    $vendor_firstname = $request->input('vendor_firstname');
    $vendor_lastname = $request->input('vendor_lastname');
    $vendor_businessname = $request->input('vendor_businessname');
    $vendor_email = $request->input('vendor_email');
    $vendor_mobile = $request->input('vendor_mobile');
    $vendor_country = $request->input('vendor_country');
    $vendor_state = $request->input('vendor_state');
    $vendor_address = $request->input('vendor_address');
    $user = User::where('email', '=', $vendor_email)->first();
    $user_id = array(
      'user_id' => $user->id,
    );
    if ($user === null) {
      $data_user = array('name' => $vendor_firstname, 'last_name' => $vendor_lastname, 'email' => $vendor_email, 'phone_number' => $vendor_mobile, 'password' => Hash::make('Advantal@123'));
      $userDetail = User::create($data_user);
      $userID = $userDetail['id'];

      $email = $userDetail['email'];
      $vendodata = array(
        'vendor_firstname' => $vendor_firstname,
        'vendor_lastname' => $vendor_lastname,
        'vendor_businessname' => $vendor_businessname,
        'vendor_email' => $email,
        'vendor_mobile' => $vendor_mobile,
        'vendor_country' => $vendor_country,
        'vendor_state' => $vendor_state,
        'vendor_address' => $vendor_address,
        'vendor_status' => 0,
        'vendor_userid' => $userID,
      );
      $Vendor = Vendordetail::create($vendodata);
      $VendorID = $Vendor['id'];

      if ($request->file('vendor_images')) {
        $images = $request->file('vendor_images');
        foreach ($images as $single_image) {
          $imagePath = $request->file('vendor_images');
          $image = time() . '.' . $single_image->getClientOriginalName();
          $destinationPath = 'upload/vendors/';
          $single_image->move($destinationPath, $image);
          $save_url = $destinationPath . $image;
          $vendodata = array(
            'vendordetails_id' => $VendorID,
            'vendordetails_file' => $save_url,
          );
          $Vendor = Vendordocument::create($vendodata);
        }
      }

      $userUpdateData = array('vander_id' => $VendorID, 'role_type' => 2);
      $userUpdate = User::where('id', '=', $userID)->first();
      $userUpdate->fill($userUpdateData);
      if ($userUpdate->save()) {
        //  return $this->sendResponse(new Vendor($vendodata), 'vendor register successfully.');
        return response()->json(array('status' => 'true', 'data' => $user_id, 'message' => 'Vendor Register Successfully'));
        // return $this->sendResponse($vendodata, 'vendor register successfully');
      } else {
        return response()->json(array('status' => 'false', 'data' => '400', 'message' => 'Somthing went wrong'));
      }
    } else {
      $userID = $user['id'];
      $email = $user['email'];

      $validator = Validator::make($request->all(), [
        'vendor_email' => 'required|email|unique:vendordetails',
      ]);

      if ($validator->fails()) {
        return $this->sendError('Validation Error.', $validator->errors());
      }
      $vendodata = array(
        'vendor_firstname' => $vendor_firstname,
        'vendor_lastname' => $vendor_lastname,
        'vendor_businessname' => $vendor_businessname,
        'vendor_email' => $email,
        'vendor_mobile' => $vendor_mobile,
        'vendor_country' => $vendor_country,
        'vendor_state' => $vendor_state,
        'vendor_address' => $vendor_address,
        'vendor_status' => 0,
        'vendor_userid' => $userID,
      );
      $Vendor = Vendordetail::create($vendodata);
      $VendorID = $Vendor['id'];


      if ($request->file('vendor_images')) {
        $images = $request->file('vendor_images');
        foreach ($images as $single_image) {
          $imagePath = $request->file('vendor_images');
          $image = time() . '.' . $single_image->getClientOriginalName();
          $destinationPath = 'upload/vendors/';
          $single_image->move($destinationPath, $image);
          $save_url = $destinationPath . $image;
          $vendodata = array(
            'vendordetails_id' => $VendorID,
            'vendordetails_file' => $save_url,
          );
          $Vendor = Vendordocument::create($vendodata);
        }
      }
      $userUpdateData = array('vander_id' => $VendorID, 'role_type' => 2);
      $userUpdate = User::where('id', '=', $userID)->first();
      $userUpdate->fill($userUpdateData);
      if ($userUpdate->save()) {
        // return $this->sendResponse(new Vendor($vendodata), 'vendor register successfully.');
        return response()->json(array('status' => 'true', 'data' => $user_id, 'message' => 'vandor Register Successfully'));
        // return $this->sendResponse($vendodata, 'vendor register successfully');
      } else {
        return response()->json(array('status' => 'false', 'data' => '400', 'message' => 'Somthing went wrong'));
      }
    }
  }
  //================ vendor_forgot_password====================//
  public function vendor_forgot_password(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email'    => 'required',
    ]);
    $data = $request->all();
    $email = $request->email;
    $expire_time = Carbon::now()->format('Y-m-d H:s:i');
    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }
    $user = DB::table('users')->where('email', $email)->first();

    if ($user == '') {
      return $this->sendError('email not exist', ['error' => 'email not exist']);
      die();
    }

    $route = 'create-password';
    $random = Str::random(40);
    $domain = URL::to('/');
    $url = $domain . '/' . $route . '/' . $random;
    $name = $user->name;
    $user_id = $user->id;
    $from = env('MAIL_FROM_ADDRESS');
    $email =  $data['email'];
    $dataa = array('url' => $url, 'email' => $email, 'name' => $name, 'title' => 'forgot password', 'body' => 'please click here to below to verify mail.', 'from' => $from);

    Mail::send('mail.forgot-password', $dataa, function ($message) use ($dataa) {
      $message->to($dataa['email'])->subject('flashdealapp otp Mail');
      $message->from($dataa['from'], 'flashdealapp');
    });

    $user = User::where('id', $user_id)->update(['token' => $random, 'expire_time' => $expire_time]);
    if ($user) {
      return $this->sendResponse($name, 'your forgot password link hase been sent your mail.');
    } else {
      return $this->sendError('wrong.', ['error' => 'somthing Wrong']);
    }
  }

  // //================ vendor_profile====================//
  public function vendor_profile($id)
  {

    $data = Vendordetail::where('vendor_userid', $id)->first();
    $vanor_id = $data->id;
    $data['image'] = Vendordocument::where('vendordetails_id', $vanor_id)->get();
    if ($data) {
      return $this->sendResponse($data, 'vendor profile data get successfully');
      die();
    } else {
      return response()->json(array('status' => 'false', 'data' => '400', 'message' => 'Somthing went wrong'));
      die();
    }
  }
}
