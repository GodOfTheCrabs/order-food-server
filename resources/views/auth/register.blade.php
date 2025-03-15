@extends('layouts.main')
@section('title', 'Форма реєстрації')
@section('content')
@vite('resources/js/showPassword.js')
<section>
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100" >
        <div class="col-lg-12 col-xl-11" >
          <div class="card text-black" style="border-radius: 25px;" >
            <div class="card-body p-md-5">
              <div class="row justify-content-center" >
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 " >
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
  
                  <form  method="POST" class="mx-1 mx-md-4" action="{{route('register')}}">
                    @csrf
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="tel" value="{{old('phone')}}" name='phone' class="form-control border-dark @error('phone') is-invalid @enderror" pattern="\+380 \d{2}-\d{3}-\d{2}-\d{2}"  placeholder="+380 98-668-49-67" />
                        <label class="form-label">Your phone</label>
                      </div>
                    </div>

                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="email" value="{{old('email')}}" name="email" class="form-control border-dark  @error('email') is-invalid @enderror" />
                        <label class="form-label">Your Email</label>
                      </div>
                    </div>

                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input id="password" type="password" name="password" class="form-control border-dark @error('password') is-invalid @enderror" />
                        <label class="form-label">Password</label>    

                      </div>    

                    </div>
                    
  
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input  id="password-confirmation" type="password" name="password_confirmation" class="form-control border-dark" />
                        <label class="form-label">Repeat your password</label>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <button type="button" class="btn btn-outline-secondary btn-sm mr-3" id="btn-show-password">Show Password</button>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user-tag fa-lg me-3 fa-fw"></i>
                      <div data-mdb-input-init class="form-outline flex-fill mb-0">
                          <label for="roles" class="form-label">Select Roles</label>
                          <select name="roles[]" id="roles" class="form-select border-dark @error('roles') is-invalid @enderror" multiple>
                              @foreach($roles as $role)
                                  <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>
                                      {{ $role->name }}
                                  </option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  
                  @error('roles')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
  
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Register</button>
                    </div>
  
                  </form>
  
                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
  
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                    class="img-fluid" alt="Sample image">
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
