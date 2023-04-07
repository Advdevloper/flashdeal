<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class vendorRagister extends Controller
{
   function formRagister(){
    //   dd("Hello");
      return view('auth.vendor-register');
   }
}
