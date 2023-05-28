@extends('layouts.app')

@section('content')

<div class="container">

    @guest

    <div class="row">
        <div class="row mb-5">
            <div class="col-lg-5 mt-5">
                <h1 class="mt-5 fw-bold">
                    {{ __('messages.Phrase1') }}
                </h1>
                <h5 class="mt-2">
                    {{ __('messages.Phrase2') }}
                </h5>
                <a href="{{ route('register') }}" class="btn btn-primary">{{ __('messages.StartForFree') }}</a>
            </div>
            <img src="{{ asset('img/dieta1.png') }}" class="col-lg-5 mx-5">
        </div>
    </div>

    <div class="row mt-5">
        <div class="row mt-5">
            <img src="{{ asset('img/dieta.png') }}" class="col-lg-6">
            <div class="col-lg-5 mt-5">
                <h1 class="mt-5 fw-bold ">
                    {{ __('messages.Phrase3') }}
                </h1>
                <h5 class="mt-2">
                    {{ __('messages.Phrase4') }}
                </h5>
            </div>
        </div>
    </div>

    @else

    <div class="row mt-5">

        <div class="col-lg-5 mt-5">
            <h1 class="fw-bolder">{{ __('messages.RevenueDescription') }}</h1>
            <h5>{{ __('messages.RevenueDescription1') }}</h5>
        </div>
        <img src="{{ asset('img/receita1.png') }}" class="col-lg-5">
    </div>



    @endguest

</div>


@endsection