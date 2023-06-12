@extends('layouts.app')

@section('content')


<div class="container py-5">

    <div class="row d-flex justify-content-center">

        <div class="row d-flex justify-content-center mt-3 mx-5">
            <div class="row mb-5">
                <img src="{{ asset('img/seus-alimentos.png') }}" class="col-lg-5">
                <div class="col-lg-5 mt-5">
                    <h1 class="mt-5 fw-bold">
                        {{ __('messages.AddFoodToGoalDescriptionTitle') }}
                    </h1>
                    <h5 class="mt-2">
                    {{ __('messages.AddFoodToGoalDescription') }}
                    </h5>
                </div>
            </div>
        </div>

        <form method="post" autocomplete="off">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 inputBox">
                    <input type="text" name="name" required>
                    <label for="name" class="labelInput">{{__('messages.SearchFood1')}}</label>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <button class="btn btn-primary col-md-3 mt-3">{{__('messages.SearchFood')}}</button>
            </div>

        </form>

        <hr class="col-md-12 mt-3"/>

        @if(!empty($foods))
            <form method="POST" action="{{ route('goal.addfood', ['type' => $type]) }}">
                @csrf
                <div class="row d-flex justify-content-center">
                    @foreach($foods as $key => $value)
                    <div class="col-md-4">
                        <div id="app">
                        <div class="card m-2 p-0" :class="{ 'enlarged': isEnlarged }">
                            <div class="card-header">
                                <div class="row d-flex justify-content-between">
                                    <div class="col-md-8">
                                        <input type="text" 
                                                class="emptyInput @error('name') is-invalid @enderror" 
                                                name="name" 
                                                value="{{__($value->name)}}" 
                                                step="any"
                                                required 
                                                readonly
                                        />
                                    </div>
                                    <label class="col-md-4">
                                        <input type="checkbox" @click="" name="id[]" value="{{ $value->id }}"/>
                                        <a @click="toggleEnlarged({{$key}})" class="btn btn-primary">Selecionar</a>
                                    </label>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="inputBox col-md-6">
                                        <input id="quantityGramsId-{{__($key)}}" 
                                                type="number" 
                                                class="@error('quantity_grams') is-invalid @enderror" 
                                                name="quantity_grams" 
                                                value="{{__($value->quantity_grams)}}" 
                                                step="any"
                                                required 
                                        />
                                        <label for="quantity_grams" class="labelInput">{{ __('messages.AmountInGrams') }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Calories') }}
                                    </div>
                                    <div class="col-md-6">
                                        <input id="quantityCalorieId-{{__($key)}}" 
                                                type="number" 
                                                class="emptyInput border-0 @error('calories') is-invalid @enderror" 
                                                name="calories" 
                                                value="{{__($value->calories)}}" 
                                                step="any" 
                                                readonly
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Carbohydrate') }}
                                    </div>
                                    <div class="col-md-6">
                                        <input id="quantityCarbohydrateId-{{__($key)}}" 
                                                type="number" 
                                                class="emptyInput border-0 @error('carbohydrate') is-invalid @enderror" 
                                                name="carbohydrate" 
                                                value="{{__($value->carbohydrate)}}" 
                                                step="any" 
                                                readonly 
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Protein') }}
                                    </div>
                                    <div class="col-md-6">
                                        <input id="quantityProteinId-{{__($key)}}" 
                                                type="number" 
                                                class="emptyInput border-0 @error('protein') is-invalid @enderror" 
                                                name="protein" 
                                                value="{{__($value->protein)}}" 
                                                step="any"
                                                readonly 
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Fat') }}
                                    </div>
                                    <div class="col-md-6">
                                        <input id="quantityTotalFatId-{{__($key)}}" 
                                                type="number" 
                                                class="emptyInput border-0 @error('total_fat') is-invalid @enderror" 
                                                name="total_fat" 
                                                value="{{__($value->total_fat)}}" 
                                                step="any" 
                                                readonly 
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.SaturatedFat') }}
                                    </div>
                                    <div class="col-md-6">
                                        <input id="quantitySaturatedFatId-{{__($key)}}" 
                                                type="number" 
                                                class="emptyInput border-0 @error('saturated_fat') is-invalid @enderror" 
                                                name="saturated_fat" 
                                                value="{{__($value->saturated_fat)}}" 
                                                step="any" 
                                                readonly 
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.TransFat') }}
                                    </div>
                                    <div class="col-md-6">
                                        <input id="quantityTransFatId-{{__($key)}}" 
                                                type="number" 
                                                class="emptyInput border-0 @error('trans_fat') is-invalid @enderror" 
                                                name="trans_fat" 
                                                value="{{__($value->trans_fat)}}" 
                                                step="any" 
                                                readonly 
                                        />
                                    </div>
                                </div>
                                <hr class="col-lg-12"/>

                            </div>
                        </div>
                        </div>
                    </div>
                    @endforeach

                    <hr class="col-md-12 mt-3"/>

                    <div class="row">
                        <button class="btn btn-primary col-md-12">{{ __('messages.Add') }}</button>
                    </div>     

                </div>
            </form>
        @endif
        
    </div>

    <div class="d-flex justify-content-center mt-5">
        @if(!empty($foods))
            {{ $foods->links() }}
        @endif
    </div>

</div>

<script src="{{ asset('js/goal/goals.js') }}"></script>
<script src="{{ asset('js/goal/add/add.js') }}"></script>

@endsection