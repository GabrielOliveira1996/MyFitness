@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row mt-5">

            <div class="col-lg-5">
                <h1 class="fw-bolder">{{ __('messages.RevenuesDescription') }}</h1>
                <h5>{{ __('messages.RevenuesDescription1') }}</h5>
                <button class="btn btn-primary col-lg-5 p-2 mt-2">{{ __('messages.Revenues') }}</button>
            </div>
            <img src="img/receita1.png" class="col-lg-5">
            
        </div>
    </div>
</div>

@endsection
