<?php

namespace App\Http\Controllers\API\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Slider;
use App\Models\Vendordetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class CutomerController extends BaseController
{

  public function sign_in(Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($request->all(), [
      'email'    => 'required|email',
      'password' => 'required',
      'divice_token' => 'required',

    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }
    $email_match = DB::table('users')->where('email', $request->email)->first();
    if ($email_match == '') {
      return $this->sendError('email required', ['error' => 'email not match']);
      die();
    }

    $email_check = DB::table('users')->where('email', $request->email)->first();
    $verifyotp = $email_check->otp_verified;
    if ($verifyotp == '0') {
      return $this->sendError('dont verify.', ['error' => 'Please verify status']);
      die();
    }
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      $user = Auth::user();
      $success['access_token'] = $user->createToken("API TOKEN")->plainTextToken;
      $success['data'] =  $user;
      $email_check = DB::table('users')->where('email', $request->email)->update(['divice_token' => $data['divice_token']]);
      return $this->sendResponse($success, 'User login successfully.');
      die();
    } else {
      return $this->sendError('Unauthorised.', ['error' => 'doess not exist']);
      die();
    }
  }


  //================ SIGN UP====================//
  public function signup(Request $request)
  {
    $from = env('MAIL_FROM_ADDRESS');

    $data = $request->all();

    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'last_name' => 'required',
      'email'    => 'required|email|unique:users',
      'password' => 'required',
      'c_password' => 'required|same:password',
    ]);
    $otp = rand(1231, 7879);
    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $response_data['data'] = array('name' => $data['name'], 'last_name' => $data['last_name'], 'email' => $data['email'], 'phone_number' => $data['phone_number'], 'role_type' => '1', 'password' => bcrypt($data['password']), 'otp' => $otp);

    $data_user =   array('name' => $data['name'], 'last_name' => $data['last_name'], 'email' => $data['email'], 'phone_number' => $data['phone_number'], 'password' => bcrypt($data['password']), 'otp' => $otp);

    $user = User::create($data_user);
    $dataa = array('name' => $data['name'], 'email' => $data['email'], 'otp' => $otp, 'from' => $from);
    $email =  $data['email'];
    Mail::send('mail.verify-otp', $dataa, function ($message) use ($dataa) {
      $message->to($dataa['email'])->subject('flashdealapp otp Mail');
      $message->from($dataa['from'], 'flashdealapp');
    });
    $response_data['access_token'] = $user->createToken("API TOKEN")->plainTextToken;
    if ($user) {

      // return response()->json(array('status' => 'true', 'data' => $data_user, 'message' => 'User Register Successfully'));
      return $this->sendResponse($response_data, 'User register successfully. your otp hase been sent your mail');
      die();
    } else {

      return response()->json(array('status' => 'false', 'data' => '400', 'message' => 'Somthing went wrong'));

      die();
    }
  }

  //================ user_logout====================//
  public function user_logout()
  {
    dd('okay');
    //  Auth::user()->currentAccessToken()->delete();


  }


  //================ verify_otp====================//
  public function verify_otp(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'otp'    => 'required',
    ]);

    $otp = $request->otp;
    $email = $request->email;
    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }
    $user = DB::table('users')->where('email', $email)->first();

    if ($user == '') {
      return $this->sendError('user not exist', ['error' => ' user not exist']);
      die();
    }
    $verifyotp = $user->otp;
    $name = $user->name;
    $user_id = $user->id;
    if ($verifyotp == $otp) {
      $user = User::where('id', $user_id)->update(['otp_verified' => '1']);
      return $this->sendResponse($name, 'User verify successfully.');
    } else {
      return $this->sendError('wrong otp.', ['error' => 'Please fill the correct opt']);
      die();
    }
  }

  //================ resend_otp====================//
  public function resend_otp(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email'    => 'required',
    ]);
    $data = $request->all();
    $email = $request->email;
    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }
    $user = DB::table('users')->where('email', $email)->first();

    if ($user == '') {
      return $this->sendError('user not exist', ['error' => ' user not exist']);
      die();
    }
    $name = $user->name;
    $user_id = $user->id;
    $from = env('MAIL_FROM_ADDRESS');
    $otp = rand(1231, 7879);
    $dataa = array('name' => $name, 'email' => $data['email'], 'otp' => $otp, 'from' => $from);
    $email =  $data['email'];
    Mail::send('mail.verify-otp', $dataa, function ($message) use ($dataa) {
      $message->to($dataa['email'])->subject('flashdealapp otp Mail');
      $message->from($dataa['from'], 'flashdealapp');
    });

    $user = User::where('id', $user_id)->update(['otp' => $otp]);
    if ($user) {
      return $this->sendResponse($name, 'your otp hase been sent your mail.');
    } else {
      return $this->sendError('wrong.', ['error' => 'somthing Wrong']);
    }
  }

  //================ forgot_password====================//
  public function forgot_password(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email'    => 'required',
    ]);
    $data = $request->all();
    $email = $request->email;
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
    $expire_time = Carbon::now()->format('Y-m-d H:s:i');
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


  // //================ update-password====================//
  // public function update_password(Request $request)
  // {

  //   $data = $request->all();

  //   $validator = Validator::make($request->all(), [
  //     'token' => 'required',
  //     'password' => 'required',
  //     'c_password' => 'required|same:password',
  //   ]);

  //   if ($validator->fails()) {
  //     return $this->sendError('Validation Error.', $validator->errors());
  //   }

  //   $token =  $data['token'];
  //   $data_user =   array('password' => bcrypt($data['password']));
  //   $user = User::where('token', $token)->update($data_user);
  //   if ($user) {
  //     return $this->sendResponse($data_user, 'User register successfully. your otp hase been sent your mail');
  //     die();
  //   } else {
  //     return response()->json(array('status' => 'false', 'data' => '400', 'message' => 'Somthing went wrong'));
  //     die();
  //   }
  // }
  // //================ Language====================//
  public function language_upadet(Request $request)
  {

    $data = $request->all();

    $validator = Validator::make($request->all(), [
      'user_id' => 'required',
      'lang' => 'required',
    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $id =  $data['user_id'];
    $data_user =   array('lang' => $data['lang']);
    $user = User::where('id', $id)->update($data_user);
    if ($user) {
      return $this->sendResponse($data_user, 'language update successfully');
      die();
    } else {
      return response()->json(array('status' => 'false', 'data' => '400', 'message' => 'Somthing went wrong'));
      die();
    }
  }

  // //================ gender_upadet====================//
  public function gender_upadet(Request $request)
  {

    $data = $request->all();

    $validator = Validator::make($request->all(), [
      'user_id' => 'required',
      'gender' => 'required',
      'age' => 'required',
    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $id =  $data['user_id'];
    $data_user =   array('age' => $data['age'], 'gender' => $data['gender']);
    $user = User::where('id', $id)->update($data_user);
    if ($user) {
      return $this->sendResponse($data_user, 'language update successfully');
      die();
    } else {
      return response()->json(array('status' => 'false', 'data' => '400', 'message' => 'Somthing went wrong'));
      die();
    }
  }
  // //================ costomer_profile====================//
  public function costomer_profile($id)
  {

    $data = User::where('id', $id)->first();
    if ($data) {
      return $this->sendResponse($data, 'user profile data get successfully');
      die();
    } else {
      return response()->json(array('status' => 'false', 'data' => '400', 'message' => 'Somthing went wrong'));
      die();
    }
  }

  // //================ slider_data====================//
  public function slider_data()
  {

    $data = Slider::get();
    if ($data) {
      return $this->sendResponse($data, 'Slider data get successfully');
      die();
    } else {
      return response()->json(array('status' => 'false', 'data' => '400', 'message' => 'Somthing went wrong'));
      die();
    }
  }
}
