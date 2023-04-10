@extends('admin.admin_master')

@section('dashboard_content')
    {{-- @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Vendor',
    'url' => "customer",
    'section_name' => 'All Vendor'
    ]) --}}
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">Add New Vendor</h3>
                        <a href="{{ route('vendor.index') }}" class="btn btn-primary">Back Vendor List</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                                        
                            <h5 class="text-warning">Vendor Basic Informations</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>First Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="vendor_firstname" class="form-control"> <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Last Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="vendor_firstname" class="form-control"> <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Business Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="vendor_firstname" class="form-control"> <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Email  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="email" name="vendor_firstname" class="form-control"> <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Mobile Number  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" name="vendor_firstname" class="form-control"> <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="text-warning">Vendor Address</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Country <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="vendor_firstname" class="form-control"> <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>State <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="vendor_firstname" class="form-control"> <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Address  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" name="vendor_firstname" class="form-control"> <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <h5 class="text-warning">Legal Document</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Document  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="product_images[]" class="form-control" multiple="" id="multiImg"> <div class="help-block"></div>
                                        </div>
                                    </div>
                                    
                                </div>
                               
                               
                            </div>
                        </form>
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
