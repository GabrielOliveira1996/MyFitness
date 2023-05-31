@extends('layouts.app')


@section('content')

<div class="container d-flex justify-content-center py-5">

    <div class="row">
        <p class="text-center col-lg-12">{{ __('messages.UpdateFoodDescription') }}</p>

        <form method="POST" autocomplete="off">
            @csrf

            <div class="row">
                <div class="col-md inputBox mt-3">
                    <input type="text" 
                            class="@error('name') is-invalid @enderror" 
                            name="name"
                            value="{{ $food->name; }}" 
                            autofocus 
                            required 
                    />
                    <label for="name" 
                            class="labelInput">
                                {{ __('messages.Name') }}
                    </label>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="col-md inputBox mt-3">
                    <input type="number" 
                            class="@error('quantity_grams') is-invalid @enderror" 
                            name="quantity_grams" 
                            value="{{ $food->quantity_grams; }}"
                            required
                    />
                    <label for="quantity_grams" 
                            class="labelInput">
                                {{ __('messages.AmountInGrams') }}
                    </label>
                    @error('quantity_grams')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md inputBox mt-3">
                    <input type="number" 
                            class="@error('calories') is-invalid @enderror" 
                            name="calories" 
                            value="{{ $food->calories; }}"
                            required
                    />
                    <label for="calories" 
                            class="labelInput">
                                {{ __('messages.Calories') }}
                    </label>
                    @error('calories')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md inputBox mt-3">
                    <input type="number" 
                            class="@error('carbohydrate') is-invalid @enderror" 
                            name="carbohydrate" 
                            value="{{ $food->carbohydrate; }}"
                            required
                    />
                    <label for="carbohydrate" 
                            class="labelInput">
                                {{ __('messages.Carbohydrate') }}
                    </label>
                    @error('carbohydrate')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md inputBox mt-3">
                    <input type="number" 
                            class="@error('protein') is-invalid @enderror" 
                            name="protein" 
                            value="{{ $food->protein; }}"
                            required
                    />
                    <label for="protein" 
                            class="labelInput">
                                {{ __('messages.Protein') }}
                    </label>
                    @error('protein')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md inputBox mt-3">
                    <input type="number" 
                            class="@error('total_fat') is-invalid @enderror"
                            name="total_fat" 
                            value="{{ $food->total_fat; }}"
                            required
                    />
                    <label for="total_fat" 
                            class="labelInput">
                                {{ __('messages.Fat') }}
                    </label>
                    @error('total_fat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                        
                <div class="col-md inputBox mt-3">
                    <input type="number" 
                            class="@error('saturated_fat') is-invalid @enderror" 
                            name="saturated_fat" 
                            value="{{ $food->saturated_fat; }}"
                            required
                    />
                    <label for="saturated_fat" 
                            class="labelInput">
                                {{ __('messages.SaturatedFat') }}
                    </label>
                    @error('saturated_fat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md inputBox mt-3">
                    <input type="number" 
                            class="@error('trans_fat') is-invalid @enderror" 
                            name="trans_fat" 
                            value="{{ $food->trans_fat; }}"
                            required
                    />
                    <label for="trans_fat" 
                            class="labelInput">
                                {{ __('messages.TransFat') }}
                    </label>
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
                <button type="submit" class="btn btn-primary col-lg-12">
                    {{ __('messages.Update') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection