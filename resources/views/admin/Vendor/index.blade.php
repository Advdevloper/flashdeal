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
                            @if (Request::is('admin/vendors'))
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
                                                @foreach ($vendors as $vendor)
                                                <tr>
                                                    <td>{{ $loop->index+1 }}</td>
                                                    <td> {{ $vendor->vendor_firstname }}  {{ $vendor->vendor_lastname }}</td>
                                                    <td>{{ $vendor->vendor_businessname }}</td>
                                                    <td>{{ $vendor->vendor_email }}</td>
                                                    <td> {{ $vendor->vendor_mobile }}</td>
                                                    <td>
                                                        @if ($vendor->vendor_status==1)
                                                          <button type="button" class="btn btn-success btn-xs">Approved</button>
                                                        @elseif($vendor->vendor_status==2)
                                                        <button type="button" class="btn btn-danger   btn-xs">Rejected</button>
                                                        @else
                                                         <button type="button" class="btn btn-warning btn-xs">Pending</button>
                                                        @endif
                                                      </td>
                                                    <td>
                                                            <div class="input-group">
                                                            <a href="{{ route('vendors.edit',$vendor->id) }}" class="btn btn-info btn-sm mb-5" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                            <a href="{{ route('vendors.show',$vendor->id) }}" class="btn btn-primary btn-sm mb-5" title="Edit Data"><i class="fa fa-eye"></i></a>
                                                            <a  class="btn btn-danger btn-sm mb-5 " id="deletevendor" title="Delete Data" data-id="{{$vendor->id}}"><i class="fa fa-trash"></i></a>
                                                            {{-- <form action="{{ route('vendors.destroy', $vendor->id) }}" method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <a  class="btn btn-danger btn-sm mb-5" title="Delete Data" id="delete" onclick="event.preventDefault();
                                                                this.closest('form').submit();"><i class="fa fa-trash"></i></a>
                                                            </form> --}}
                                                            </div>
                                                    </td>

                                                </tr>
                                                @endforeach

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
    @section('dashboard_script')

{{-- <script>
    $(document).on('click', '#deletevendor', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
            title: "Are you sure!",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "{{url('/destroy')}}",
                data: {id:id},
                success: function (data) {
                              //
                    }         
            });
    });
});
</script> --}}
<script type="text/javascript">

    $(function(){
      $(document).on('click','#deletevendor',function(e){
          e.preventDefault();
          var id = $(this).attr("data-id");
                    Swal.fire({
                      title: 'Are you sure?',
                      text: "Delete This Data?",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: '/admin/vendordelete',
                            data: {'id': id},
                            success: function(data){
                                console.log(data.success)
                                if(data.status==200){
                                    location.reload();
                                }
                                console.log(data)
                            }
                        });
                        // window.location.href = link
                        // Swal.fire(
                        //   'Deleted!',
                        //   'Your file has been deleted.',
                        //   'success'
                        // )
                      }
                    })
      });
    });
  </script>
  
{{-- <script src="{{ asset('') }}assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
<script src="{{ asset('') }}assets/vendor_components/ckeditor/ckeditor.js"></script>
<script src="{{ asset('') }}assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
<script src="{{ asset('backend') }}/js/pages/editor.js"></script> --}}
@endsection
@endsection