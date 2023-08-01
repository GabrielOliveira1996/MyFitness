@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row d-flex justify-content-center">
        <img src="{{asset('img/404.png')}}" class="col-md-8" alt="">
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 d-flex justify-content-center">
            {{ $error }}
        </div>
    </div>

</div>


@endsection