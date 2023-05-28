@extends('layouts.app')

@section('content')

<div class="container">
    @if($user->daily_calories > 0 && $user->daily_carbohydrate > 0 && $user->daily_protein > 0 && $user->daily_fat > 0)
    <div class="row d-flex justify-content-center mt-5">
        
        <h3 class="text-center">{{ __('messages.DailyGoal') }}</h3>

        <div class="col-lg-4">
            <canvas id="chart"></canvas>
        </div>

        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-md-8 d-flex justify-content-around">

                <label class="font-weight-bold">
                    <p class="text-center text-danger">• {{ __('messages.Carbohydrate') }}</p>
                    <div class="progress">
                        <div id="progressbarCarbohydrateId" class="progress-bar bg-danger" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="input-group mt-3">
                        <input id="carbohydrateId" type="text" class="form-control bg-light" value="{{__($carbohydratesOfTheDay)}} / {{$user->daily_carbohydrate}}" disabled>
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
                        <input id="proteinId" type="text" class="form-control bg-light" value="{{__($proteinOfTheDay)}} / {{$user->daily_protein}}" disabled>
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
                        <input id="fatId" type="text" class="form-control bg-light" value="{{__($totalFatOfTheDay)}} / {{$user->daily_fat}}" disabled>
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
                    <input id="caloriesId" type="text" class="form-control bg-light" value="{{__($caloriesOfTheDay)}} / {{$user->daily_calories}}" disabled>
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Kcal</span>
                    </div>
                </div>
            </label>

        </div>

        <p class="text-center mt-3">{{ __('messages.SearchGoalDescription') }}</p>


        <form method="POST" action="{{ route('goal.search') }}">
            @csrf
            <div class="form-group d-flex justify-content-center">
                <div class="col-md-3">
                    <input type="date" name="date" value="{{ $date }}" class="form-control">
                </div>
            </div>

            <div class="form-group d-flex justify-content-center mt-1">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary col-md-12">{{__('messages.Search')}}</button>
                </div>
            </div>

        </form>

    </div>

    <hr class="mt-5">

    <div class="col-md-12">

        <h3 class="text-center">{{ __('messages.DailyIntake') }}</h3>

        <h5 class="text-center mt-3">{{ __('messages.DailyIntakeMessage') }}</h5>

    </div>

    <!--Café da manhã-->

    <div class="row justify-content-center mt-2">

        <table class="table mt-3">
            <thead class="bg-primary text-light">
                <tr>
                    <th colspan="7" class="h5"><strong>{{ __('messages.Breakfast') }}</strong></th>
                    <th>
                        <a class="btn btn-primary border" href="{{ route('goal.add', ['type' => 'breakfast']) }}">{{ __('messages.Add') }}</a>
                    </th>
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
                @foreach($breakfasts as $breakfast)
                @if(!empty($breakfast->name))
                <tr>
                    <td><input type="text" class="form-control bg-light" name="name" value="{{__($breakfast->name)}}" step="any" disabled></th>
                    <td><input type="number" class="form-control bg-light" name="quantity_grams" value="{{__($breakfast->quantity_grams)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="calories" value="{{__($breakfast->calories)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="carbohydrate" value="{{__($breakfast->carbohydrate)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="protein" value="{{__($breakfast->protein)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="total_fat" value="{{__($breakfast->total_fat)}}" step="any" disabled></td>
                    <td>
                        <a href="{{ route('goal.update', ['id' => $breakfast->id, 'type_of_meal' => $breakfast->type_of_meal]) }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                            </svg>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('goal.delete', ['id' => $breakfast->id]) }}" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
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
                    <th colspan="7" class="h5"><strong>{{ __('messages.Lunch') }}</strong></th>
                    <th>
                        <a class="btn btn-primary border" href="{{ route('goal.add', ['type' => 'lunch']) }}">{{ __('messages.Add') }}</a>
                    </th>
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
                @foreach($lunchs as $lunch)
                @if(!empty($lunch->name))
                <tr>
                    <td><input type="text" class="form-control bg-light" name="name" value="{{__($lunch->name)}}" step="any" disabled></th>
                    <td><input type="number" class="form-control bg-light" name="quantity_grams" value="{{__($lunch->quantity_grams)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="calories" value="{{__($lunch->calories)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="carbohydrate" value="{{__($lunch->carbohydrate)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="protein" value="{{__($lunch->protein)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="total_fat" value="{{__($lunch->total_fat)}}" step="any" disabled></td>
                    <td>
                        <a href="{{ route('goal.update', ['id' => $lunch->id, 'type_of_meal' => $lunch->type_of_meal]) }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                            </svg>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('goal.delete', ['id' => $lunch->id]) }}" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
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
                    <th colspan="7" class="h5"><strong>{{ __('messages.Snack') }}</strong></th>
                    <th>
                        <a class="btn btn-primary border" href="{{ route('goal.add', ['type' => 'snack']) }}">{{ __('messages.Add') }}</a>
                    </th>
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
                @foreach($snacks as $snack)
                @if(!empty($snack->name))
                <tr>
                    <td><input type="text" class="form-control bg-light" name="name" value="{{__($snack->name)}}" step="any" disabled></th>
                    <td><input type="number" class="form-control bg-light" name="quantity_grams" value="{{__($snack->quantity_grams)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="calories" value="{{__($snack->calories)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="carbohydrate" value="{{__($snack->carbohydrate)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="protein" value="{{__($snack->protein)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="total_fat" value="{{__($snack->total_fat)}}" step="any" disabled></td>
                    <td>
                        <a href="{{ route('goal.update', ['id' => $snack->id, 'type_of_meal' => $snack->type_of_meal]) }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                            </svg>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('goal.delete', ['id' => $snack->id]) }}" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
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
                    <th colspan="7" class="h5"><strong>{{ __('messages.Dinner') }}</strong></th>
                    <th>
                        <a class="btn btn-primary border" href="{{ route('goal.add', ['type' => 'dinner']) }}">{{ __('messages.Add') }}</a>
                    </th>
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
                @foreach($dinners as $dinner)
                @if(!empty($dinner->name))
                <tr>
                    <td><input type="text" class="form-control bg-light" name="name" value="{{__($dinner->name)}}" step="any" disabled></th>
                    <td><input type="number" class="form-control bg-light" name="quantity_grams" value="{{__($dinner->quantity_grams)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="calories" value="{{__($dinner->calories)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="carbohydrate" value="{{__($dinner->carbohydrate)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="protein" value="{{__($dinner->protein)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="total_fat" value="{{__($dinner->total_fat)}}" step="any" disabled></td>
                    <td>
                        <a href="{{ route('goal.update', ['id' => $dinner->id, 'type_of_meal' => $dinner->type_of_meal]) }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                            </svg>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('goal.delete', ['id' => $dinner->id]) }}" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
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
                    <th colspan="7" class="h5"><strong>{{ __('messages.PreWorkout') }}</strong></th>
                    <th>
                        <a class="btn btn-primary border" href="{{ route('goal.add', ['type' => 'pre_workout']) }}">{{ __('messages.Add') }}</a>
                    </th>
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
                @foreach($preWorkouts as $preWorkout)
                @if(!empty($preWorkout->name))
                <tr>
                    <td><input type="text" class="form-control bg-light" name="name" value="{{__($preWorkout->name)}}" step="any" disabled></th>
                    <td><input type="number" class="form-control bg-light" name="quantity_grams" value="{{__($preWorkout->quantity_grams)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="calories" value="{{__($preWorkout->calories)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="carbohydrate" value="{{__($preWorkout->carbohydrate)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="protein" value="{{__($preWorkout->protein)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="total_fat" value="{{__($preWorkout->total_fat)}}" step="any" disabled></td>
                    <td>
                        <a href="{{ route('goal.update', ['id' => $preWorkout->id, 'type_of_meal' => $preWorkout->type_of_meal]) }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                            </svg>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('goal.delete', ['id' => $preWorkout->id]) }}" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
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
                    <th colspan="7" class="h5"><strong>{{ __('messages.PostWorkout') }}</strong></th>
                    <th>
                        <a class="btn btn-primary border" href="{{ route('goal.add', ['type' => 'post_workout']) }}">{{ __('messages.Add') }}</a>
                    </th>
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
                @foreach($postWorkouts as $postWorkout)
                @if(!empty($postWorkout->name))
                <tr>
                    <td><input type="text" class="form-control bg-light" name="name" value="{{__($postWorkout->name)}}" step="any" disabled></th>
                    <td><input type="number" class="form-control bg-light" name="quantity_grams" value="{{__($postWorkout->quantity_grams)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="calories" value="{{__($postWorkout->calories)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="carbohydrate" value="{{__($postWorkout->carbohydrate)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="protein" value="{{__($postWorkout->protein)}}" step="any" disabled></td>
                    <td><input type="number" class="form-control bg-light" name="total_fat" value="{{__($postWorkout->total_fat)}}" step="any" disabled></td>
                    <td>
                        <a href="{{ route('goal.update', ['id' => $postWorkout->id, 'type_of_meal' => $postWorkout->type_of_meal]) }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                            </svg>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('goal.delete', ['id' => $postWorkout->id]) }}" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                            </svg>
                        </a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>

    </div>

    @else
    <div class="row mt-5">

        <div class="col-lg-5 mt-5">
            <h1 class="fw-bolder">{{ __('messages.SetGoalsDescription') }}</h1>
            <h5>{{ __('messages.SetGoalsDescription1') }}</h5>
            <a class="btn btn-primary col-lg-5 p-2 mt-3" href="{{ route('profile') }}">{{ __('messages.Profile') }}</a>
        </div>
        <img src="{{ asset('img/metas.png') }}" class="col-lg-5">
    </div>
    @endif

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/goal/index/progressBar.js') }}"></script>
<script type="module" src="{{asset('js/goal/index/graph.js')}}"></script>

@endsection