<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MyFitness') }}</title>

    <!--Css-->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />

    <!-- CSS Animated -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!--Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <!--Vue-->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <!--IMask-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    
</head>

<body>
    <div id="vue-user-login">
        <div class="container py-5">
            <div class="row justify-content-center mt-5">
                <div class="col-md-5">
                    <div class="card mt-5">

                        <h3 class="d-flex justify-content-center mt-3">
                            <a class="text-decoration-none text-primary brand" href="{{ route('welcome') }}">{{ config('app.name', 'MYFITNESS') }}</a>
                        </h3>
                        <h3 class="d-flex justify-content-center">{{ __('messages.loginNow') }}</h3>
                        <p class="d-flex justify-content-center">{{ __('messages.GoToMyFitness') }}</p>

                        <div class="card-body">
                            <form @submit.prevent="login" autocomplete="off">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12 inputBox @error('email') is-invalid @enderror">
                                        <input v-model="email" id="email" type="text" class="" name="email" required autofocus>
                                        <label for="email" class="labelInput">{{ __('E-mail') }}</label>
                                    </div>
                                    <div class="col-md-12">
                                        @error('email')
                                            <small class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 inputBox">
                                        <input v-model="password" id="password" type="password" class="" name="password" required autocomplete="current-password">
                                        <label for="password" class="labelInput">{{ __('messages.Password') }}</label>
                                    </div>
                                    <div class="col-md-12">
                                        @error('password')
                                            <small class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <small v-if="error" class="row d-flex justify-content-center text-danger">
                                    @{{ error }}
                                </small>

                                <small>
                                    <a href="{{ route('recover-password') }}">{{ __('messages.ForgotMyPassword') }}</a>
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
                            <small class="text-justify">
                                {{ __('messages.MyFitnessTermForLoginWithSocial') }}
                                <a style="cursor: pointer;" class="text-primary" title="Clique aqui para verificar os termos." data-bs-toggle="modal" data-bs-target="#termsModal">
                                    {{ __('messages.Terms') }}.
                                </a>
                            </small>
                            <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-bold" id="termsModalLabel">{{ __('messages.Terms') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container text-justify p-3">
                                                <p class="row">{{ __('messages.Term1') }}</p>
                                                <p class="row">{{ __('messages.Term2') }}</p>
                                                <p class="row">{{ __('messages.Term3') }}</p>
                                                <p class="row">{{ __('messages.Term4') }}</p>
                                                <p class="row">{{ __('messages.Term5') }}</p>
                                                <p class="row">{{ __('messages.Term6') }}</p>
                                                <p class="row">{{ __('messages.Term7') }}</p>
                                                <p class="row">{{ __('messages.Term8') }}</p>
                                                <p class="row">{{ __('messages.Term9') }}</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">{{ __('messages.TermsButtonAccept') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2">
                                <a class="btn btn-light rounded-0 border border-light" href="{{ route('google.login') }}">
                                    <img src="{{ asset('img/icons/google.png') }}" height="22">
                                    {{ __('messages.loginWithGmail') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/user/login.js') }}"></script>

</body>

</html>