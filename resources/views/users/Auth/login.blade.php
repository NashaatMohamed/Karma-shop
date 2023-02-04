
@extends("users.layouts")

@section("content")
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Login/Register</h1>
                <nav class="d-flex align-items-center">
                    <a href="{{route("home")}}">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="{{route("register")}}">Register</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Login Box Area =================-->


<section class="login_box_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src={{asset("assets/img/login.jpg")}} alt="">
                    <div class="hover">
                        <h4>New to our website?</h4>
                        <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                        <a class="primary-btn" href="{{route("register")}}">Create an Account</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner">
                    @if (session('error'))
                        <div class="alert alert-danger d-flex justify-content-center" style="margin-left:30%;width:300px" role="alert">{{ session('error') }}</div>
                    @endif
                    <h3>Log in to enter</h3>
                    <form class="row login_form" autocomplete="off" action="{{route("authUser")}}" method="post" id="contactForm" novalidate="novalidate" autocomplete="off">
                        @csrf
                        <div class="col-md-12 form-group">
                            <input type="email" id="emailAddress" autocomplete="off" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'email'" />
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="name" autocomplete="new-password" autocomplete="off" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="selector">
                                <label for="f-option2">Keep me logged in</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="primary-btn">Log In</button>
                            <a href="{{route("ForgetPassword")}}">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->
@endsection
