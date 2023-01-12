@extends('layouts.app')

@section('content')


<div class="container py-5">
    <div class="row">

        <p class="text-center">{{ __('messages.SearchDescription') }}</p>

        <form method="post" action="">

            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <button class="btn btn-primary col-md-3 mt-3">{{ __('messages.Search') }}</button>
            </div>

        </form>

        <p class="text-center mt-5">{{ __('messages.AddFoodToGoalDescription') }}</p>

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
                @foreach($foods as $key => $value)
                <tr>
                    <form method="POST">
                        @csrf
                        <td><input type="text" class="form-control" name="name" value="{{__($value->name)}}" step="any" readonly></th>
                        <td><input id="quantityGramsId-{{__($key)}}" type="number" class="form-control" name="quantity_grams" value="{{__($value->quantity_grams)}}" step="any"></td>
                        <td><input id="quantityCalorieId-{{__($key)}}" type="number" class="form-control border-0" name="calories" value="{{__($value->calories)}}" step="any" readonly></td>
                        <td><input id="quantityCarbohydrateId-{{__($key)}}" type="number" class="form-control border-0" name="carbohydrate" value="{{__($value->carbohydrate)}}" step="any" readonly></td>
                        <td><input id="quantityProteinId-{{__($key)}}" type="number" class="form-control border-0" name="protein" value="{{__($value->protein)}}" step="any" readonly></td>
                        <td><input id="quantityTotalFatId-{{__($key)}}" type="number" class="form-control border-0" name="total_fat" value="{{__($value->total_fat)}}" step="any" readonly></td>
                        <td><input id="quantitySaturatedFatId-{{__($key)}}" type="number" class="form-control border-0" name="saturated_fat" value="{{__($value->saturated_fat)}}" step="any" readonly></td>
                        <td><input id="quantityTransFatId-{{__($key)}}" type="number" class="form-control border-0" name="trans_fat" value="{{__($value->trans_fat)}}" step="any" readonly></td>
                        <td><button class="btn btn-primary">{{ __('messages.Add') }}</button></td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="d-flex justify-content-center mt-5">
        {{$foods->links()}}
    </div>

</div>

<script src="{{ asset('js/goals.js') }}"></script>
<script src="{{ url('https://unpkg.com/axios/dist/axios.min.js') }}"></script>

@endsection