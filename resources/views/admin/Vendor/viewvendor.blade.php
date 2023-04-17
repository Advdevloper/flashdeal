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
                        <h3 class="box-title">Vendor Detail</h3>
                        <a href="{{ route('vendors.index') }}" class="btn btn-primary">Back Vendor List</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('vendors.update', $vendordetail->id) }}"  method="post"  enctype="multipart/form-data">
                            @method('PUT')
                            @csrf 
                         
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="text-warning mt-4">Fist Name</h5>
                                    <div class="form-group">
                                        <h5>{{$vendordetail->vendor_firstname}}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="text-warning mt-4">Last Name</h5>
                                    <div class="form-group">
                                        <h5>{{$vendordetail->vendor_lastname}}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="text-warning mt-4">Business Name</h5>
                                    <div class="form-group">
                                        <h5>{{$vendordetail->vendor_businessname}}</h5>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <h5 class="text-warning mt-4">Email</h5>
                                    <div class="form-group">
                                        <h5>{{$vendordetail->vendor_email}}</h5>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <h5 class="text-warning mt-4">Mobile Number</h5>
                                    <div class="form-group">
                                        <h5>{{$vendordetail->vendor_mobile}}</h5>
                                    </div>
                                </div>
                               
                                
                                
                            </div>
                           
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="text-warning mt-4">Country</h5>
                                    <div class="form-group">
                                        <h5>{{$vendordetail->vendor_country}}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="text-warning mt-4">State</h5>
                                    <div class="form-group">
                                        <h5>{{$vendordetail->vendor_state}}</h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="text-warning mt-4">Address</h5>
                                    <div class="form-group">
                                        <h5>{{$vendordetail->vendor_address}}</h5>
                                    </div>
                                </div>
                                
                              
                              
                            </div>
                            <h5 class="text-warning">Legal Document</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Document  <span class="text-danger">*</span></h5>
                                        <div class="col-md-12">
                                            <div id="preview_img">
                                           
                                                @foreach ($vendordocuments as $vendordocument)
                                                @php
                                                  $array = explode('.', $vendordocument->vendordetails_file);
                                                 if($array[1]=='pdf'){
                                                    
                                                 }
                                                @endphp
                                                @if($array[1]=='pdf')
                                                <div class="image_item">
                                                   
                                                    <a href="{{ asset('/') }}{{$vendordocument->vendordetails_file}}" target="_blank"> <img src="{{ asset('/backend/images/pdficon.png') }}" width="80px">
                                                    </a>
                                                    </div>
                                                @else
                                                <div class="image_item">
                                                 <a href="{{ asset('/') }}{{$vendordocument->vendordetails_file}}" target="_blank"><img src="{{ asset('/') }}{{$vendordocument->vendordetails_file}}" width="80px"></a>
                                                </div>
                                                @endif
                                               
                                                @endforeach
                                              
                                            </div>
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
    @section('dashboard_script')

<script type="text/javascript">

    $(function(){
      $(document).on('click','#deldocument',function(e){
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
  <script type="text/javascript">
     
    $(document).ready(function(){
  $('#VendorImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data

          $.each(data, function(index, file){ //loop though each file

              if(/(\.|\/)(gif|jpe?g|png|pdf)$/i.test(file.type)){ //check supported file type
                  console.log('ok',file.type);
                  
                  var fRead = new FileReader(); //new filereader
                  if(file.type=="application/pdf"){
                      fRead.onload = (function(file){ //trigger function on successful read
                      return function(e) {
               var img = $('<img/>').addClass('thumb').attr('src', "https://i.ibb.co/FwvnqHX/PDF-file-icon-svg.png" ) .width(80)
                      .height(80); //create image element
                          $('#preview_img').append(img); //append image to output element
                      };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
                  }else{

                 
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.

                 }
              }
          });

      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
  });
  });

</script>
{{-- <script src="{{ asset('') }}assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
<script src="{{ asset('') }}assets/vendor_components/ckeditor/ckeditor.js"></script>
<script src="{{ asset('') }}assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
<script src="{{ asset('backend') }}/js/pages/editor.js"></script> --}}
@endsection
@endsection
