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
                        <div id="progressbarCarbohydrateId" 
                                class="progress-bar bg-danger" 
                                role="progressbar" 
                                style="width: 0%" 
                                aria-valuenow="0" 
                                aria-valuemin="0" 
                                aria-valuemax="100"
                        ></div>
                    </div>
                    <div class="mt-3">
                        <input id="carbohydrateId" 
                                type="text" 
                                class="form-control bg-light @if($carbohydratesOfTheDay > $user->daily_carbohydrate) is-invalid title='Carboidrato ultrapassou o limite'. @endif" 
                                value="{{__($carbohydratesOfTheDay)}} / {{$user->daily_carbohydrate}} (g)" 
                                disabled
                        />
                    </div>
                </label>

                <label class="font-weight-bold">
                    <p class="text-center text-primary">• {{ __('messages.Protein') }}</p>
                    <div class="progress">
                        <div id="progressbarProteinId" 
                                class="progress-bar bg-primary" 
                                role="progressbar" 
                                style="width: 0%" 
                                aria-valuenow="0" 
                                aria-valuemin="0" 
                                aria-valuemax="100"
                        ></div>
                    </div>
                    <div class="mt-3">
                        <input id="proteinId" 
                                type="text" 
                                class="form-control bg-light @if($proteinOfTheDay > $user->daily_protein) is-invalid title='Proteinas ultrapassou o limite.' @endif" 
                                value="{{__($proteinOfTheDay)}} / {{$user->daily_protein}} (g)" 
                                disabled
                        />
                    </div>
                </label>

                <label class="font-weight-bold">
                    <p class="text-center text-warning">• {{ __('messages.Fat') }}</p>
                    <div class="progress">
                        <div id="progressbarTotalFatId" 
                                class="progress-bar bg-warning" 
                                role="progressbar" 
                                style="width: 0%" 
                                aria-valuenow="0" 
                                aria-valuemin="0" 
                                aria-valuemax="100"
                        ></div>
                    </div>
                    <div class="mt-3">
                        <input id="fatId" 
                                type="text" 
                                class="form-control bg-light @if($totalFatOfTheDay > $user->daily_fat) is-invalid title='Proteinas ultrapassou o limite.' @endif}}" 
                                value="{{__($totalFatOfTheDay)}} / {{$user->daily_fat}} (g)" 
                                disabled 
                        />
                    </div>
                </label>

            </div>

            <label class="font-weight-bold col-md-8 mt-2">
                <p class="text-center">• {{ __('messages.Calories') }}</p>
                <div class="progress">
                    <div id="progressbarCalorieId" 
                            class="progress-bar bg-success" 
                            role="progressbar" 
                            style="width: 0%" 
                            aria-valuenow="0" 
                            aria-valuemin="0" 
                            aria-valuemax="100"
                    ></div>
                </div>
                <div class="mt-3">
                    <input id="caloriesId" 
                            type="text" 
                            class="form-control bg-light" 
                            value="{{__($caloriesOfTheDay)}} / {{$user->daily_calories}} (kcal)" 
                            disabled
                    />
                </div>
            </label>

        </div>

        <hr class="col-md-12 mt-3"/>

        <div class="col-md-6">
            <p class="mt-3">{{ __('messages.SearchGoalDescription') }}</p>
        </div>

        <form method="POST" action="{{ route('goal.search') }}">
            @csrf
            <div class="form-group d-flex justify-content-center mt-3">
                <div class="col-md-6 inputBox">
                    <input type="date" 
                            name="date" 
                            value="{{ $date }}" 
                            class="text-center" 
                    />
                    <label for="name" 
                            class="labelInput">
                                {{ __('messages.SearchForGoal') }}
                    </label>
                </div>
            </div>

            <div class="form-group d-flex justify-content-center mt-1">
                <div class="col-md-5">
                    <button type="submit" 
                            class="btn btn-primary col-md-12">
                                {{__('messages.Search')}}
                    </button>
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

    <div class="col-md-12 mt-5">

        <div class="row bg-primary p-1 border rounded text-light align-items-center">
            <div class="col-md-10 ">
                <div class="h5">{{ __('messages.Breakfast') }}</div>
            </div>
            <div class="col-md-2">
                <div class="float-right">
                    <a class="btn btn-primary border" 
                        href="{{ route('goal.add', ['type' => 1]) }}">
                            {{ __('messages.Add') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($breakfasts as $breakfast)
                @if(!empty($breakfast->name))
                    <div class="col-md-4 p-1 mt-3">
                        <div class="card m-2 p-0">
                            <div class="card-header bg-primary text-light">{{__($breakfast->name)}}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.AmountInGrams') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($breakfast->quantity_grams)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Calories') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($breakfast->calories)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Carbohydrate') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($breakfast->carbohydrate)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Protein') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($breakfast->protein)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Fat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($breakfast->total_fat)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.SaturatedFat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($breakfast->saturated_fat)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.TransFat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($breakfast->trans_fat)}}
                                    </div>
                                </div>

                                <hr class="col-lg-12"/>

                                <div class="row">
                                    <div class="col-md-5 mt-1">
                                        <a type="button" href="{{ route('goal.update', ['id' => $breakfast->id, 'type_of_meal' => $breakfast->type_of_meal]) }}" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                            {{__('messages.Edit')}}
                                        </a>
                                    </div>
                                    <div class="col-md-5 mt-1">
                                        <a href="{{ route('goal.delete', ['id' => $breakfast->id]) }}" class="btn btn-danger">
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
                @endif
            @endforeach
        </div>
    </div>

    <!--Almoço-->

    <div class="col-md-12 mt-2">

        <div class="row bg-primary p-1 border rounded text-light align-items-center">
            <div class="col-md-10 ">
                <div class="h5">{{ __('messages.Lunch') }}</div>
            </div>
            <div class="col-md-2">
                <div class="float-right">
                    <a class="btn btn-primary border" 
                        href="{{ route('goal.add', ['type' => 2]) }}">
                            {{ __('messages.Add') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($lunchs as $lunch)
                @if(!empty($lunch->name))
                    <div class="col-md-4 p-1 mt-3">
                        <div class="card m-2 p-0">
                            <div class="card-header bg-primary text-light">{{__($lunch->name)}}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.AmountInGrams') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($lunch->quantity_grams)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Calories') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($lunch->calories)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Carbohydrate') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($lunch->carbohydrate)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Protein') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($lunch->protein)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Fat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($lunch->total_fat)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.SaturatedFat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($lunch->saturated_fat)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.TransFat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($lunch->trans_fat)}}
                                    </div>
                                </div>

                                <hr class="col-lg-12"/>

                                <div class="row">
                                    <div class="col-md-5 mt-1">
                                        <a type="button" href="{{ route('goal.update', ['id' => $lunch->id, 'type_of_meal' => $lunch->type_of_meal]) }}" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                            {{__('messages.Edit')}}
                                        </a>
                                    </div>
                                    <div class="col-md-5 mt-1">
                                        <a href="{{ route('goal.delete', ['id' => $lunch->id]) }}" class="btn btn-danger">
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
                @endif
            @endforeach
        </div>
    </div>

    <!--Lanche-->

    <div class="col-md-12 mt-2">
        <div class="row bg-primary p-1 border rounded text-light align-items-center">
            <div class="col-md-10 ">
                <div class="h5">{{ __('messages.Snack') }}</div>
            </div>
            <div class="col-md-2">
                <div class="float-right">
                    <a class="btn btn-primary border" 
                        href="{{ route('goal.add', ['type' => 3]) }}">
                            {{ __('messages.Add') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($snacks as $snack)
                @if(!empty($snack->name))
                    <div class="col-md-4 p-1 mt-3">
                        <div class="card m-2 p-0">
                            <div class="card-header bg-primary text-light">{{__($snack->name)}}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.AmountInGrams') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($snack->quantity_grams)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Calories') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($snack->calories)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Carbohydrate') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($snack->carbohydrate)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Protein') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($snack->protein)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Fat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($snack->total_fat)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.SaturatedFat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($snack->saturated_fat)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.TransFat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($snack->trans_fat)}}
                                    </div>
                                </div>

                                <hr class="col-lg-12"/>

                                <div class="row">
                                    <div class="col-md-5 mt-1">
                                        <a type="button" href="{{ route('goal.update', ['id' => $snack->id, 'type_of_meal' => $snack->type_of_meal]) }}" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                            {{__('messages.Edit')}}
                                        </a>
                                    </div>
                                    <div class="col-md-5 mt-1">
                                        <a href="{{ route('goal.delete', ['id' => $snack->id]) }}" class="btn btn-danger">
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
                @endif
            @endforeach
        </div>
    </div>

    <!--Janta-->

    <div class="col-md-12 mt-2">
        <div class="row bg-primary p-1 border rounded text-light align-items-center">
            <div class="col-md-10 ">
                <div class="h5">{{ __('messages.Dinner') }}</div>
            </div>
            <div class="col-md-2">
                <div class="float-right">
                    <a class="btn btn-primary border" 
                        href="{{ route('goal.add', ['type' => 4]) }}">
                            {{ __('messages.Add') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($dinners as $dinner)
                @if(!empty($dinner->name))
                    <div class="col-md-4 p-1 mt-3">
                        <div class="card m-2 p-0">
                            <div class="card-header bg-primary text-light">{{__($dinner->name)}}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.AmountInGrams') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($dinner->quantity_grams)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Calories') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($dinner->calories)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Carbohydrate') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($dinner->carbohydrate)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Protein') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($dinner->protein)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Fat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($dinner->total_fat)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.SaturatedFat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($dinner->saturated_fat)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.TransFat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($dinner->trans_fat)}}
                                    </div>
                                </div>

                                <hr class="col-lg-12"/>

                                <div class="row">
                                    <div class="col-md-5 mt-1">
                                        <a type="button" href="{{ route('goal.update', ['id' => $dinner->id, 'type_of_meal' => $dinner->type_of_meal]) }}" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                            {{__('messages.Edit')}}
                                        </a>
                                    </div>
                                    <div class="col-md-5 mt-1">
                                        <a href="{{ route('goal.delete', ['id' => $dinner->id]) }}" class="btn btn-danger">
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
                @endif
            @endforeach
        </div>
    </div>

    <!--Pré Treino-->

    <div class="col-md-12 mt-2">
        <div class="row bg-primary p-1 border rounded text-light align-items-center">
            <div class="col-md-10 ">
                <div class="h5">{{ __('messages.PreWorkout') }}</div>
            </div>
            <div class="col-md-2">
                <div class="float-right">
                    <a class="btn btn-primary border" 
                        href="{{ route('goal.add', ['type' => 5]) }}">
                            {{ __('messages.Add') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($preWorkouts as $preWorkout)
                @if(!empty($preWorkout->name))
                    <div class="col-md-4 p-1 mt-3">
                        <div class="card m-2 p-0">
                            <div class="card-header bg-primary text-light">{{__($preWorkout->name)}}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.AmountInGrams') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($preWorkout->quantity_grams)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Calories') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($preWorkout->calories)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Carbohydrate') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($preWorkout->carbohydrate)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Protein') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($preWorkout->protein)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Fat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($preWorkout->total_fat)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.SaturatedFat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($preWorkout->saturated_fat)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.TransFat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($preWorkout->trans_fat)}}
                                    </div>
                                </div>

                                <hr class="col-lg-12"/>

                                <div class="row">
                                    <div class="col-md-5 mt-1">
                                        <a type="button" href="{{ route('goal.update', ['id' => $preWorkout->id, 'type_of_meal' => $preWorkout->type_of_meal]) }}" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                            {{__('messages.Edit')}}
                                        </a>
                                    </div>
                                    <div class="col-md-5 mt-1">
                                        <a href="{{ route('goal.delete', ['id' => $preWorkout->id]) }}" class="btn btn-danger">
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
                @endif
            @endforeach
        </div>
    </div>

    <!--Pós Treino-->

    <div class="col-md-12 mt-2">
        <div class="row bg-primary p-1 border rounded text-light align-items-center">
            <div class="col-md-10 ">
                <div class="h5">{{ __('messages.PostWorkout') }}</div>
            </div>
            <div class="col-md-2">
                <div class="float-right">
                    <a class="btn btn-primary border" 
                        href="{{ route('goal.add', ['type' => 6]) }}">
                            {{ __('messages.Add') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($postWorkouts as $postWorkout)
                @if(!empty($postWorkout->name))
                    <div class="col-md-4 p-1 mt-3">
                        <div class="card m-2 p-0">
                            <div class="card-header bg-primary text-light">{{__($postWorkout->name)}}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.AmountInGrams') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($postWorkout->quantity_grams)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Calories') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($postWorkout->calories)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Carbohydrate') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($postWorkout->carbohydrate)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Protein') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($postWorkout->protein)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.Fat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($postWorkout->total_fat)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.SaturatedFat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($postWorkout->saturated_fat)}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ __('messages.TransFat') }}
                                    </div>
                                    <div class="col-md-6">
                                        {{__($postWorkout->trans_fat)}}
                                    </div>
                                </div>

                                <hr class="col-lg-12"/>

                                <div class="row">
                                    <div class="col-md-5 mt-1">
                                        <a type="button" href="{{ route('goal.update', ['id' => $postWorkout->id, 'type_of_meal' => $postWorkout->type_of_meal]) }}" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                            {{__('messages.Edit')}}
                                        </a>
                                    </div>
                                    <div class="col-md-5 mt-1">
                                        <a href="{{ route('goal.delete', ['id' => $postWorkout->id]) }}" class="btn btn-danger">
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
                @endif
            @endforeach
        </div>
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