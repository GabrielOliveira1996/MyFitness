@extends('layouts.app')

@section('content')


<div class="container py-5">
    <div class="row">

        <p class="text-center">{{ __('messages.SearchDescription') }}</p>

        <form method="post" autocomplete="off">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <input type="text" name="name" class="form-control">
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <button class="btn btn-primary col-md-3 mt-3">{{ __('messages.Search') }}</button>
            </div>

        </form>

        <p class="text-center mt-5">{{ __('messages.AddFoodToGoalDescription') }}</p>

        @if($errors->any())

        @foreach($errors->all() as $error)
        <div class="d-flex justify-content-center">
            <strong class="text-danger">{{ $error }}</strong>
        </div>
        @endforeach

        @endif

        <table class="table">
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
                    <th scope="col">{{ __('messages.Add') }}</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($foods))
                @foreach($foods as $key => $value)
                <tr>
                    <form method="POST" action="{{ route('goal.addfood', ['type' => $type]) }}">
                        @csrf
                        <td><input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{__($value->name)}}" step="any" readonly></th>
                        <td><input id="quantityGramsId-{{__($key)}}" type="number" class="form-control @error('quantity_grams') is-invalid @enderror" name="quantity_grams" value="{{__($value->quantity_grams)}}" step="any"></td>
                        <td><input id="quantityCalorieId-{{__($key)}}" type="number" class="form-control border-0 @error('calories') is-invalid @enderror" name="calories" value="{{__($value->calories)}}" step="any" readonly></td>
                        <td><input id="quantityCarbohydrateId-{{__($key)}}" type="number" class="form-control border-0 @error('carbohydrate') is-invalid @enderror" name="carbohydrate" value="{{__($value->carbohydrate)}}" step="any" readonly></td>
                        <td><input id="quantityProteinId-{{__($key)}}" type="number" class="form-control border-0 @error('protein') is-invalid @enderror" name="protein" value="{{__($value->protein)}}" step="any" readonly></td>
                        <td><input id="quantityTotalFatId-{{__($key)}}" type="number" class="form-control border-0 @error('total_fat') is-invalid @enderror" name="total_fat" value="{{__($value->total_fat)}}" step="any" readonly></td>
                        <td><input id="quantitySaturatedFatId-{{__($key)}}" type="number" class="form-control border-0 @error('saturated_fat') is-invalid @enderror" name="saturated_fat" value="{{__($value->saturated_fat)}}" step="any" readonly></td>
                        <td><input id="quantityTransFatId-{{__($key)}}" type="number" class="form-control border-0 @error('trans_fat') is-invalid @enderror" name="trans_fat" value="{{__($value->trans_fat)}}" step="any" readonly></td>

                        <td><button class="btn btn-primary">{{ __('messages.Add') }}</button></td>
                    </form>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>

    </div>

    <div class="d-flex justify-content-center mt-5">
        @if(!empty($foods))
        {{$foods->links()}}
        @endif
    </div>

</div>

<script src="{{ asset('js/goals.js') }}"></script>
<script src="{{ url('https://unpkg.com/axios/dist/axios.min.js') }}"></script>

@endsection