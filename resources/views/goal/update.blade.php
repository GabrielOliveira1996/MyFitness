@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center py-5">

    <div class="row">
        <p class="text-center">{{ __('messages.UpdateFoodGoalDescription') }}</p>

        <form method="POST" autocomplete="off">
            @csrf
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">{{ __('messages.Name') }}</th>
                        <th scope="col">{{ __('messages.AmountInGrams') }}</th>
                        <th scope="col">{{ __('messages.Calories') }}</th>
                        <th scope="col">{{ __('messages.Carbohydrate') }}</th>
                        <th scope="col">{{ __('messages.Protein') }}</th>
                        <th scope="col">{{ __('messages.Fat') }}</th>
                        <th scope="col">{{ __('messages.SaturatedFat') }}</th>
                        <th scope="col">{{ __('messages.TransFat') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" class="form-control bg-light @error('name') is-invalid @enderror" name="name" value="{{ $food->name }}" step="any" readonly>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        <td>
                            <div class="input-group mb-3">
                                <input id="quantityGramsId-1" type="number" class="form-control @error('quantity_grams') is-invalid @enderror" name="quantity_grams" value="{{ $food->quantity_grams }}" step="any">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                                @error('quantity_grams')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="quantityCalorieId-1" type="number" class="form-control @error('calories') is-invalid @enderror" name="calories" value="{{ $food->calories }}" step="any">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Kcal</span>
                                </div>
                                @error('calories')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="quantityCarbohydrateId-1" type="number" class="form-control @error('carbohydrate') is-invalid @enderror" name="carbohydrate" value="{{ $food->carbohydrate }}" step="any">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                                @error('carbohydrate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="quantityProteinId-1" type="number" class="form-control @error('protein') is-invalid @enderror" name="protein" value="{{ $food->protein }}" step="any">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                                @error('protein')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="quantityTotalFatId-1" type="number" class="form-control @error('total_fat') is-invalid @enderror" name="total_fat" value="{{ $food->total_fat }}" step="any">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                                @error('total_fat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="quantitySaturatedFatId-1" type="number" class="form-control @error('saturated_fat') is-invalid @enderror" name="saturated_fat" value="{{ $food->saturated_fat }}" step="any">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                                @error('saturated_fat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="quantityTransFatId-1" type="number" class="form-control @error('trans_fat') is-invalid @enderror" name="trans_fat" value="{{ $food->trans_fat }}" step="any">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                                @error('trans_fat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr class="col-lg-12">

            <small class="col-lg-12 text-justify">
                {{ __('messages.AddFoodAlert') }}
            </small>

            <hr class="col-lg-12">

            <div class="col-lg-12 mt-2">
                <button type="submit" class="btn btn-primary col-lg-12">
                    {{ __('messages.Update') }}
                </button>
            </div>
        </form>
    </div>

</div>

<script src="{{ asset('js/goals.js') }}"></script>

@endsection