@extends('layouts.app')

@section('content')
<div class="container">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header"><h5>Sign Up</h5></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" class="form-register">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                              <label for="Firstname" class="mb-0">{{ __('First Name:') }}</label>
                              <input id="Firstname" type="text" class="form-control" name="Firstname" value="{{ old('fname') }}" required>
                            </div>

                            <div class="col-md-4">
                              <label for="Middlename" class="mb-0">{{ __('Middle Name:') }}</label>
                                <input id="Middlename" type="text" class="form-control" name="Middlename" value="{{ old('mname') }}" >

                            </div>
                            <div class="col-md-4">
                              <label for="Lastname" class="mb-0">{{ __('Last Name:') }}</label>
                                <input id="Lastname" type="text" class="form-control" name="Lastname" value="{{ old('mname') }}" required >
                            </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-6">
                            <label for="Email" class="mb-0">{{ __('Email address:') }}</label>
                            <input id="Email" type="email" class="form-control" name="Email" required>
                          </div>

                          <div class="col-md-4">
                            <label for="Birthday" class="mb-0">{{ __('Birthday:') }}</label>
                              <input id="Birthday" type="date" class="form-control" name="Birthday" required >

                          </div>
                          <div class="col-md-2">
                            <label for="Gender" class="mb-0">{{ __('Gender:') }}</label>
                            <select class="form-control" name="Gender" id="Gender" required>
                              <option value="" selected disabled></option>
                              <option value="0">Female</option>
                              <option value="1">Male</option>

                            </select>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-4">
                            <label for="MobileNumber" class="mb-0">{{ __('Contact Number:') }}</label>
                            <div class="input-container">
                              <i class="fa icon">+63</i>
                              {{-- <input class="form-control pl-0" type="text" value="" id="contact" name="contact" pattern="[1-9]{1}[0-9]{9}" required> --}}
                              <input type="text" name="MobileNumber" id="MobileNumber" class="form-control pl-0" pattern="\d*" minlength="10" maxlength="10" title="10 digits" required>

                              </div>

                          </div>
                          <div class="col-md-4">
                            <label for="Password" class="mb-0">{{ __('Password:') }}</label>
                              <input id="Password" type="password" class="form-control" name="Password" minlength="8" maxlength="12" title="8 to 12 characters" required>

                          </div>
                          <div class="col-md-4">
                            <label for="rpass" class="mb-0">{{ __('Confirm Password:') }}</label>
                              <input id="rpass" type="password" class="form-control" name="rpass" minlength="8" maxlength="12" title="8 to 12 characters" required>
                              <small class="ml-2"><font color ='red' id="error-pass">*Password do not match.</font></small>
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-right btn-reg">
                                {{ __('Register') }}
                            </button>
                          </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
