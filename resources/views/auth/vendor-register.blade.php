@extends('frontend.frontend_master')
@section('frontend_content')

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
			   <div class="col-md-6 col-sm-6 sign-in">
                    <h4 class="">Welcome to Flash Deal</h4>
	                <p class="">Create your account to start selling</p>
                    <form class="register-form outer-top-xs" role="form" action="#" method="POST">
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Name<span>*</span></label>
                            <input type="text" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Business Name <span>*</span></label>
                            <input type="text" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                            <input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                            <input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1">
                        </div>
                         <div class="radio outer-xs">
                              <label>
                                <input type="radio" name="remember" id="optionsRadios2" value="option2">Remember me!
                              </label>
                            
                            </div>
                          <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                    </form>
                </div>
                <div class="col-md-6 col-sm-6 sign-in">
                    <h4 class="">Grow your business faster by selling on Meesho</h4>
	                <p class="">Create your account to start selling</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection