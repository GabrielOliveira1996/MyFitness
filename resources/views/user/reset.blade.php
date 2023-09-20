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
<div id="app">
    <div class="container py-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card mt-5">

                    <h3 class="d-flex justify-content-center mt-3">
                        <a class="text-decoration-none text-primary brand" href="{{ route('welcome') }}">{{ config('app.name', 'MYFITNESS') }}</a>
                    </h3>
                    <h3 class="d-flex justify-content-center">{{ __('messages.RecoverPassword') }}</h3>
                    <p class="d-flex justify-content-center">{{ __('messages.EnterYourNewPassword') }}</p>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.reset.post', ['token' => $token]) }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="row">
                                <div class="col-md-12 inputBox">
                                    <input id="email" type="text" name="email" value="{{ old('email') }}" required autofocus>
                                    <label for="email" class="labelInput">{{ __('E-mail') }}</label>
                                </div>
                                <div class="col-md-12">
                                    @error('email')
                                        <small class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12 inputBox">
                                    <input id="password" type="password" name="password" value="{{ old('password') }}" required autofocus>
                                    <label for="password" class="labelInput">{{ __('Senha') }}</label>
                                </div>
                                <div class="col-md-12">
                                    @error('password')
                                        <small class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4"> 
                                <div class="col-md-12 inputBox">
                                    <input id="password-confirm" type="password" name="password_confirmation" required>
                                    <label for="password-confirm" class="labelInput">{{ __('messages.ConfirmPassword') }}</label>
                                </div>
                                <div class="col-md-12">
                                    @error('password_confirmation')
                                        <small class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <hr/>
                            <p>
                                {{ __('messages.ContinueOnPasswordRecovery') }}
                            </p>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary col-md-12">
                                        {{ __('messages.SaveEditions') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
