@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-5">
            <div class="card mt-5">
                
                <h3 class="d-flex justify-content-center mt-3">
                    <a class="text-decoration-none text-primary brand" href="{{ route('welcome') }}">{{ config('app.name', 'MYFITNESS') }}</a>
                </h3>
                <h3 class="d-flex justify-content-center mt-3">Recuperar senha</h3>
                <p class="d-flex justify-content-center">Digite o e-mail da sua conta</p>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('send.email.to.recover.password') }}" autocomplete="off">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 inputBox">
                                <input id="email" type="text" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                <label for="email" class="labelInput">{{ __('E-mail') }}</label>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-md-12">
                                    {{ __('messages.SendToEmail') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <p>
                        Um e-mail será enviado a você contendo instruções sobre como prosseguir com a recuperação da senha.
                    </p>
                    <div class="row p-2">
                        <a class="btn btn-light rounded-0 border border-light text-primary font-weight-bold" href="{{ route('login') }}">
                            Entrar
                        </a>
                    </div>
                    <div class="row p-2">
                        <a class="btn btn-light rounded-0 border border-light text-primary font-weight-bold" href="{{ route('register') }}">
                            Criar conta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
