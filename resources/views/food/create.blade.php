@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-lg-6 mt-5">
            <h1 class="fw-bolder mt-5">{{ __('messages.AddFoodTitle') }}</h1>
            <h5>{{ __('messages.AddFoodDescription') }}</h5>
        </div>
        <img src="{{ asset('img/adicionar-alimento.png') }}" class="col-lg-5">
    </div>

    <div class="row">

        <form method="POST" autocomplete="off">
            @csrf

            <hr class="col-lg-12">
            
            <div class="row">
                <div class="col-md inputBox mt-3">
                    <input type="text" class="@error('name') is-invalid @enderror" name="name" step="any">
                    <label class="labelInput">{{ __('messages.Name') }}</label>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            
                <div class="col-md inputBox mt-3">
                    <input type="number" class="@error('quantity_grams') is-invalid @enderror" name="quantity_grams">
                    <label class="labelInput">{{ __('messages.AmountInGrams') }}</label>
                    @error('quantity_grams')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md inputBox mt-3">
                    <input type="number" class="@error('calories') is-invalid @enderror" name="calories">
                    <label class="labelInput">{{ __('messages.Calories') }}</label>
                    @error('calories')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md inputBox mt-3">
                    <input type="number" class="@error('carbohydrate') is-invalid @enderror" name="carbohydrate">
                    <label class="labelInput">{{ __('messages.Carbohydrate') }}</label>
                    @error('carbohydrate')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md inputBox mt-3">
                    <input type="number" class="@error('protein') is-invalid @enderror" name="protein">
                    <label class="labelInput">{{ __('messages.Protein') }}</label>
                    @error('protein')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md inputBox mt-3">
                    <input type="number" class="@error('total_fat') is-invalid @enderror" name="total_fat">
                    <label class="labelInput">{{ __('messages.Fat') }}</label>
                    @error('total_fat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                        
                <div class="col-md inputBox mt-3">
                    <input type="number" class="@error('saturated_fat') is-invalid @enderror" name="saturated_fat">
                    <label class="labelInput">{{ __('messages.SaturatedFat') }}</label>
                    @error('saturated_fat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md inputBox mt-3">
                    <input type="number" class="@error('trans_fat') is-invalid @enderror" name="trans_fat">
                    <label class="labelInput">{{ __('messages.TransFat') }}</label>
                    @error('trans_fat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <hr class="col-lg-12">

            <small class="col-lg-12 text-justify">
                {{ __('messages.AddFoodAlert') }}
            </small>

            <hr class="col-lg-12">

            <div class="row p-2">
                <button type="submit" class="btn btn-primary">
                    {{ __('messages.Add') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection