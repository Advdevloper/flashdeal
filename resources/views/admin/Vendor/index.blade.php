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
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            @if (Request::is('admin/vendor'))
                                All Vendor List
                            @else
                                Statuswise Customer List
                            @endif
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable"
                                            role="grid" aria-describedby="example1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>#</th>
                                                    <th>Vendor Name</th>
                                                    <th>Business Name</th>
                                                    <th>Vendor Email</th>
                                                    <th>Vendor Number</th>
                                                    <th>Vendor Status</th>
                                                    <th>Action</th>
                                                 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td> Pankaj Rathod</td>
                                                    <td>ABC Shop</td>
                                                    <td>abcshop@gmail.com</td>
                                                    <td> 8878797645</td>
                                                    <td><button type="button" class="btn btn-success btn-xs">Approved</button></td>
                                                    <td>
                                                            <div class="input-group">
                                                            <a href="{{ route('vendor.edit',1) }}" class="btn btn-info btn-sm mb-5" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                            <a href="#" class="btn btn-primary btn-sm mb-5" title="Edit Data"><i class="fa fa-eye"></i></a>
                                                            <a href="#" class="btn btn-danger btn-sm mb-5" title="Edit Data"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td> Rahul Patidar</td>
                                                    <td>NC Shop</td>
                                                    <td>nchop@gmail.com</td>
                                                    <td> 8878797645</td>
                                                    <td><button type="button" class="btn btn-warning btn-xs">Pending</button></td>
                                                    <td>
                                                            <div class="input-group">
                                                            <a href="{{ route('vendor.edit',1) }}" class="btn btn-info btn-sm mb-5" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                            <a href="#" class="btn btn-primary btn-sm mb-5" title="Edit Data"><i class="fa fa-eye"></i></a>
                                                            <a href="#" class="btn btn-danger btn-sm mb-5" title="Edit Data"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td> Deepak Patel</td>
                                                    <td>DM store</td>
                                                    <td>dmstore@gmail.com</td>
                                                    <td> 8878797645</td>
                                                    <td><button type="button" class="btn btn-danger   btn-xs">Rejected</button></td>
                                                    <td>
                                                            <div class="input-group">
                                                            <a href="{{ route('vendor.edit',1) }}" class="btn btn-info btn-sm mb-5" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                            <a href="#" class="btn btn-primary btn-sm mb-5" title="Edit Data"><i class="fa fa-eye"></i></a>
                                                            <a href="#" class="btn btn-danger btn-sm mb-5" title="Edit Data"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
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
