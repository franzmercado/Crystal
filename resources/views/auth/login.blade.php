@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
          <br>
            <div class="card">
                <div class="card-header"><h5><b>Sign in</b></h5></div>
                <div class="card-body">
                  <div class="col-md-12">
                    <form method="POST" action="{{ route('login') }}" class="form-login">
                        @csrf
                        <div class="form-group col-md-8 offset-2">
                          <label for="email" class="mb-0">{{ __('Email:') }}</label>
                              <div class="input-container">
                                <i class="icon"><i class="fa fa-user"></i></i>
                                <input id="email" type="email" class="input-field" name="email"  required autofocus>
                              </div>
                        </div>
                        <div class="form-group col-md-8 offset-2">
                              <label for="password" class="mb-0">{{ __('Password:') }}</label>
                              <div class="input-container">
                                <i class="icon"><i class="fa fa-lock"></i></i>
                                <input id="password" type="password" class="input-field" name="password" required>
                              </div>
                        </div>

                        <div class="form-group col-md-8 offset-2">
                          <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                              <label class="form-check-label" for="remember">
                                  {{ __('Remember Me') }}
                              </label>
                          </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-2">
                                <button type="button" class="btn btn-primary login_btn">
                                    Login
                                    {{-- {{ __('Login') }} --}}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route($forgotPasswordRoute) }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
