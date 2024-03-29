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

    <!--SweetAlert2-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand text-light" href="{{ url('/') }}">
                    <h4 class="brand">{{ config('app.name', 'MYFITNESS') }}</h4>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        
                    </ul>
                    @guest
                    @else
                    <ul class="navbar-nav">
                        <form method="GET" action="{{ route('community.search') }}" autocomplete="off" class="mx-2 my-2 my-lg-0">
                            <div class="d-flex justify-content-center">
                                <div class="col-md-12 inputBox">
                                    <input style="border-radius: 0.3rem 0rem 0rem 0.3rem" type="text" name="name" required>
                                    <label class="labelInput">{{__('messages.searchUser')}}</label>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary" style="border-radius: 0rem 0.3rem 0.3rem 0rem">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </ul>
                    @endguest
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('register') }}">{{ __('messages.Register') }}</a>
                        </li>
                        @else
                        
                        <li id="vue-user-logout" class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('messages.HelloMessage') }}
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('user.settings') }}">
                                    {{ __('messages.Settings') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" @click="logout" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('messages.SignOut') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                        <!-- Separador -->

                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('community.index') }}" role="button">
                                {{ __('messages.community') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('goal.index', ['date' => $date = (new DateTime('now'))->setTimezone(new DateTimeZone('America/Sao_Paulo'))->format('Y-m-d') ]) }}">
                                {{ __('messages.MyGoals') }}
                            </a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>

        <footer class="bg-light text-center text-white relative-bottom mt-5">
            <!-- Grid container -->
            <div class="container p-4 pb-0">
                <!-- Section: Social media -->
                <section class="mb-5">
                <!-- Google -->
                <a
                    class="btn text-white btn-floating m-1"
                    style="background-color: #dd4b39;"
                    href="#!"
                    role="button"
                    target="__blank"
                    ><i class="fab fa-google"></i
                ></a>
                <!-- Linkedin -->
                <a
                    class="btn text-white btn-floating m-1"
                    style="background-color: #0082ca;"
                    href="https://www.linkedin.com/in/gabriel-oliveira-4b58b9224/"
                    role="button"
                    target="__blank"
                    ><i class="fab fa-linkedin-in"></i
                ></a>
                <!-- Github -->
                <a
                    class="btn text-white btn-floating m-1"
                    style="background-color: #333333;"
                    href="https://github.com/GabrielOliveira1996"
                    role="button"
                    target="__blank"
                    ><i class="fab fa-github"></i
                ></a>
                </section>
                <!-- Section: Social media -->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3 bg-primary" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2022 Copyright:
                <a class="text-white" href="#">MyFitness</a>
            </div>
            <!-- Copyright -->
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>  
    <script type="module" src="{{asset('js/user/logout.js')}}"></script>
    <script>
        window.APP_URL = "{{ config('app.url') }}";
    </script>
    
</body>
</html>