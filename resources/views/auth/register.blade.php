@extends('layouts.app')

@section('content')
<div class="bg-color">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">{{ __('messages.Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row">
                                <label for="name" class="col-md-12">{{ __('messages.Name') }}</label>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <label for="email" class="col-md-12">{{ __('E-mail') }}</label>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <label for="password" class="col-md-12">{{ __('messages.Password') }}</label>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <label for="password-confirm" class="col-md-12">{{ __('messages.ConfirmPassword') }}</label>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary rounded-0 col-lg-12">
                                        {{ __('messages.Register') }}
                                    </button>
                                </div>
                            </div>
                            <small class="text-justify">{{ __('messages.IAlreadyHaveAnAccountMessage') }} <a href="{{Route('login')}}">{{ __('messages.Login') }}</a></small>
                        </form>

                        <hr>

                        <small class="text-justify">
                            {{ __('messages.MyFitnessTerm') }}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection