@extends('admin.admin_master')

@section('dashboard_content')
    {{-- @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Customer Detail',
    'url' => "customer",
    'section_name' => 'All Customer'
    ]) --}}
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-lg-12" >
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">
                          Profile Detail
                        </h3>
                        <a href="{{ route('customer') }}" class="btn btn-primary">Back Customers List</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div  class="container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-md-9 col-lg-9" >
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="text-warning mt-4">Customers Name</h5>
                                            <div class="form-group">
                                                <h5>{{$users->name}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="text-warning mt-4">Customers Email</h5>
                                            <div class="form-group">
                                                <h5>{{$users->email}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="text-warning mt-4">Customers Phone</h5>
                                            <div class="form-group">
                                                <h5>{{$users->phone_number}}</h5>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3" >
                                    <h5 class="text-warning mt-4">Customers Photo</h5>
                                    <div class="form-group">
                                        <img src=" {{ !empty($users->profile_photo_path) ? url('storage/profile-photos/'.$users->profile_photo_path) : url('storage/profile-photos/blank_profile_photo.jpg') }}">
                                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
