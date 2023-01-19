@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="row d-flex justify-content-center mt-5">

        <h3 class="text-center">{{ __('messages.DailyGoal') }}</h3>

        <form method="POST" action="{{ route('searchGoal') }}">
            @csrf
            <div class="d-flex justify-content-center">
                <div class="col-md-4">
                    <input type="date" name="date" value="{{ $dateToInputView }}" class="form-control">
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary col-md-12">Buscar</button>
                </div>
            </div>
        </form>

        <div class="col-lg-4">
            <canvas id="myChart"></canvas>
        </div>

        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-md-8 d-flex justify-content-around">

                <label class="font-weight-bold">
                    <p class="text-center text-danger">• {{ __('messages.Carbohydrate') }}</p>
                    <div class="progress">
                        <div id="progressbarCarbohydrateId" class="progress-bar bg-danger" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="input-group mt-3">
                        <input id="cabohydrateId" type="text" class="form-control bg-light" value="{{__($todaysCarbohydrate)}} / {{$settingGoal->daily_carbohydrate}}" disabled>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">g</span>
                        </div>
                    </div>
                </label>

                <label class="font-weight-bold">
                    <p class="text-center text-primary">• {{ __('messages.Protein') }}</p>
                    <div class="progress">
                        <div id="progressbarProteinId" class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>        
                    <div class="input-group mt-3">
                        <input id="proteinId" type="text" class="form-control bg-light" value="{{__($todaysProtein)}} / {{$settingGoal->daily_protein}}" disabled>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">g</span>
                        </div>
                    </div>     
                </label>

                <label class="font-weight-bold">
                    <p class="text-center text-warning">• {{ __('messages.Fat') }}</p> 
                    <div class="progress">
                        <div id="progressbarTotalFatId" class="progress-bar bg-warning" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="input-group mt-3">
                    <input id="fatId" type="text" class="form-control bg-light" value="{{__($todaysTotalFat)}} / {{$settingGoal->daily_fat}}" disabled>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">g</span>
                        </div>
                    </div>   
                </label>

            </div>
            
            <label class="font-weight-bold col-md-8">
                <p class="text-center">• {{ __('messages.Calories') }}</p> 
                <div class="progress">
                    <div id="progressbarCalorieId" class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="input-group mt-3">
                <input id="caloriesId" type="text" class="form-control bg-light" value="{{__($todaysCalories)}} / {{$settingGoal->daily_calories}}" disabled>
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Kcal</span>
                    </div>
                </div>   
            </label>
            
        </div>

    </div>

    
    <hr class="mt-5"> 

    @if($goalCalories != 0)

        <div class="col-md-12">

            <h3 class="text-center">{{ __('messages.DailyIntake') }}</h3>

            <h5 class="text-center mt-3">{{ __('messages.DailyIntakeMessage') }}</h5>

        </div>

        <div class="d-flex justify-content-center">
            <a class="btn btn-primary col-md-6 mt-5" href="{{ route('addFoodToDayGoalView') }}">{{ __('messages.AddFood') }}</a>
        </div>

        <!--Café da manhã-->

        <div class="row justify-content-center mt-2">

            <table class="table mt-3">
                <thead class="bg-primary text-light">
                    <tr>
                        <th colspan="12" class="h5"><strong>{{ __('messages.Breakfast') }}</strong></th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th scope="col">{{ __('messages.Name') }}</th>
                        <th scope="col">{{ __('messages.AmountInGrams') }}</th>
                        <th scope="col">{{ __('messages.Calories') }}</th>
                        <th scope="col">{{ __('messages.Carbohydrate') }}</th>
                        <th scope="col">{{ __('messages.Protein') }}</th>
                        <th scope="col">{{ __('messages.Fat') }}</th>
                        <th scope="col">{{ __('messages.Edit') }}</th>
                        <th scope="col">{{ __('messages.Delete') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($breakfastGoalFoods as $breakfastGoalFood)
                        @if(!empty($breakfastGoalFood->name))
                            <tr>
                                <td><input type="text" class="form-control bg-light" name="name" value="{{__($breakfastGoalFood->name)}}" step="any" disabled></th>
                                <td><input type="number" class="form-control bg-light" name="quantity_grams" value="{{__($breakfastGoalFood->quantity_grams)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="calories" value="{{__($breakfastGoalFood->calories)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="carbohydrate" value="{{__($breakfastGoalFood->carbohydrate)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="protein" value="{{__($breakfastGoalFood->protein)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="total_fat" value="{{__($breakfastGoalFood->total_fat)}}" step="any" disabled></td>                    
                                <td>
                                    <a href="{{ route('updateFoodToDayGoalView', ['id' => $breakfastGoalFood->id]) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('deleteGoalFood', ['id' => $breakfastGoalFood->id]) }}" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

        </div>

        <!--Almoço-->

        <div class="row justify-content-center mt-2">

            <table class="table mt-3">
                <thead class="bg-primary text-light">
                    <tr>
                        <th colspan="12" class="h5"><strong>{{ __('messages.Lunch') }}</strong></th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th scope="col">{{ __('messages.Name') }}</th>
                        <th scope="col">{{ __('messages.AmountInGrams') }}</th>
                        <th scope="col">{{ __('messages.Calories') }}</th>
                        <th scope="col">{{ __('messages.Carbohydrate') }}</th>
                        <th scope="col">{{ __('messages.Protein') }}</th>
                        <th scope="col">{{ __('messages.Fat') }}</th>
                        <th scope="col">{{ __('messages.Edit') }}</th>
                        <th scope="col">{{ __('messages.Delete') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lunchGoalFoods as $lunchGoalFood)
                        @if(!empty($lunchGoalFood->name))
                            <tr>
                                <td><input type="text" class="form-control bg-light" name="name" value="{{__($lunchGoalFood->name)}}" step="any" disabled></th>
                                <td><input type="number" class="form-control bg-light" name="quantity_grams" value="{{__($lunchGoalFood->quantity_grams)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="calories" value="{{__($lunchGoalFood->calories)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="carbohydrate" value="{{__($lunchGoalFood->carbohydrate)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="protein" value="{{__($lunchGoalFood->protein)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="total_fat" value="{{__($lunchGoalFood->total_fat)}}" step="any" disabled></td>                    
                                <td>
                                    <a href="{{ route('updateFoodToDayGoalView', ['id' => $lunchGoalFood->id]) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('deleteGoalFood', ['id' => $lunchGoalFood->id]) }}" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

        </div>

        <!--Lanche-->

        <div class="row justify-content-center mt-2">

            <table class="table mt-3">
                <thead class="bg-primary text-light">
                    <tr>
                        <th colspan="12" class="h5"><strong>{{ __('messages.Snack') }}</strong></th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th scope="col">{{ __('messages.Name') }}</th>
                        <th scope="col">{{ __('messages.AmountInGrams') }}</th>
                        <th scope="col">{{ __('messages.Calories') }}</th>
                        <th scope="col">{{ __('messages.Carbohydrate') }}</th>
                        <th scope="col">{{ __('messages.Protein') }}</th>
                        <th scope="col">{{ __('messages.Fat') }}</th>
                        <th scope="col">{{ __('messages.Edit') }}</th>
                        <th scope="col">{{ __('messages.Delete') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($snackGoalFoods as $snackGoalFood)
                        @if(!empty($snackGoalFood->name))
                            <tr>
                                <td><input type="text" class="form-control bg-light" name="name" value="{{__($snackGoalFood->name)}}" step="any" disabled></th>
                                <td><input type="number" class="form-control bg-light" name="quantity_grams" value="{{__($snackGoalFood->quantity_grams)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="calories" value="{{__($snackGoalFood->calories)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="carbohydrate" value="{{__($snackGoalFood->carbohydrate)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="protein" value="{{__($snackGoalFood->protein)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="total_fat" value="{{__($snackGoalFood->total_fat)}}" step="any" disabled></td>                    
                                <td>
                                    <a href="{{ route('updateFoodToDayGoalView', ['id' => $snackGoalFood->id]) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('deleteGoalFood', ['id' => $snackGoalFood->id]) }}" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

        </div>

        <!--Janta-->

        <div class="row justify-content-center mt-2">

            <table class="table mt-3">
                <thead class="bg-primary text-light">
                    <tr>
                        <th colspan="12" class="h5"><strong>{{ __('messages.Dinner') }}</strong></th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th scope="col">{{ __('messages.Name') }}</th>
                        <th scope="col">{{ __('messages.AmountInGrams') }}</th>
                        <th scope="col">{{ __('messages.Calories') }}</th>
                        <th scope="col">{{ __('messages.Carbohydrate') }}</th>
                        <th scope="col">{{ __('messages.Protein') }}</th>
                        <th scope="col">{{ __('messages.Fat') }}</th>
                        <th scope="col">{{ __('messages.Edit') }}</th>
                        <th scope="col">{{ __('messages.Delete') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dinnerGoalFoods as $dinnerGoalFood)
                        @if(!empty($dinnerGoalFood->name))
                            <tr>
                                <td><input type="text" class="form-control bg-light" name="name" value="{{__($dinnerGoalFood->name)}}" step="any" disabled></th>
                                <td><input type="number" class="form-control bg-light" name="quantity_grams" value="{{__($dinnerGoalFood->quantity_grams)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="calories" value="{{__($dinnerGoalFood->calories)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="carbohydrate" value="{{__($dinnerGoalFood->carbohydrate)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="protein" value="{{__($dinnerGoalFood->protein)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="total_fat" value="{{__($dinnerGoalFood->total_fat)}}" step="any" disabled></td>                    
                                <td>
                                    <a href="{{ route('updateFoodToDayGoalView', ['id' => $dinnerGoalFood->id]) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('deleteGoalFood', ['id' => $dinnerGoalFood->id]) }}" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

        </div>

        <!--Pré Treino-->

        <div class="row justify-content-center mt-2">

            <table class="table mt-3">
                <thead class="bg-primary text-light">
                    <tr>
                        <th colspan="12" class="h5"><strong>{{ __('messages.PreWorkout') }}</strong></th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th scope="col">{{ __('messages.Name') }}</th>
                        <th scope="col">{{ __('messages.AmountInGrams') }}</th>
                        <th scope="col">{{ __('messages.Calories') }}</th>
                        <th scope="col">{{ __('messages.Carbohydrate') }}</th>
                        <th scope="col">{{ __('messages.Protein') }}</th>
                        <th scope="col">{{ __('messages.Fat') }}</th>
                        <th scope="col">{{ __('messages.Edit') }}</th>
                        <th scope="col">{{ __('messages.Delete') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($preWorkoutGoalFoods as $preWorkoutGoalFood)
                        @if(!empty($preWorkoutGoalFood->name))
                            <tr>
                                <td><input type="text" class="form-control bg-light" name="name" value="{{__($preWorkoutGoalFood->name)}}" step="any" disabled></th>
                                <td><input type="number" class="form-control bg-light" name="quantity_grams" value="{{__($preWorkoutGoalFood->quantity_grams)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="calories" value="{{__($preWorkoutGoalFood->calories)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="carbohydrate" value="{{__($preWorkoutGoalFood->carbohydrate)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="protein" value="{{__($preWorkoutGoalFood->protein)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="total_fat" value="{{__($preWorkoutGoalFood->total_fat)}}" step="any" disabled></td>                    
                                <td>
                                    <a href="{{ route('updateFoodToDayGoalView', ['id' => $preWorkoutGoalFood->id]) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('deleteGoalFood', ['id' => $preWorkoutGoalFood->id]) }}" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

        </div>

        <!--Pós Treino-->

        <div class="row justify-content-center mt-2">

            <table class="table mt-3">
                <thead class="bg-primary text-light">
                    <tr>
                        <th colspan="12" class="h5"><strong>{{ __('messages.PostWorkout') }}</strong></th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th scope="col">{{ __('messages.Name') }}</th>
                        <th scope="col">{{ __('messages.AmountInGrams') }}</th>
                        <th scope="col">{{ __('messages.Calories') }}</th>
                        <th scope="col">{{ __('messages.Carbohydrate') }}</th>
                        <th scope="col">{{ __('messages.Protein') }}</th>
                        <th scope="col">{{ __('messages.Fat') }}</th>
                        <th scope="col">{{ __('messages.Edit') }}</th>
                        <th scope="col">{{ __('messages.Delete') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($postWorkoutGoalFoods as $postWorkoutGoalFood)
                        @if(!empty($postWorkoutGoalFood->name))
                            <tr>
                                <td><input type="text" class="form-control bg-light" name="name" value="{{__($postWorkoutGoalFood->name)}}" step="any" disabled></th>
                                <td><input type="number" class="form-control bg-light" name="quantity_grams" value="{{__($postWorkoutGoalFood->quantity_grams)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="calories" value="{{__($postWorkoutGoalFood->calories)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="carbohydrate" value="{{__($postWorkoutGoalFood->carbohydrate)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="protein" value="{{__($postWorkoutGoalFood->protein)}}" step="any" disabled></td>
                                <td><input type="number" class="form-control bg-light" name="total_fat" value="{{__($postWorkoutGoalFood->total_fat)}}" step="any" disabled></td>                    
                                <td>
                                    <a href="{{ route('updateFoodToDayGoalView', ['id' => $postWorkoutGoalFood->id]) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('deleteGoalFood', ['id' => $postWorkoutGoalFood->id]) }}" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

        </div>
    @endif

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/macroNutrientProgress.js') }}"></script>
<script type="module" src="{{asset('js/graph.js')}}"></script>

@endsection
