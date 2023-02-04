
@extends("users.layouts")


@section("content")
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Register</h1>
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
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
              <form method="post" action="{{route("storeUser")}}" enctype="multipart/form-data" autocomplete = "off">
                @csrf
                <div class="row">
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" id="fname" name="fname" class="form-control form-control-lg @error('fname') is-invalid @enderror" />
                      <label class="form-label" for="fname">First Name</label>
                      @error('fname')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" id="lastName"  name="lname" class="form-control form-control-lg @error('lname') is-invalid @enderror" />
                      <label class="form-label" for="lastName">Last Name</label>
                      @error('lname')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 d-flex align-items-center">

                    <div class="form-outline datepicker w-100">
                      <input type="date" class="form-control form-control-lg @error('age') is-invalid @enderror" name="age" id="birthdayDate" />
                      <label for="birthdayDate" class="form-label">Birthday</label>
                      @error('age')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <h6 class="mb-2 pb-1">Gender: </h6>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                        value="Female" checked />
                      <label class="form-check-label" for="femaleGender">Female</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="maleGender"
                        value="Male" />
                      <label class="form-check-label" for="maleGender">Male</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="otherGender"
                        value="other" />
                      <label class="form-check-label" for="otherGender">Other</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="email" id="emailAddress" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" />
                      <label class="form-label" for="emailAddress">Email</label>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    </div>

                  </div>
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="password" id="phoneNumber" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" autocomplete= "new-password" />
                      <label class="form-label" for="phoneNumber">Password</label>
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>

                  </div>
                </div>


                <div class="row">
                    <div class="col-md-6 mb-2 ">
                        <div class="form-group">
                            <select name="country" class="form-select mb-1 @error('country') is-invalid @enderror" aria-label="Default select example">
                                <option disabled selected>Select Country</option>
                                @foreach ($allcountries as $country)
                                <option>{{ $country }}</option>
                                @endforeach
                            </select>
                            <label class="form-label" for="phoneNumber">Country</label>
                            @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-2 ">
                      <div class="form-outline">
                        <input type="tel" id="phoneNumber" name="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" />
                        <label class="form-label" for="phoneNumber">Phone Number</label>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                      </div>
                    </div>
                  </div>


                <div class="row">
                    <div class="col-md-6 mb-2 ">
                      <div class="form-outline">
                        <label for="img">Upload Your image:</label>
                        <input type="file" id="img" name="image" class="@error('image') is-invalid @enderror" accept="image/*">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                      </div>
                    </div>
                  </div>

                <div class="mt-2">
                  <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!--================End Login Box Area =================-->
  @endsection
