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
                    <button class="btn btn-primary">{{ __('messages.StartForFree') }}</button>
                </div>
                <img src="img/alimento.png" class="col-lg-7">
            </div>
        </div>

        <div class="row mt-5">
            <div class="row">
                <img src="img/alimento2.png" class="col-lg-6">
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

            <div class="col-lg-5">
                <h1 class="fw-bolder">Explore a nossa galeria de receitas, e tenha uma dieta mais agradavél ao seu paladar.</h1>
                <h5>Hehehehehehheheheheheheheh</h5>
                <button class="btn btn-primary col-lg-5 p-2 mt-2">RECEITAS</button>
            </div>
            <img src="img/receita1.png" class="col-lg-5">
        </div>

        
        
    @endguest
    
</div>


@endsection