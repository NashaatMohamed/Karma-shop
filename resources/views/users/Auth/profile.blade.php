@extends("users.layouts")

@section("content")

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                {{-- <h1>Login/Register</h1> --}}
                <nav class="d-flex align-items-center">
                    <a href="{{route("home")}}">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="{{route("register")}}" style="color: blue">{{$user->fname}}<span class="lnr lnr-arrow-right"></span></a>
                    <a class="breadcrumb-item active" href="{{route("register")}}">User Profile</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<section style="background-color: #eee;">
    <div class="container py-5">
        @if (session('success'))
        <div class="alert alert-success d-flex justify-content-center" style="margin-left:51%;width:350px" role="alert">{{ session('success') }}</div>
    @endif
      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <form action="{{route('updateImage')}}" enctype="multipart/form-data" method="post">
                @csrf
                @method("PUT")
            <div class="card-body text-center">
                @if (session('errorimage'))
                <div class="alert alert-success d-flex justify-content-center" style="margin-left:11%;width:250px" role="alert">{{ session('errorimage') }}</div>
            @endif
              <img src="{{$user->image}}" alt="avatar"
                class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3">{{$user->fname}} {{$user->lname}}</h5>
              <p class="text-muted mb-1">Full Stack Developer</p>
              <p class="text-muted mb-4">{{$user->country}}</p>
              <div class="d-flex justify-content-center mb-2">
                  <input type="file" name="image" class="form-control">
              </div>
              <div class="d-flex justify-content-center mb-2">
             <button type="submit" class="btn btn-outline-primary">UPload New Image</button>
            </div>
            </div>
            </form>
          </div>
          <div class="card mb-4 mb-lg-0">
            <div class="card-body p-0">
              <ul class="list-group list-group-flush rounded-3">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fas fa-globe fa-lg text-warning"></i>
                  <p class="mb-0">https://mdbootstrap.com</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                  <p class="mb-0">mdbootstrap</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                  <p class="mb-0">@mdbootstrap</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                  <p class="mb-0">mdbootstrap</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                  <p class="mb-0">mdbootstrap</p>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
                <form action="{{route('updateProfile')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method("PUT")
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">First Name</p>
                </div>
                <div class="col-sm-9">
                  <input type="text" value="{{$user->fname}}" class="form-control mb-0 @error('fname') is-invalid @enderror" name="fname">
                  @error('fname')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Last Name</p>
                </div>
                <div class="col-sm-9">
                  <input type="text" value="{{$user->lname}}" class="form-control mb-0 @error('lname') is-invalid @enderror" name="lname">
                  @error('lname')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                    <input type="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror" name="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Phone</p>
                </div>
                <div class="col-sm-9">
                    <input type="tel" value="{{$user->phone}}" class="form-control @error('phone') is-invalid @enderror" name="phone">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">country</p>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <select name="country" class="form-select mb-1 @error('country') is-invalid @enderror" aria-label="Default select example">
                            <option disabled>Select Country</option>
                            @foreach ($allcountries as $country)
                            <option value="{{$user->country}}" @if ($user->country == $country) {{'selected'}}@endif>{{ $country }}</option>
                            @endforeach
                        </select>
                        @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">age</p>
                </div>
                <div class="col-sm-9">
                    <input type="number" value="{{$user->age}}" class="form-control @error('age') is-invalid @enderror" name="age">
                    @error('age')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">gender</p>
                </div>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" @if($user->gender == "Female"){{'checked'}} @endif type="radio" name="gender" id="femaleGender"
                          value="Female"  />
                        <label class="form-check-label" for="femaleGender">Female</label>
                      </div>

                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" @if($user->gender == "Male"){{'checked'}} @endif name="gender" id="maleGender"
                          value="Male" />
                        <label class="form-check-label" for="maleGender">Male</label>
                      </div>

                      <div class="form-check form-check-inline">
                        <input class="form-check-input" @if($user->gender == "other"){{'checked'}} @endif type="radio" name="gender" id="otherGender"
                          value="other" />
                        <label class="form-check-label" for="otherGender">Other</label>
                      </div>

                </div>
              </div>
              <hr>
              <div class="d-flex justify-content-start mb-2">
                <button type="submit" class="btn btn-outline-primary">Update Profile</button>
               </div>
                </form>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="card mb-4 mb-md-0">
                <div class="card-body">
                  <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                  </p>
                  <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                  <div class="progress rounded mb-2" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-4 mb-md-0">
                <div class="card-body">
                  <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                  </p>
                  <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                  <div class="progress rounded mb-2" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection
