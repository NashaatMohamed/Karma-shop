@extends("users.layouts")

@section("content")

@section("content")
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Rest Password</h1>
                <nav class="d-flex align-items-center">
                    <a href="{{route("home")}}">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="{{route("login")}}">Login</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Login Box Area =================-->
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
                @if (session('error'))
                <div class="alert alert-danger d-flex justify-content-center" style="margin-left:20%;width:364px" role="alert">{{ session('error') }}</div>
                @endif

                @if (session('success'))
                <div class="alert alert-success d-flex justify-content-center" style="width:570px" role="alert">{{ session('success') }}</div>
            @endif
              <h3 class="mb-2 pb-2 pb-md-0 mb-md-5">Rest Password</h3>
              <form autocomplete="off" action="{{route('SendForgetPasswordEmail')}}" method="post">
                @csrf
                <div class="row">
                  <div class="col-md-6 mb-2 pb-2">

                    <div class="form-outline">
                        <input type="email" autocomplete="off" id="emailAddress" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" />
                        <label class="form-label" for="emailAddress">Email</label>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                      </div>
                  </div>
                </div>
                <div>
                  <input class="btn btn-danger btn-lg" type="submit" value="Rest Password" />
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
