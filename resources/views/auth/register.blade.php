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

                            <div class="row mb-3">
                                <div class="col-md-12 inputBox">
                                    <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                                    <label for="name" class="labelInput">{{ __('messages.Name') }}</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 inputBox">
                                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off">
                                    <label for="email" class="labelInput">{{ __('E-mail') }}</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 inputBox">
                                    <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="off">
                                    <label for="password" class="labelInput">{{ __('messages.Password') }}</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 inputBox">
                                    <input id="password-confirm" type="password" class="@error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="off">
                                    <label for="password-confirm" class="labelInput">{{ __('messages.ConfirmPassword') }}</label>
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input id="confirm-terms" type="checkbox" value="1" class="@error('confirm_terms') is-invalid @enderror" name="confirm_terms">
                                    <small class="text-justify">
                                        {{ __('messages.MyFitnessTerm') }}
                                        <a style="cursor: pointer;" class="text-primary" title="Clique aqui para verificar os termos." data-bs-toggle="modal" data-bs-target="#termsModal">
                                            {{ __('messages.Terms') }}.
                                        </a>
                                    </small>
                                    @error('confirm_terms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <div class="row p-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.Register') }}
                                </button>
                            </div>
                            <small class="text-justify">{{ __('messages.IAlreadyHaveAnAccountMessage') }} <a href="{{Route('login')}}">{{ __('messages.Login') }}</a></small>
                        </form>

                        <hr>

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