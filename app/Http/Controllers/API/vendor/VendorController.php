<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
class VendorController extends Controller
{
     //================ SIGN UP====================//
  public function vendor_ragister(Request $request)
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
    $response_data['token'] = $user->createToken("API TOKEN")->plainTextToken;
    if ($user) {

      // return response()->json(array('status' => 'true', 'data' => $data_user, 'message' => 'User Register Successfully'));
      return $this->sendResponse($response_data, 'User register successfully. your otp hase been sent your mail');
      die();
    } else {

      return response()->json(array('status' => 'false', 'data' => '400', 'message' => 'Somthing went wrong'));

      die();
    }
  }

  
}
