@extends('layouts.adminlog')

@section('content')
  <p class="login-box-msg">Sign in to start your session</p>

  <form action="{{ route($loginRoute) }}" method="POST">
    @csrf
    <div class="input-group mb-3">
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
      <div class="input-group-append input-group-text">
          <span class="fas fa-envelope"></span>
      </div>
      @if ($errors->has('email'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
      @endif
    </div>
    <div class="input-group mb-3">
    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
      <div class="input-group-append input-group-text">
          <span class="fas fa-lock"></span>
      </div>
      @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
      @endif
    </div>

    <div class="row">
      <div class="col-8">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember"><b>
                {{ __('Remember Me') }}
            </b></label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">
            {{ __('Login') }}
        </button>      </div>
      @if (Route::has('password.request'))
          <a class="btn btn-link" href="{{ route($forgotPasswordRoute) }}">
              {{ __('Forgot Your Password?') }}
          </a>
      @endif

      <!-- /.col -->
    </div>
    {{-- <div class="row">

      <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
    </div> --}}
  </form>

@endsection
