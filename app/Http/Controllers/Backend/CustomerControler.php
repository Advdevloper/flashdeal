<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
class CustomerControler extends Controller
{
    public function index()
    {
        $users = User::latest('id')->get();

        return view('admin.Customers.index', compact(
            'users'
        ));
       
    }

    public function customerdetail($id)
    {
         $users = User::findOrFail($id);

        // dd($users);
        return view('admin.Customers.viewCustomers', compact(
            'users'
           
        ));
       
    }
}
