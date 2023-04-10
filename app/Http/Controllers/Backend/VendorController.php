<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        return view('admin.Vendor.index');
    }

    public function addVendor()
    {
        return view('admin.Vendor.addvendor');
    }
    public function editVendor($id)
    {   $userid = $id;
        return view('admin.Vendor.editvendor', compact(
            'userid'
           
        ));
    }
}
