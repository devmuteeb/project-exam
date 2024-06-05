@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">

                    <div class="row">
                        <div class="col-md-6 offset-md-3 d-flex justify-content-center align-items-center bg-light"
                            style="height: 180px;">
                            <a href="{{  url('/') }}"> <img src="{{ url('assets/images/LOGO.png') }}" alt=""
                                    width="200" height="150">
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                        <h1 class="text-center mb-6"><b>Student Login</b></h1>
                        <form method="POST" action="{{ route('student.login.submit') }}" class="mt-4">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-block" style="width: 100%">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            {{-- Uncomment if you have password reset route --}}
                            {{-- <div class="form-group text-center">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
