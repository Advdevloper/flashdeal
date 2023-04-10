<?php

namespace App\Http\Controllers\API\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;

class CutomerController extends BaseController
{

  public function sign_in(Request $request)
  {

    echo "hel9";
    //   $rules = [
    //     'email' => 'required',
    //     'password' => 'required',

    //   ];

    //   $input  = $request->all();
    //   $validator = Validator::make($input, $rules);
    //   if ($validator->fails()) {
    //     $result['id'] = '';
    //     $result['email'] = '';
    //     //return response()->json(['success' => 'false', 'data' => $result, 'message' => "Please enter all fields"]);
    //     return $this->sendError('Please enter all fields.', $validator->errors());
    //     die();
    //   }

    //   if (!auth()->attempt($request->all())) {
    //     $result['id'] = '';
    //     $result['email'] = '';
    //     //return response(['status' => 'false', 'data' => $result, 'message' => 'Invalid Credentials']);
    //     return $this->sendError('Invalid Credentials.', $validator->errors());
    //     die();
    //   }

    //   $user = User::Select('id', 'email', 'name')->where('email', $request->email)->orwhere('password', $request->password)->first();
    //   $id = $user->id;
    //   $user = Auth::user();
    //   $dataa['token'] = Auth::user()->createToken('auth_token')->plainTextToken;
    //   $dataa['id'] = "$id";
    //   $dataa['email'] = $user->email;
    //   $dataa['username'] = $user->name;
    //   // echo json_encode(array('status' => 'true', 'data' => $dataa, 'message' => 'User Login Successfully'));
    //   return $this->sendResponse($dataa, 'User Login successfully.');
    //   die();
  }

  //================ sIGN UP====================//
  public function signup(Request $request)
  {

    $rules = [

      'name' => 'required',
      'last_name' => 'required',
      'email'    => 'unique:users|required',
      'password' => 'required',

    ];

    $data = $request->all();

    $validator = Validator::make($data, $rules);

    $dataa['name'] = '';

    $dataa['last_name'] = '';

    $dataa['email'] = '';

    $dataa['password'] = '';

    $dataa['phone_number'] = '';

    $dataa['role_type'] = '';

    $error_msg = '';

    $error_msg = $validator->errors()->first();

    if ($validator->fails()) {

      return response()->json(['status' => 'false', 'data' => $dataa, 'message' => $error_msg]);
      // return $this->sendError('Validation Error.', $validator->errors());
      die();
    }
    $response_data = array('name' => $data['name'], 'last_name' => $data['last_name'], 'email' => $data['email'], 'phone_number' => $data['phone_number'],'role_type' => '1', 'password' => bcrypt($data['password']));

    $data_user =   array('name' => $data['name'], 'last_name' => $data['last_name'], 'email' => $data['email'], 'phone_number' => $data['phone_number'], 'password' => bcrypt($data['password']));

    $user = User::create($data_user);
    // $token = $user()->createToken('auth_token')->plainTextToken;
    //$role = DB::table('roles')->insertGetId[' name' => $data['first_name'],'display_name' => $data['first_name']]);

    if ($user) {

      return response()->json(array('status' => 'true', 'data' => $data_user, 'message' => 'User Register Successfully'));
      // return $this->sendResponse($response_data, 'User register successfully.');
      die();
    } else {

      return response()->json(array('status' => 'false', 'data' => $dataa, 'message' => 'Somthing went wrong'));
      // return $this->sendError('Validation Error.', $validator->errors());
      die();
    }
  }
}
