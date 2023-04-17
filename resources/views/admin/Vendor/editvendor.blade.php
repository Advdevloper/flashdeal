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
                        <h3 class="box-title">Edit Vendor</h3>
                        <a href="{{ route('vendors.index') }}" class="btn btn-primary">Back Vendor List</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('vendors.update', $vendordetail->id) }}"  method="post"  enctype="multipart/form-data">
                            @method('PUT')
                            @csrf 
                            <h5 class="text-warning">Vendor Basic Informations</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>First Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="vendor_firstname" value="{{$vendordetail->vendor_firstname}}" class="form-control" required=""  data-validation-required-message="This field is required"> <div class="help-block" ></div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Last Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="vendor_lastname" value="{{$vendordetail->vendor_lastname}}" class="form-control" required=""  data-validation-required-message="This field is required"> <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Business Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="vendor_businessname" value="{{$vendordetail->vendor_businessname}}" class="form-control" required=""  data-validation-required-message="This field is required"> <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Email  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="email" name="vendor_email" value="{{$vendordetail->vendor_email}}"  class="form-control"  required=""  data-validation-required-message="This field is required"> <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Mobile Number  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" name="vendor_mobile" value="{{$vendordetail->vendor_mobile}}" class="form-control"  required=""  data-validation-required-message="This field is required"> <div class="help-block"></div>
                                        </div>
                                        @if ($errors->has('vendor_mobile'))
                                        <span class="text-danger">{{ $errors->first('vendor_mobile') }}</span>
                                    @endif
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
                                            <input type="text" name="vendor_country" class="form-control"  value="{{$vendordetail->vendor_country}}" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>State <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="vendor_state" class="form-control" value="{{$vendordetail->vendor_state}}"  required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Address  <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" name="vendor_address" class="form-control" value="{{$vendordetail->vendor_address}}"  required="" data-validation-required-message="This field is required" > <div class="help-block"></div>
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

                                                             @if(count($vendordocuments)!==0)
                                            <input type="file" id="VendorImg" name="vendor_images[]" class="form-control" multiple="" id="multiImg" > <div class="help-block"></div>
                                            @else
                                            <input required="" type="file" id="VendorImg" name="vendor_images[]" class="form-control" multiple="" id="multiImg" > <div class="help-block"></div>
                                           
                                            @endif
                                        </div>
                                        <div id="preview_img">
                                           
                                            @foreach ($vendordocuments as $vendordocument)
                                            @php
                                              $array = explode('.', $vendordocument->vendordetails_file);
                                             if($array[1]=='pdf'){
                                                
                                             }
                                            @endphp
                                            @if($array[1]=='pdf')
                                            <div class="image_item">
                                                <button id="deldocument" data-id="{{$vendordocument->id}}" type="button" class="btn btn-circle btn-danger btn-xs  mb-5"><i class="fa fa-trash"></i></button>
                                               <img src="{{ asset('/backend/images/pdficon.png') }}" width="80px">
                                            </div>
                                            @else
                                            <div class="image_item">
                                                <button id="deldocument" data-id="{{$vendordocument->id}}" type="button" class="btn btn-circle btn-danger btn-xs  mb-5"><i class="fa fa-trash"></i></button>
                                            <img src="{{ asset('/') }}{{$vendordocument->vendordetails_file}}" width="80px">
                                            </div>
                                            @endif
                                           
                                            @endforeach
                                          
                                        </div>
                                    </div>
                                    
                                </div>
                               
                               
                            </div>
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info">Update Vendor</button>
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
                            url: '/admin/doccumentdelete',
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
