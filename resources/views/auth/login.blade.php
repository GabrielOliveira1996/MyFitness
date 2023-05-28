@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">{{ __('Entrar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mt-3">
                            <div class="col-md-12 inputBox">
                                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label for="password" class="labelInput">{{ __('E-mail') }}</label>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12 inputBox">
                                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <label for="password" class="labelInput">{{ __('messages.Password') }}</label>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <small>
                            <a href="{{ Route('password.request') }}">Esqueci minha senha.</a>
                        </small>
                        
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('messages.Remember') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <small class="text-justify">{{ __('messages.DontHaveAnAccountMessage') }} <a href="{{ route('register') }}">{{ __('messages.Register') }}</a></small>
                        <hr>
                        <div class="row mb-0">
                            <div class="col-md-12">
                                <div class="row p-2">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('messages.Login') }}
                                    </button>
                                </div>
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('messages.ForgotMyPassword') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row p-2">
                        <a class="btn btn-light rounded-0 border border-light" href="{{ route('google.login') }}">
                            <img src="{{ asset('img/icons/google.png') }}" height="22">
                            Login com Gmail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection