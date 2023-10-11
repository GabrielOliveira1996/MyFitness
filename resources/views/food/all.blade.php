@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row d-flex justify-content-center">

        <div class="row mt-3 mx-5">
            <div class="row mb-5">
                <img src="{{ asset('img/seus-alimentos.png') }}" class="col-lg-5">
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

        <hr class="col-lg-12"/>

        <form method="GET" action="{{ route('food.search') }}" autocomplete="off">
            
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 inputBox mt-3">
                    <input type="text" name="name" required>
                    <label class="labelInput">{{__('messages.SearchFood1')}}</label>
                </div>
            </div>
            <div class="mt-2">
                <div class="row d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary col-md-2 m-1">{{__('messages.SearchFood')}}</button>
                    <a data-bs-toggle="modal" data-bs-target="#FoodAdditionModal" class="btn btn-primary col-md-2 m-1">{{__('messages.AddFood')}}</a>
                </div>
            </div>
            
        </form>

        <!-- Food Addition Modal -->
        <div class="modal fade" id="FoodAdditionModal" tabindex="-1" role="dialog" aria-labelledby="FoodAdditionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('messages.AddFoodTitle') }}</h5>
                        <button :id="closeModalId" @click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="row">
                        <img src="{{ asset('img/adicionar-alimento.png') }}" class="col-lg-5">
                        <div class="col-lg-5 mt-5">
                            <h5>{{ __('messages.AddFoodDescription') }}</h5>
                        </div>
                    </div>

                    <div class="row">
                        <form method="POST" action="{{ route('food.create') }}" autocomplete="off">
                            @csrf

                            <hr class="col-lg-12">
                            
                            <div class="row m-1">
                                <div class="col-md-4 inputBox mt-3">
                                    <input type="text" class="@error('name') is-invalid @enderror" name="name" autofocus required>
                                    <label for="name" class="labelInput">{{ __('messages.Name') }}</label>
                                </div>
                                
                                <div class="col-md-4 inputBox mt-3">
                                    <input type="text" class="@error('quantity_grams') is-invalid @enderror" name="quantity_grams" required>
                                    <label for="quantity_grams" class="labelInput">{{ __('messages.AmountInGrams') }}</label>
                                </div>

                                <div class="col-md-4 inputBox mt-3">
                                    <input type="text" class="@error('calories') is-invalid @enderror" name="calories" required>
                                    <label for="calories" class="labelInput">{{ __('messages.Calories') }}</label>
                                </div>

                                <div class="col-md inputBox mt-3">
                                    <input type="text" class="@error('carbohydrate') is-invalid @enderror" name="carbohydrate" required>
                                    <label for="carbohydrate" class="labelInput">{{ __('messages.Carbohydrate') }}</label>
                                </div>

                                <div class="col-md inputBox mt-3">
                                    <input type="text" class="@error('protein') is-invalid @enderror" name="protein" required>
                                    <label for="protein" class="labelInput">{{ __('messages.Protein') }}</label>
                                </div>

                                <div class="col-md inputBox mt-3">
                                    <input type="text" class="@error('total_fat') is-invalid @enderror" name="total_fat" required>
                                    <label for="total_fat" class="labelInput">{{ __('messages.Fat') }}</label>
                                </div>
                                        
                                <div class="col-md inputBox mt-3">
                                    <input type="text" class="@error('saturated_fat') is-invalid @enderror" name="saturated_fat" required>
                                    <label for="saturated_fat" class="labelInput">{{ __('messages.SaturatedFat') }}</label>
                                </div>

                                <div class="col-md inputBox mt-3">
                                    <input type="text" class="@error('trans_fat') is-invalid @enderror" name="trans_fat" required>
                                    <label for="trans_fat" class="labelInput">{{ __('messages.TransFat') }}</label>
                                </div>
                            </div>

                            <hr class="col-lg-12">

                            <small class="col-lg-12 text-justify m-1">
                                {{ __('messages.AddFoodAlert') }}
                            </small>

                            <hr class="col-lg-12">

                            <div class="row p-2 m-1">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.Add') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>  

        <div class="row">
            
            @if(!empty($unsuccessfully))
                <div class="text-danger d-flex justify-content-center mt-5" role="alert">
                    <strong class="shake-text">{{$unsuccessfully}}</strong>
                </div>
            @endif

            @if(session('unsuccessfully'))
                <div class="text-danger d-flex justify-content-center mt-5" role="alert">
                    <strong class="shake-text">{{session('unsuccessfully')}}</strong>
                </div>
            @endif

            @if(!empty($foods))
                @foreach($foods as $food)
                <div class="col-md-4 p-1 mt-3">
                    <div class="card m-2 p-0">
                        <div class="card-header">{{__($food->name)}}</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.AmountInGrams') }}
                                </div>
                                <div class="col-md-6">
                                    {{__($food->quantity_grams)}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Calories') }}
                                </div>
                                <div class="col-md-6">
                                    {{__($food->calories)}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Carbohydrate') }}
                                </div>
                                <div class="col-md-6">
                                    {{__($food->carbohydrate)}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Protein') }}
                                </div>
                                <div class="col-md-6">
                                    {{__($food->protein)}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Fat') }}
                                </div>
                                <div class="col-md-6">
                                    {{__($food->total_fat)}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.SaturatedFat') }}
                                </div>
                                <div class="col-md-6">
                                    {{__($food->saturated_fat)}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.TransFat') }}
                                </div>
                                <div class="col-md-6">
                                    {{__($food->trans_fat)}}
                                </div>
                            </div>

                            <hr class="col-lg-12"/>

                            <div class="row">
                                <div class="col-md-5 mt-1">
                                    <a class="btn btn-primary edit-food-btn" 
                                        data-food-id="{{ $food->id }}" 
                                        data-food-name="{{ $food->name }}" 
                                        data-food-quantity-grams="{{ $food->quantity_grams }}"
                                        data-food-calories="{{ $food->calories }}"
                                        data-food-carbohydrate="{{ $food->carbohydrate }}"
                                        data-food-protein="{{ $food->protein }}"
                                        data-food-total-fat="{{ $food->total_fat }}"
                                        data-food-saturated-fat="{{ $food->saturated_fat }}"
                                        data-food-trans-fat="{{ $food->trans_fat }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#FoodEditingModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                        {{__('messages.Edit')}}
                                    </a>
                                </div>
                                <div class="col-md-5 mt-1">
                                    <a href="{{ route('food.delete', ['id' => $food->id]) }}" data-id="{{ $food->id }}" class="btn btn-danger delete-food-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                        {{__('messages.Delete')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            @endif

        </div>
        
    </div>

    <!-- Food Editing Modal -->
    <div class="modal fade" id="FoodEditingModal" tabindex="-1" role="dialog" aria-labelledby="FoodEditingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.AddFoodTitle') }}</h5>
                    <button :id="closeModalId" @click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="row">
                    <img src="{{ asset('img/adicionar-alimento.png') }}" class="col-lg-5">
                    <div class="col-lg-5 mt-5">
                        <h5>{{ __('messages.AddFoodDescription') }}</h5>
                    </div>
                </div>

                <div class="row">
                    <form method="POST" action="{{ route('food.update') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" id="id" value="">
                        <hr class="col-lg-12">
                        
                        <div class="row m-1">
                            <div class="col-md-4 inputBox mt-3">
                                <input type="text" class="@error('name') is-invalid @enderror" name="name" autofocus required>
                                <label for="name" class="labelInput">{{ __('messages.Name') }}</label>
                            </div>
                            
                            <div class="col-md-4 inputBox mt-3">
                                <input type="text" class="@error('quantity_grams') is-invalid @enderror" name="quantity_grams" required>
                                <label for="quantity_grams" class="labelInput">{{ __('messages.AmountInGrams') }}</label>
                            </div>

                            <div class="col-md-4 inputBox mt-3">
                                <input type="text" class="@error('calories') is-invalid @enderror" name="calories" required>
                                <label for="calories" class="labelInput">{{ __('messages.Calories') }}</label>
                            </div>

                            <div class="col-md inputBox mt-3">
                                <input type="text" class="@error('carbohydrate') is-invalid @enderror" name="carbohydrate" required>
                                <label for="carbohydrate" class="labelInput">{{ __('messages.Carbohydrate') }}</label>
                            </div>

                            <div class="col-md inputBox mt-3">
                                <input type="text" class="@error('protein') is-invalid @enderror" name="protein" required>
                                <label for="protein" class="labelInput">{{ __('messages.Protein') }}</label>
                            </div>

                            <div class="col-md inputBox mt-3">
                                <input type="text" class="@error('total_fat') is-invalid @enderror" name="total_fat" required>
                                <label for="total_fat" class="labelInput">{{ __('messages.Fat') }}</label>
                            </div>
                                    
                            <div class="col-md inputBox mt-3">
                                <input type="text" class="@error('saturated_fat') is-invalid @enderror" name="saturated_fat" required>
                                <label for="saturated_fat" class="labelInput">{{ __('messages.SaturatedFat') }}</label>
                            </div>

                            <div class="col-md inputBox mt-3">
                                <input type="text" class="@error('trans_fat') is-invalid @enderror" name="trans_fat" required>
                                <label for="trans_fat" class="labelInput">{{ __('messages.TransFat') }}</label>
                            </div>
                        </div>

                        <hr class="col-lg-12">

                        <small class="col-lg-12 text-justify m-1">
                            {{ __('messages.AddFoodAlert') }}
                        </small>

                        <hr class="col-lg-12">

                        <div class="row p-2 m-1">
                            <button type="submit" class="btn btn-primary">
                                {{ __('messages.Add') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  

</div>

<script src="{{ asset('js/food/passingDataToTheModal.js') }}"></script>
<script src="{{ asset('js/food/deleteFoodConfirm.js') }}"></script>

@endsection