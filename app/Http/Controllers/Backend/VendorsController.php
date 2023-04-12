<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorsPostRequest;
use App\Models\Vendordetail;
use App\Models\Vendordocument;
use Illuminate\Http\Request;
use DB;
use Image;
use Hash;
use App\Models\User;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendordetail::latest('id')->get();
        return view(
            'admin.Vendor.index',
            compact(
                'vendors'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Vendor.addvendor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'vendor_firstname' => 'required',
            'vendor_lastname' => 'required',
            'vendor_businessname' => 'required',
            'vendor_email' => 'required|email',
            'vendor_mobile' => 'required|numeric|digits:10',
            'vendor_country' => 'required',
            'vendor_state' => 'required',
            'vendor_address' => 'required',
            'vendor_images' => 'required',

        ], [
                'vendor_firstname.required' => 'vendor first name is required',
                'vendor_lastname.required' => 'vendor last name is required',
                'vendor_businessname.required' => 'vendor business name is required',
                'vendor_email.required' => 'vendor email is required',
                'vendor_mobile.required' => 'vendor mobile is required',
                'vendor_country.required' => 'vendor country is required',
                'vendor_state.required' => 'vendor state is required',
                'vendor_address.required' => 'vendor address is required',
                'vendor_images.required' => 'vendor document is required',
            ]);


        $filesarray = [];

        $vendor_firstname = $request->input('vendor_firstname');
        $vendor_lastname = $request->input('vendor_lastname');
        $vendor_businessname = $request->input('vendor_businessname');
        $vendor_email = $request->input('vendor_email');
        $vendor_mobile = $request->input('vendor_mobile');
        $vendor_country = $request->input('vendor_country');
        $vendor_state = $request->input('vendor_state');
        $vendor_address = $request->input('vendor_address');
        $user = User::where('email', '=', $vendor_email)->first();
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
                'vendor_status' => 1,
                // 'vendor_document' => implode(",", $filesarray),
                'vendor_userid' => $userID,
            );
            $Vendor = Vendordetail::create($vendodata);
            $VendorID = $Vendor['id'];

            if ($request->file('vendor_images')) {
                $images = $request->file('vendor_images');
                foreach ($images as $single_image) {
                    $upload_location = 'upload/vendors/';
                    $name_gen = hexdec(uniqid()) . '.' . $single_image->getClientOriginalExtension();
                    // Image::save($upload_location.$name_gen);
                    $single_image->move($upload_location, $name_gen);
                    $save_url = $upload_location . $name_gen;
                    array_push($filesarray, $save_url);
                    $vendodata = array(
                        'vendordetails_id' => $VendorID,
                        'vendordetails_file' => $save_url,

                    );
                    $Vendor = Vendordocument::create($vendodata);
                }
            }


            $userUpdateData = array('vander_id' => $VendorID);
            $userUpdate = User::where('id', '=', $userID)->first();
            $userUpdate->fill($userUpdateData);
            if ($userUpdate->save()) {
                $notification = [
                    'message' => "user successfully registered ",
                    'alert-type' => 'success'
                ];
                return redirect()->route('vendors.index')->with($notification);
            }
        } else {
            $userID = $user['id'];
            $email = $user['email'];
            $vendodata = array(
                'vendor_firstname' => $vendor_firstname,
                'vendor_lastname' => $vendor_lastname,
                'vendor_businessname' => $vendor_businessname,
                'vendor_email' => $email,
                'vendor_mobile' => $vendor_mobile,
                'vendor_country' => $vendor_country,
                'vendor_state' => $vendor_state,
                'vendor_address' => $vendor_address,
                'vendor_status' => 1,
               'vendor_userid' => $userID,
            );
            $Vendor = Vendordetail::create($vendodata);
            $VendorID = $Vendor['id'];
            if ($request->file('vendor_images')) {
                $images = $request->file('vendor_images');
                foreach ($images as $single_image) {
                    $upload_location = 'upload/vendors/';
                    $name_gen = hexdec(uniqid()) . '.' . $single_image->getClientOriginalExtension();
                    // Image::save($upload_location.$name_gen);
                    $single_image->move($upload_location, $name_gen);
                    $save_url = $upload_location . $name_gen;
                    array_push($filesarray, $save_url);
                    $vendodata = array(
                        'vendordetails_id' => $VendorID,
                        'vendordetails_file' => $save_url,

                    );
                    $Vendor = Vendordocument::create($vendodata);
                }
            }
            $userUpdateData = array('vander_id' => $VendorID);
            $userUpdate = User::where('id', '=', $userID)->first();
            $userUpdate->fill($userUpdateData);
            if ($userUpdate->save()) {

                $notification = [
                    'message' => "user successfully registered ",
                    'alert-type' => 'success'
                ];
                return redirect()->route('vendors.index')->with($notification);

            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $vendordetail = Vendordetail::where('id', '=', $id)->first();
        $vendordocuments = Vendordocument::where('vendordetails_id', '=', $id)->get();


        //print_r($vendordocuments);

        return view(
            'admin.Vendor.viewvendor',
            compact(
                'vendordetail',
                'vendordocuments'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendordetail = Vendordetail::where('id', '=', $id)->first();
        $vendordocuments = Vendordocument::where('vendordetails_id', '=', $id)->get();


        //print_r($vendordocuments);

        return view(
            'admin.Vendor.editvendor',
            compact(
                'vendordetail',
                'vendordocuments'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $validatedData = $request->validate([
            'vendor_firstname' => 'required',
            'vendor_lastname' => 'required',
            'vendor_businessname' => 'required',
            'vendor_email' => 'required|email',
            'vendor_mobile' => 'required|numeric|digits:10',
            'vendor_country' => 'required',
            'vendor_state' => 'required',
            'vendor_address' => 'required',
          

        ], [
                'vendor_firstname.required' => 'vendor first name is required',
                'vendor_lastname.required' => 'vendor last name is required',
                'vendor_businessname.required' => 'vendor business name is required',
                'vendor_email.required' => 'vendor email is required',
                'vendor_mobile.required' => 'vendor mobile is required',
                'vendor_country.required' => 'vendor country is required',
                'vendor_state.required' => 'vendor state is required',
                'vendor_address.required' => 'vendor address is required',
                
            ]);

            $userID = $id;
            $vendor_firstname = $request->input('vendor_firstname');
            $vendor_lastname = $request->input('vendor_lastname');
            $vendor_businessname = $request->input('vendor_businessname');
            $vendor_email = $request->input('vendor_email');
            $vendor_mobile = $request->input('vendor_mobile');
            $vendor_country = $request->input('vendor_country');
            $vendor_state = $request->input('vendor_state');
            $vendor_address = $request->input('vendor_address');
            $vendodata = array(
                'vendor_firstname' => $vendor_firstname,
                'vendor_lastname' => $vendor_lastname,
                'vendor_businessname' => $vendor_businessname,
                'vendor_email' => $vendor_email,
                'vendor_mobile' => $vendor_mobile,
                'vendor_country' => $vendor_country,
                'vendor_state' => $vendor_state,
                'vendor_address' => $vendor_address,
                'vendor_status' => 1,
               'vendor_userid' => $userID,
            );

            $userUpdate = Vendordetail::where('id', '=', $userID)->first();
            $userUpdate->fill($vendodata);
          
            
            if ($request->file('vendor_images')) {
                $images = $request->file('vendor_images');
                foreach ($images as $single_image) {
                    $upload_location = 'upload/vendors/';
                    $name_gen = hexdec(uniqid()) . '.' . $single_image->getClientOriginalExtension();
                    // Image::save($upload_location.$name_gen);
                    $single_image->move($upload_location, $name_gen);
                    $save_url = $upload_location . $name_gen;
                    // array_push($filesarray, $save_url);
                    $vendodata = array(
                        'vendordetails_id' => $userID,
                        'vendordetails_file' => $save_url,

                    );
                    $Vendor = Vendordocument::create($vendodata);
                }
            }

              if(  $userUpdate->save()){
                        $notification = [
                    'message' => "Vendor successfully update ",
                    'alert-type' => 'success'
                ];
                return redirect()->route('vendors.index')->with($notification);
              }
            
            

          
            // if ($request->file('vendor_images')) {
            //     $images = $request->file('vendor_images');
            //     foreach ($images as $single_image) {
            //         $upload_location = 'upload/vendors/';
            //         $name_gen = hexdec(uniqid()) . '.' . $single_image->getClientOriginalExtension();
            //         // Image::save($upload_location.$name_gen);
            //         $single_image->move($upload_location, $name_gen);
            //         $save_url = $upload_location . $name_gen;
            //         array_push($filesarray, $save_url);
            //         $vendodata = array(
            //             'vendordetails_id' => $VendorID,
            //             'vendordetails_file' => $save_url,

            //         );
            //         $Vendor = Vendordocument::create($vendodata);
            //     }
            // }
            // $userUpdateData = array('vander_id' => $VendorID);
            // $userUpdate = User::where('id', '=', $userID)->first();
            // $userUpdate->fill($userUpdateData);
            // if ($userUpdate->save()) {

            //     $notification = [
            //         'message' => "user successfully registered ",
            //         'alert-type' => 'success'
            //     ];
            //     return redirect()->route('vendors.index')->with($notification);

            // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       

        $userUpdateData = array('vander_id' => '0');
        $userUpdate = User::where('vander_id', '=', $request->id)->first();
        $userUpdate->fill($userUpdateData);
        $userUpdate->save();


        $vendordelete = Vendordetail::findOrFail($request->id);
        $vendordelete->delete();

        return response()->json(['success' => 'Product status change successfully.', 'status' => 200]);


    }

    public function destroydoccument(Request $request)
    {

        $vendordelete = Vendordocument::findOrFail($request->id);
        $vendordelete->delete();
        return response()->json(['success' => 'Document Delete  successfully.', 'status' => 200]);



    }
}