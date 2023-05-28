@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row d-flex justify-content-center">

        <div class="row mt-3 mx-5">
            <div class="row mb-5">
                <img src="{{ asset('img/seus-alimentos.png') }}" class="col-lg-5 mx-5">
                <div class="col-lg-5 mt-5">
                    <h1 class="mt-5 fw-bold">
                        {{ __('messages.YourFoods') }}
                    </h1>
                    <h5 class="mt-2">
                        {{ __('messages.YourFoodsDescription') }}
                    </h5>
                </div>
            </div>
        </div>

        <hr class="col-lg-12">

        <form method="POST" action="{{ route('food.search') }}" autocomplete="off">
            @csrf
            
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 inputBox mt-3">
                    <input type="text" name="name">
                    <label class="labelInput">{{__('messages.SearchFood1')}}</label>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <div class="row col-md-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary col-md-3 m-1">{{__('messages.SearchFood')}}</button>
                    <a href="{{ route('food.create') }}" class="btn btn-primary col-md-3 m-1">{{__('messages.AddFood')}}</a>
                </div>
            </div>
            
        </form>

        @foreach($foods as $value)
            <div class="card col-md-4 mt-3 m-2">
                <div class="card-header">{{__($value->name)}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{ __('messages.AmountInGrams') }}
                        </div>
                        <div class="col-md-6">
                            {{__($value->quantity_grams)}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ __('messages.Calories') }}
                        </div>
                        <div class="col-md-6">
                            {{__($value->calories)}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ __('messages.Carbohydrate') }}
                        </div>
                        <div class="col-md-6">
                            {{__($value->carbohydrate)}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ __('messages.Protein') }}
                        </div>
                        <div class="col-md-6">
                            {{__($value->protein)}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ __('messages.Fat') }}
                        </div>
                        <div class="col-md-6">
                            {{__($value->total_fat)}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ __('messages.SaturatedFat') }}
                        </div>
                        <div class="col-md-6">
                            {{__($value->saturated_fat)}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ __('messages.TransFat') }}
                        </div>
                        <div class="col-md-6">
                            {{__($value->trans_fat)}}
                        </div>
                    </div>

                    <hr class="col-lg-12">

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <a type="button" href="{{ route('food.update', ['id' => $value->id]) }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                </svg>
                                {{__('messages.Edit')}}
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('food.delete', ['id' => $value->id]) }}" class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                                {{__('messages.Delete')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center mt-5">
            {{$foods->links()}}
        </div>

    </div>

</div>


@endsection