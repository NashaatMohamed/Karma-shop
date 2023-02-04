

<!-- Button trigger modal -->
<button type="button" class="btn btn-info btn-edit" data-bs-toggle="modal" data-bs-target="#edit_user{{$id}}">
    <i class="bi bi-pencil-square"></i>
  </button>

  <!-- Modal -->
  <div class="modal fade" id="edit_user{{$id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">{{$fname . ' ' . $lname}} Update</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="edituser" action="{{route("editUser",$id)}}"  method="post" enctype="multipart/form-data" autocomplete = "off">
            @csrf
            @method('PUT')
        <div class="modal-body">
                <div class="row">
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                        <input type="text" id="fname" value={{$fname}} name="fname" class="form-control form-control-lg @error('fname') is-invalid @enderror" />
                        <label class="form-label"  for="fname">First Name</label>
                      @error('fname')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" id="lastName"  name="lname" value={{$lname}} class="form-control form-control-lg @error('lname') is-invalid @enderror" />
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
                      <input type="text" class="form-control form-control-lg @error('age') is-invalid @enderror" name="age" value={{$age}} id="birthdayDate" />
                      <label for="birthdayDate" class="form-label">Age</label>
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
                        value="Female" {{$gender=="Female"?"checked":"" }} />
                      <label class="form-check-label" for="femaleGender">Female</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="maleGender"
                        value="Male" {{$gender=="Male"?"checked":"" }} />
                      <label class="form-check-label" for="maleGender">Male</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="otherGender"
                        value="other" {{$gender=="other"?"checked":"" }} />
                      <label class="form-check-label" for="otherGender">Other</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="email" id="emailAddress" name="email" value={{$email}} class="form-control form-control-lg @error('email') is-invalid @enderror" />
                      <label class="form-label" for="emailAddress">Email</label>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

            </div>
            <div class="col-md-6 mb-2 ">
              <div class="form-outline">
                <input type="tel" id="phoneNumber" name="phone" value={{$phone}} class="form-control form-control-lg @error('phone') is-invalid @enderror" />
                <label class="form-label" for="phoneNumber">Phone Number</label>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
              </div>
            </div>

                <div class="row">
                    <div class="col-md-6 mb-2 ">
                        <div class="form-group">
                            <select name="country" class="form-select mb-1 @error('country') is-invalid @enderror" aria-label="Default select example">
                                <option disabled >Select Country</option>
                                {{-- @foreach ($allcountries as $country) --}}
                                <option selected>{{ $country }}</option>
                                {{-- @endforeach --}}
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
                        <label for="img">Upload Your image:</label>
                        <img height=50 width=50
                        src='{{$image}}'
                        alt="">
                        <input type="file" id="img" value="{{$image}}" name="image" class="@error('image') is-invalid @enderror" accept="image/*">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                      </div>
                    </div>
                  </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary EditUser">update</button>
        </div>
        </form>
      </div>
    </div>
  </div>

