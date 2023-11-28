@extends('layouts.app')

@section('content')

<div id="goal-index" class="container">

    @if($user->daily_calories == 0 && $user->daily_carbohydrate == 0 && $user->daily_protein == 0 && $user->daily_fat == 0)
        <div class="row mt-5">

            <div class="col-lg-5 mt-5">
                <h1 class="fw-bolder">{{ __('messages.SetGoalsDescription') }}</h1>
                <h5>{{ __('messages.SetGoalsDescription1') }}</h5>
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#GoalModal">
                    {{ __('Atualize seu perfil') }}
                </a>
            </div>
            <img src="{{ asset('img/metas.png') }}" class="col-lg-5">
        </div>
    @else
        <!-- Goal Modal -->
        <div class="modal fade" id="GoalModal" tabindex="-1" aria-labelledby="GoalModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="GoalModalLabel">
                            <strong class="d-flex justify-content-center">
                                {{ __('Suas Metas') }}
                            </strong>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <form method="POST" action="{{ route('goal.save') }}" autocomplete="off">
                                @csrf
                                
                                <div data-user-type-of-diet="{{ $user->type_of_diet }}">
                                    <div class="row">
                                        <div class="col-md-3">

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <strong><p>{{auth()->user()->name}}, abaixo está a distribuição percentual de cada macronutriente que você precisa consumir, com base no seu tipo de dieta.</p></strong>
                                            </div>

                                            <hr class="mt-2"/>

                                            <div class="col-md-12">

                                                <div class="text-danger">
                                                    <img src="{{ asset('img/icons/carboidrato.png') }}" height="22"> 
                                                    {{ __('messages.Carbohydrate') }}
                                                    @{{ carbohydratePercentage }}
                                                </div>
                                                <div class="text-primary">
                                                    <img src="{{ asset('img/icons/proteina.png') }}" height="22">
                                                    {{ __('messages.Protein') }}
                                                    @{{ proteinPercentage }}
                                                </div>
                                                <div class="text-warning">
                                                    <img src="{{ asset('img/icons/gordura.png') }}" height="22">
                                                    {{ __('messages.Fat') }}
                                                    @{{ fatPercentage }}
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>{{ __('messages.Height') }}</label>
                                                    <input :id="statureId" @keyup="calculations()" type="text" maxlength="3" class="form-control @error('stature') is-invalid @enderror" name="stature" value="{{$user->stature}}" step="any">
                                                </div>

                                                <div class="col-md-4">
                                                    <label>{{ __('messages.Weight') }} (kg)</label>
                                                    <input :id="weightId" @keyup="calculations()" type="text" maxlength="3" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{$user->weight}}" step="any">
                                                </div>

                                                <div class="col-md-4">
                                                    <label>{{ __('messages.Age') }}</label>
                                                    <input :id="ageId" @keyup="calculations()" type="text" class="form-control col-lg-4 @error('age') is-invalid @enderror" name="age" value="{{$user->age}}" step="any">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{ __('messages.Gender') }}</label>
                                                    <select :id="genderId" @change="calculations()" name="gender" class="form-control col-lg-4 @error('gender') is-invalid @enderror">
                                                        <option value="1" {{ $user->gender == '1' ? 'selected' : ''}}>{{ __('messages.Masculine') }}</option>
                                                        <option value="2" {{ $user->gender == '2' ? 'selected' : ''}}>{{ __('messages.Feminine') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{ __('messages.Activity') }}</label>
                                                    <select :id="activityRateFactorId" @change="calculations()" name="activity_rate_factor" class="form-control col-lg-4 @error('activity_rate_factor') is-invalid @enderror">
                                                        <option value="1.2" {{ $user->activity_rate_factor == 1.2 ? 'selected' : '' }}>{{ __('messages.Sedentary') }}</option>
                                                        <option value="1.38" {{ $user->activity_rate_factor == 1.38 ? 'selected' : '' }}>{{ __('messages.SlightlyActive') }}</option>
                                                        <option value="1.55" {{ $user->activity_rate_factor == 1.55 ? 'selected' : '' }}>{{ __('messages.ModeratelyActive') }}</option>
                                                        <option value="1.72" {{ $user->activity_rate_factor == 1.72 ? 'selected' : '' }}>{{ __('messages.HighlyActive') }}</option>
                                                        <option value="1.9" {{ $user->activity_rate_factor == 1.9 ? 'selected' : '' }}>{{ __('messages.ExtremelyActive') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{ __('messages.Objetive') }}</label>
                                                    <select :id="objectiveId" @change="calculations()" name="objective" class="form-control col-lg-4 @error('objetive') is-invalid @enderror">
                                                        <option value="1" {{ $user->objective == '1' ? 'selected' : '' }}>{{ __('messages.LoseWeightFast') }}</option>
                                                        <option value="2" {{ $user->objective == '2' ? 'selected' : '' }}>{{ __('messages.LoseWeightSlowly') }}</option>
                                                        <option value="3" {{ $user->objective == '3' ? 'selected' : '' }}>{{ __('messages.KeepWeight') }}</option>
                                                        <option value="4" {{ $user->objective == '4' ? 'selected' : '' }}>{{ __('messages.IncreaseWeightSlowly') }}</option>
                                                        <option value="5" {{ $user->objective == '5' ? 'selected' : '' }}>{{ __('messages.GainWeightFast') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- Type Of Diet -->
                                                    <a style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="O tipo da dieta determina a proporção de cada macronutriente que será incorporada em sua ingestão.">
                                                        {{ __('messages.TypeOfDiet') }}
                                                        <img src="{{ asset('img/icons/interrogation.png') }}" height="22">
                                                    </a>
                                                    <select :id="typeOfDietId" @change="calculations()" name="type_of_diet" value="{{$user->type_of_diet}}" class="form-control col-lg-4 @error('type_of_diet') is-invalid @enderror">
                                                        <option value="1" {{ $user->type_of_diet == '1' ? 'selected' : '' }}>{{ __('messages.Pattern') }}</option>
                                                        <option value="2" {{ $user->type_of_diet == '2' ? 'selected' : '' }}>{{ __('messages.Balanced') }}</option>
                                                        <option value="3" {{ $user->type_of_diet == '3' ? 'selected' : '' }}>{{ __('messages.LowInFat') }}</option>
                                                        <option value="4" {{ $user->type_of_diet == '4' ? 'selected' : '' }}>{{ __('messages.RichInProtein') }}</option>
                                                        <option value="5" {{ $user->type_of_diet == '5' ? 'selected' : '' }}>{{ __('messages.Ketogenic') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>    

                                    <hr/>

                                    <table class="table">

                                        <thead>
                                            <tr>
                                                <th colspan="4">{{ __('messages.DailyCaloricRequirements&MacroNutrients') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <tr>
                                                <td colspan="3"><img src="{{ asset('img/icons/imc.png') }}" height="22"> {{ __('messages.BodyMassIndex') }}</td>
                                                <td>
                                                    <input :id="imcId" type="number" class="form-control col-lg-4 @error('imc') is-invalid @enderror" name="imc" value="{{$user->imc}}" step="any" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="{{ asset('img/icons/water.png') }}" height="22"> {{ __('messages.WaterRequirements') }}</td>
                                                <td>
                                                    <input :id="waterId" type="number" class="form-control col-lg-4 @error('water') is-invalid @enderror" name="water" value="{{$user->water}}" step="any" readonly>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="font-weight-bold col-lg-4" colspan="2"><img src="{{ asset('img/icons/flame.png') }}" height="22"> {{ __('messages.Calories') }}</td>
                                                <td class="col-lg-8" colspan="2">
                                                    <input :id="dailyCaloriesId" type="number" class="form-control col-lg-4 @error('daily_calories') is-invalid @enderror" name="daily_calories" value="{{$user->daily_calories}}" step="any" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-danger font-weight-bold col-lg-6" colspan="2"><img src="{{ asset('img/icons/carboidrato.png') }}" height="22"> {{ __('messages.Carbohydrate') }}</td>
                                                <td class="col-lg-4" colspan="1">
                                                    <div class="input-group">
                                                        <input :id="dailyCarbohydrateId" type="number" class="form-control @error('daily_carbohydrate') is-invalid @enderror" name="daily_carbohydrate" value="{{$user->daily_carbohydrate}}" step="any" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">g</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="col-lg-4" colspan="1">
                                                    <div class="input-group">
                                                        <input :id="dailyCarbohydrateKcalId" type="number" class="form-control @error('daily_carbohydrate_kcal') is-invalid @enderror" name="daily_carbohydrate_kcal" value="{{$user->daily_carbohydrate_kcal}}" step="any" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">Kcal</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary font-weight-bold col-lg-4" colspan="2"><img src="{{ asset('img/icons/proteina.png') }}" height="22"> {{ __('messages.Protein') }}</td>
                                                <td class="col-lg-4" colspan="1">
                                                    <div class="input-group">
                                                        <input :id="dailyProteinId" type="number" class="form-control col-lg-4 @error('daily_protein') is-invalid @enderror" name="daily_protein" value="{{$user->daily_protein}}" step="any" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">g</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="col-lg-4" colspan="1">
                                                    <div class="input-group">
                                                        <input :id="dailyProteinKcalId" type="number" class="form-control col-lg-4 @error('daily_protein_kcal') is-invalid @enderror" name="daily_protein_kcal" value="{{$user->daily_protein_kcal}}" step="any" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">Kcal</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-warning font-weight-bold col-lg-4" colspan="2"><img src="{{ asset('img/icons/gordura.png') }}" height="22"> {{ __('messages.Fat') }}</td>
                                                <td class="col-lg-4" colspan="1">
                                                    <div class="input-group">
                                                        <input :id="dailyFatId" type="number" class="form-control col-lg-4 @error('daily_fat') is-invalid @enderror" name="daily_fat" value="{{$user->daily_fat}}" step="any" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">g</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="col-lg-4" colspan="1">
                                                    <div class="input-group">
                                                        <input :id="dailyFatKcalId" type="number" class="form-control col-lg-4 @error('daily_fat_kcal') is-invalid @enderror" name="daily_fat_kcal" value="{{$user->daily_fat_kcal}}" step="any" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">Kcal</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>
                                </div>
                                
                                <div class="row p-2">
                                    <button type="submit" class="btn btn-primary">{{__('messages.SaveEditions')}}</button>
                                </div>

                            </form>

                            <hr/>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        

        <div class="row mt-5">
            
            <h3 class="text-center">{{ __('messages.DailyGoal') }}</h3>

            <div class="row">

                <div class="col-lg-4">
                    <canvas id="chart"></canvas>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Primeiro -->
                            <div class="text-center text-danger">
                                • {{ __('messages.Carbohydrate') }}
                            </div>
                            <div class="progress">
                                <div id="progressbarCarbohydrateId" 
                                        class="progress-bar bg-danger" 
                                        role="progressbar" 
                                        style="width: 0%" 
                                        aria-valuenow="0" 
                                        aria-valuemin="0" 
                                        aria-valuemax="100"></div>
                            </div>
                            <div class="mt-1">
                                <input id="carbohydrateId" 
                                        type="text" 
                                        class="form-control bg-light @if($totalConsumption[0]->total_carbohydrate > $user->daily_carbohydrate) is-invalid @endif" 
                                        value="@if($totalConsumption[0]->total_carbohydrate) {{__($totalConsumption[0]->total_carbohydrate)}} / {{$user->daily_carbohydrate}} (g) @else 0 / {{__($user->daily_carbohydrate)}} @endif" 
                                        disabled/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Segundo -->
                            <div class="text-center text-primary">
                                • {{ __('messages.Protein') }}
                            </div>
                            <div class="progress">
                                <div id="progressbarProteinId" 
                                        class="progress-bar bg-primary" 
                                        role="progressbar" 
                                        style="width: 0%" 
                                        aria-valuenow="0" 
                                        aria-valuemin="0" 
                                        aria-valuemax="100"></div>
                            </div>
                            <div class="mt-1">
                                <input id="proteinId" 
                                        type="text" 
                                        class="form-control bg-light @if($totalConsumption[0]->total_protein > $user->daily_protein) is-invalid title='Proteinas ultrapassou o limite.' @endif" 
                                        value="@if($totalConsumption[0]->total_protein) {{__($totalConsumption[0]->total_protein)}} / {{$user->daily_protein}} (g) @else 0 / {{$user->daily_protein}} @endif" 
                                        disabled/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Terceiro -->
                            <div class="text-center text-warning">
                                • {{ __('messages.Fat') }}
                            </div>
                            <div class="progress">
                                <div id="progressbarTotalFatId" 
                                        class="progress-bar bg-warning" 
                                        role="progressbar" 
                                        style="width: 0%" 
                                        aria-valuenow="0" 
                                        aria-valuemin="0" 
                                        aria-valuemax="100"></div>
                            </div>
                            <div class="mt-1">
                                <input id="fatId" 
                                        type="text" 
                                        class="form-control bg-light @if($totalConsumption[0]->total_fat > $user->daily_fat) is-invalid title='Proteinas ultrapassou o limite.' @endif}}" 
                                        value="@if($totalConsumption[0]->total_fat) {{__($totalConsumption[0]->total_fat)}} / {{$user->daily_fat}} (g) @else 0 / {{$user->daily_fat}} @endif" 
                                        disabled/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <!-- Quarto -->
                        <div class="text-center">
                            • {{ __('messages.Calories') }}
                        </div>
                        <div class="progress">
                            <div id="progressbarCalorieId" 
                                    class="progress-bar bg-success" 
                                    role="progressbar" 
                                    style="width: 0%" 
                                    aria-valuenow="0" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100"></div>
                        </div>
                        <div class="mt-1">
                            <input id="caloriesId" 
                                    type="text" 
                                    class="form-control bg-light" 
                                    value="@if($totalConsumption[0]->total_calories) {{__($totalConsumption[0]->total_calories)}} / {{$user->daily_calories}} (kcal) @else 0 / {{$user->daily_calories}} @endif" 
                                    disabled/>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <a class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#GoalModal">
                            {{ __('Minhas Metas') }}
                        </a>
                        <a class="btn btn-primary m-1" href="{{ route('food.all') }}">
                            {{ __('messages.MyFoods') }}
                        </a>
                        <a class="btn btn-primary m-1" href="{{ route('diet.index') }}">
                            {{ __('Minhas Dietas') }}
                        </a>
                    </div>
                </div>

            </div>

        </div>

        <hr/>

        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">{{ __('messages.DailyIntake') }}</h3>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-7">
                <h5 class="text-center mt-2">{{ __('messages.DailyIntakeMessage') }}</h5>
            </div>
            <div class="row justify-content-center">
                <a class="btn btn-primary col-md-2" 
                    data-bs-toggle="modal" 
                    data-bs-target="#AddGoalModal">
                        {{ __('messages.Add') }}
                </a>
            </div>
        </div>

        <div class="row mt-3">
            <h3 class="text-center">{{ __('Busque por outras metas') }}</h3>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-7">
                <h6 class="text-center">{{ __('messages.SearchGoalDescription') }}</h6>
            </div>
        </div>

        <form @submit.prevent="searchGoalByDate" id="searchForm">
            @csrf
            <div class="form-group d-flex justify-content-center mt-3">
                <div class="col-md-6 inputBox">
                    <input type="date" 
                            name="date" 
                            id="dateInput"
                            value="{{ $date = (new DateTime('now'))->setTimezone(new DateTimeZone('America/Sao_Paulo'))->format('Y-m-d'); }}" 
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

        <!-- Add Goal Modal -->
        <div class="modal fade" id="AddGoalModal" tabindex="-1" aria-labelledby="AddGoalModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="AddGoalModalLabel">
                            <strong class="d-flex justify-content-center">
                                {{ __('Busca por alimentos') }}
                            </strong>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row d-flex justify-content-center mt-3 mx-5">
                            <div class="row mb-5">
                                <img src="{{ asset('img/se-alimentando.png') }}" class="col-lg-6">
                                <div class="col-lg-6 mt-5">
                                    <h1 class="fw-bold">
                                        {{ __('messages.AddFoodToGoalDescriptionTitle') }}
                                    </h1>
                                    <h5 class="mt-2">
                                    {{ __('messages.AddFoodToGoalDescription') }}
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <!-- Search Goal Api -->
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-8 inputBox">
                                <input v-model="foodName" type="text" name="name" @input="searchFoodGoal" required autocomplete="off">
                                <label for="name" class="labelInput">{{__('messages.SearchFood1')}}</label>
                            </div>
                        </div>

                        <hr class="col-md-12 mt-3"/>

                        <div class="row">
                                
                                <div v-for="(food, index) in foods" :key="index" class="col-md-6 p-1 mt-3">

                                    <form method="POST" action="{{ route('goal.add', ['date' => $date]) }}" id="addForm">
                                        @csrf

                                        <div class="card selected-card m-1">
                                            <div class="card-header">
                                                <div class="row d-flex justify-content-between">
                                                    <div class="col-md-12">
                                                        <input type="text" 
                                                                class="emptyInput @error('name') is-invalid @enderror" 
                                                                name="name" 
                                                                :value="food ? food.name : ''" 
                                                                step="any"
                                                                required 
                                                                readonly
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="inputBox col-md-6">
                                                        <input :id="'quantityGramsId-' + index" 
                                                                @input="(e) => quantityGramsModify(e, index)"
                                                                type="number" 
                                                                class="quantity-grams-to-add @error('quantity_grams') is-invalid @enderror" 
                                                                name="quantity_grams" 
                                                                :value="food ? food.quantity_grams : ''" 
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
                                                        <input :id="'quantityCalorieId-' + index" 
                                                                type="number" 
                                                                class="emptyInput border-0 @error('calories') is-invalid @enderror" 
                                                                name="calories" 
                                                                :value="food ? food.calories : ''" 
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
                                                        <input :id="'quantityCarbohydrateId-' + index"
                                                                type="number" 
                                                                class="emptyInput border-0 @error('carbohydrate') is-invalid @enderror" 
                                                                name="carbohydrate" 
                                                                :value="food.carbohydrate" 
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
                                                        <input :id="'quantityProteinId-' + index" 
                                                                type="number" 
                                                                class="emptyInput border-0 @error('protein') is-invalid @enderror" 
                                                                name="protein" 
                                                                :value="food.protein" 
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
                                                        <input :id="'quantityTotalFatId-' + index" 
                                                                type="number" 
                                                                class="emptyInput border-0 @error('total_fat') is-invalid @enderror" 
                                                                name="total_fat" 
                                                                :value="food.total_fat" 
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
                                                        <input :id="'quantitySaturatedFatId-' + index" 
                                                                type="number" 
                                                                class="emptyInput border-0 @error('saturated_fat') is-invalid @enderror" 
                                                                name="saturated_fat" 
                                                                :value="food.saturated_fat" 
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
                                                        <input :id="'quantityTransFatId-' + index" 
                                                                type="number" 
                                                                class="emptyInput border-0 @error('trans_fat') is-invalid @enderror" 
                                                                name="trans_fat" 
                                                                :value="food.trans_fat" 
                                                                step="any" 
                                                                readonly 
                                                        />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        {{ __('Tipo') }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="form-control" name="type_of_meal" :id="'typeOfMeal-' + index">
                                                            <option :value="1">Café da manhã</option>
                                                            <option :value="2">Almoço</option>
                                                            <option :value="3">Lanche</option>
                                                            <option :value="4">Jantar</option>
                                                            <option :value="5">Pre Treino</option>
                                                            <option :value="6">Pós Treino</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr class="col-lg-12"/>

                                                <div class="row">
                                                    <button class="btn btn-primary col-md-12" onclick="updateFormActionAddGoal()">{{ __('messages.Add') }}</button>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--Café da manhã-->
        <div class="col-md-12 mt-5">
            
            <div class="row bg-primary p-1 border rounded text-light align-items-center">
                <div class="col-md-12">
                    <div class="h5">{{ __('messages.Breakfast') }}</div>
                </div>
            </div>

            <div class="row" v-for="(goalFood, index) in goalFoods" :key="index">
                <div class="col-md-4 p-1 mt-3" v-if="goalFood.name !== '' && goalFood.type_of_meal == 1">
                    <div class="card m-2 p-0">
                        <div class="card-header bg-primary text-light">@{{ goalFood.name }}</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.AmountInGrams') }}
                                </div>
                                <div class="col-md-6">
                                    @{{ goalFood.quantity_grams }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Calories') }}
                                </div>
                                <div class="col-md-6">
                                    @{{ goalFood.calories }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Carbohydrate') }}
                                </div>
                                <div class="col-md-6">
                                    @{{ goalFood.carbohydrate }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Protein') }}
                                </div>
                                <div class="col-md-6">
                                    @{{ goalFood.protein }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Fat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{ goalFood.total_fat }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.SaturatedFat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{ goalFood.saturated_fat }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.TransFat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{ goalFood.trans_fat }}
                                </div>
                            </div>
                            @if($date === date('Y-m-d'))
                            <hr class="col-lg-12"/>
                            
                            <div class="row">
                                <div class="col-md-5 mt-1">
                                    <a type="button" 
                                        class="btn btn-primary edit-food-btn"
                                        :data-food-id="goalFood.id" 
                                        :data-food-name="goalFood.name" 
                                        :data-food-quantity-grams="goalFood.quantity_grams"
                                        :data-food-calories="goalFood.calories"
                                        :data-food-carbohydrate="goalFood.carbohydrate"
                                        :data-food-protein="goalFood.protein"
                                        :data-food-total-fat="goalFood.total_fat"
                                        :data-food-saturated-fat="goalFood.saturated_fat"
                                        :data-food-trans-fat="goalFood.trans_fat"
                                        :data-food-type-of-meal="goalFood.type_of_meal"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#FoodEditingModal"
                                        @click="passingDataToModal"
                                        title="Editar refeição.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                        {{__('messages.Edit')}}
                                    </a>
                                </div>
                                <div class="col-md-5 mt-1">
                                    <a class="btn btn-danger"
                                        :data-food-index="index"
                                        :data-food-id="goalFood.id"
                                        @click="deleteFoodGoal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                        {{__('messages.Delete')}}
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Almoço-->
        <div class="col-md-12 mt-2">

            <div class="row bg-primary p-1 border rounded text-light align-items-center">
                <div class="col-md-12">
                    <div class="h5">{{ __('messages.Lunch') }}</div>
                </div>
            </div>

            <div class="row" v-for="(goalFood, index) in goalFoods" :key="index">
                <div class="col-md-4 p-1 mt-3" v-if="goalFood.name !== '' && goalFood.type_of_meal == 2">
                    <div class="card m-2 p-0">
                        <div class="card-header bg-primary text-light">@{{goalFood.name}}</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.AmountInGrams') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.quantity_grams}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Calories') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.calories}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Carbohydrate') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.carbohydrate}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Protein') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.protein}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Fat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.total_fat}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.SaturatedFat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.saturated_fat}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.TransFat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.trans_fat}}
                                </div>
                            </div>
                            @if($date === date('Y-m-d'))
                            <hr class="col-lg-12"/>

                            <div class="row">
                                <div class="col-md-5 mt-1">
                                    <a type="button" 
                                        class="btn btn-primary"
                                        :data-food-id="goalFood.id" 
                                        :data-food-name="goalFood.name" 
                                        :data-food-quantity-grams="goalFood.quantity_grams"
                                        :data-food-calories="goalFood.calories"
                                        :data-food-carbohydrate="goalFood.carbohydrate"
                                        :data-food-protein="goalFood.protein"
                                        :data-food-total-fat="goalFood.total_fat"
                                        :data-food-saturated-fat="goalFood.saturated_fat"
                                        :data-food-trans-fat="goalFood.trans_fat"
                                        :data-food-type-of-meal="goalFood.type_of_meal"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#FoodEditingModal"
                                        @click="passingDataToModal"
                                        title="Editar refeição.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                        {{__('messages.Edit')}}
                                    </a>
                                </div>
                                <div class="col-md-5 mt-1">
                                    <a class="btn btn-danger"
                                        :data-food-index="index"
                                        :data-food-id="goalFood.id"
                                        @click="deleteFoodGoal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                        {{__('messages.Delete')}}
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Lanche-->
        <div class="col-md-12 mt-2">
            <div class="row bg-primary p-1 border rounded text-light align-items-center">
                <div class="col-md-12">
                    <div class="h5">{{ __('messages.Snack') }}</div>
                </div>
            </div>

            <div class="row" v-for="(goalFood, index) in goalFoods" :key="index">
                <div class="col-md-4 p-1 mt-3" v-if="goalFood.name !== '' && goalFood.type_of_meal == 3">
                    <div class="card m-2 p-0">
                        <div class="card-header bg-primary text-light">@{{goalFood.name}}</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.AmountInGrams') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.quantity_grams}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Calories') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.calories}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Carbohydrate') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.carbohydrate}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Protein') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.protein}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Fat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.total_fat}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.SaturatedFat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.saturated_fat}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.TransFat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.trans_fat}}
                                </div>
                            </div>
                            @if($date === date('Y-m-d'))
                            <hr class="col-lg-12"/>

                            <div class="row">
                                <div class="col-md-5 mt-1">
                                    <a type="button" 
                                        class="btn btn-primary"
                                        :data-food-id="goalFood.id" 
                                        :data-food-name="goalFood.name" 
                                        :data-food-quantity-grams="goalFood.quantity_grams"
                                        :data-food-calories="goalFood.calories"
                                        :data-food-carbohydrate="goalFood.carbohydrate"
                                        :data-food-protein="goalFood.protein"
                                        :data-food-total-fat="goalFood.total_fat"
                                        :data-food-saturated-fat="goalFood.saturated_fat"
                                        :data-food-trans-fat="goalFood.trans_fat"
                                        :data-food-type-of-meal="goalFood.type_of_meal"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#FoodEditingModal"
                                        @click="passingDataToModal"
                                        title="Editar refeição.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                        {{__('messages.Edit')}}
                                    </a>
                                </div>
                                <div class="col-md-5 mt-1">
                                    <a class="btn btn-danger"
                                        :data-food-index="index"
                                        :data-food-id="goalFood.id"
                                        @click="deleteFoodGoal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                        {{__('messages.Delete')}}
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Janta-->
        <div class="col-md-12 mt-2">
            <div class="row bg-primary p-1 border rounded text-light align-items-center">
                <div class="col-md-12">
                    <div class="h5">{{ __('messages.Dinner') }}</div>
                </div>
            </div>

            <div class="row" v-for="(goalFood, index) in goalFoods" :key="index">
                <div class="col-md-4 p-1 mt-3" v-if="goalFood.name !== '' && goalFood.type_of_meal == 4">
                <div class="card m-2 p-0">
                        <div class="card-header bg-primary text-light">@{{goalFood.name}}</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.AmountInGrams') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.quantity_grams}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Calories') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.calories}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Carbohydrate') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.carbohydrate}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Protein') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.protein}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Fat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.total_fat}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.SaturatedFat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.saturated_fat}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.TransFat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.trans_fat}}
                                </div>
                            </div>
                            @if($date === date('Y-m-d'))
                            <hr class="col-lg-12"/>

                            <div class="row">
                                <div class="col-md-5 mt-1">
                                    <a type="button" 
                                        class="btn btn-primary"
                                        :data-food-id="goalFood.id" 
                                        :data-food-name="goalFood.name" 
                                        :data-food-quantity-grams="goalFood.quantity_grams"
                                        :data-food-calories="goalFood.calories"
                                        :data-food-carbohydrate="goalFood.carbohydrate"
                                        :data-food-protein="goalFood.protein"
                                        :data-food-total-fat="goalFood.total_fat"
                                        :data-food-saturated-fat="goalFood.saturated_fat"
                                        :data-food-trans-fat="goalFood.trans_fat"
                                        :data-food-type-of-meal="goalFood.type_of_meal"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#FoodEditingModal"
                                        @click="passingDataToModal"
                                        title="Editar refeição.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                        {{__('messages.Edit')}}
                                    </a>
                                </div>
                                <div class="col-md-5 mt-1">
                                    <a class="btn btn-danger"
                                        :data-food-index="index"
                                        :data-food-id="goalFood.id"
                                        @click="deleteFoodGoal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                        {{__('messages.Delete')}}
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Pré Treino-->
        <div class="col-md-12 mt-2">
            <div class="row bg-primary p-1 border rounded text-light align-items-center">
                <div class="col-md-12">
                    <div class="h5">{{ __('messages.PreWorkout') }}</div>
                </div>
            </div>

            <div class="row" v-for="(goalFood, index) in goalFoods" :key="index">
                <div class="col-md-4 p-1 mt-3" v-if="goalFood.name !== '' && goalFood.type_of_meal == 5">
                <div class="card m-2 p-0">
                        <div class="card-header bg-primary text-light">@{{goalFood.name}}</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.AmountInGrams') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.quantity_grams}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Calories') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.calories}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Carbohydrate') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.carbohydrate}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Protein') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.protein}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Fat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.total_fat}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.SaturatedFat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.saturated_fat}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.TransFat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.trans_fat}}
                                </div>
                            </div>
                            @if($date === date('Y-m-d'))
                            <hr class="col-lg-12"/>

                            <div class="row">
                                <div class="col-md-5 mt-1">
                                    <a type="button" 
                                        class="btn btn-primary"
                                        :data-food-id="goalFood.id" 
                                        :data-food-name="goalFood.name" 
                                        :data-food-quantity-grams="goalFood.quantity_grams"
                                        :data-food-calories="goalFood.calories"
                                        :data-food-carbohydrate="goalFood.carbohydrate"
                                        :data-food-protein="goalFood.protein"
                                        :data-food-total-fat="goalFood.total_fat"
                                        :data-food-saturated-fat="goalFood.saturated_fat"
                                        :data-food-trans-fat="goalFood.trans_fat"
                                        :data-food-type-of-meal="goalFood.type_of_meal"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#FoodEditingModal"
                                        @click="passingDataToModal"
                                        title="Editar refeição.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                        {{__('messages.Edit')}}
                                    </a>
                                </div>
                                <div class="col-md-5 mt-1">
                                    <a class="btn btn-danger"
                                        :data-food-index="index"
                                        :data-food-id="goalFood.id"
                                        @click="deleteFoodGoal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                        {{__('messages.Delete')}}
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Pós Treino-->
        <div class="col-md-12 mt-2">
            <div class="row bg-primary p-1 border rounded text-light align-items-center">
                <div class="col-md-12">
                    <div class="h5">{{ __('messages.PostWorkout') }}</div>
                </div>
            </div>

            <div class="row" v-for="(goalFood, index) in goalFoods" :key="index">
                <div class="col-md-4 p-1 mt-3" v-if="goalFood.name !== '' && goalFood.type_of_meal == 6">
                    <div class="card m-2 p-0">
                        <div class="card-header bg-primary text-light">@{{goalFood.name}}</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.AmountInGrams') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.quantity_grams}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Calories') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.calories}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Carbohydrate') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.carbohydrate}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Protein') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.protein}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.Fat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.total_fat}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.SaturatedFat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.saturated_fat}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('messages.TransFat') }}
                                </div>
                                <div class="col-md-6">
                                    @{{goalFood.trans_fat}}
                                </div>
                            </div>
                            @if($date === date('Y-m-d'))
                            <hr class="col-lg-12"/>

                            <div class="row">
                                <div class="col-md-5 mt-1">
                                    <a type="button" 
                                        class="btn btn-primary"
                                        :data-food-id="goalFood.id" 
                                        :data-food-name="goalFood.name" 
                                        :data-food-quantity-grams="goalFood.quantity_grams"
                                        :data-food-calories="goalFood.calories"
                                        :data-food-carbohydrate="goalFood.carbohydrate"
                                        :data-food-protein="goalFood.protein"
                                        :data-food-total-fat="goalFood.total_fat"
                                        :data-food-saturated-fat="goalFood.saturated_fat"
                                        :data-food-trans-fat="goalFood.trans_fat"
                                        :data-food-type-of-meal="goalFood.type_of_meal"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#FoodEditingModal"
                                        @click="passingDataToModal"
                                        title="Editar refeição.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                        </svg>
                                        {{__('messages.Edit')}}
                                    </a>
                                </div>
                                <div class="col-md-5 mt-1">
                                    <a class="btn btn-danger"
                                        :data-food-index="index"
                                        :data-food-id="goalFood.id"
                                        @click="deleteFoodGoal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                        {{__('messages.Delete')}}
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Edit Goal Modal -->
        <div class="modal fade" id="FoodEditingModal" tabindex="-1" aria-labelledby="FoodEditingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="FoodEditingModalLabel">
                            <strong class="d-flex justify-content-center">
                                {{ __('Editar refeição') }}
                            </strong>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <p class="text-center">{{ __('messages.UpdateFoodGoalDescription') }}</p>

                            <form method="POST" action="{{ route('goal.updatefood', ['date' => $date]) }}" autocomplete="off">
                                @csrf
                                <input type="hidden" name="id" id="id" value="">

                                <hr class="col-lg-12">
                                
                                <div class="row m-1">
                                    <div class="col-md inputBox mt-3">
                                        <input type="text" 
                                                class="@error('name') is-invalid @enderror" 
                                                name="name" 
                                                required>
                                        <label for="name" class="labelInput">{{ __('messages.Name') }}</label>
                                    </div>
                                </div>
                                
                                <div class="row m-1">
                                    <div class="col-md inputBox mt-3">
                                        <input id="quantityGramsIdU"
                                                v-model="quantityGramsIdU"
                                                type="text" 
                                                class="@error('quantity_grams') is-invalid @enderror" 
                                                name="quantity_grams"
                                                required
                                                @input="quantityGramsModifyU">
                                        <label for="quantity_grams" class="labelInput">{{ __('messages.AmountInGrams') }}</label>
                                    </div>

                                    <div class="col-md inputBox mt-3">
                                        <input id="quantityCalorieIdU"
                                                v-model="quantityCalorieIdU"
                                                type="text" 
                                                class="@error('calories') is-invalid @enderror" 
                                                name="calories" 
                                                required>
                                        <label for="calories" class="labelInput">{{ __('messages.Calories') }}</label>
                                    </div>
                                </div>

                                <div class="row m-1">
                                    <div class="col-md inputBox mt-3">
                                        <input id="quantityCarbohydrateIdU"
                                                v-model="quantityCarbohydrateIdU"
                                                type="text" 
                                                class="@error('carbohydrate') is-invalid @enderror" 
                                                name="carbohydrate" 
                                                required>
                                        <label for="carbohydrate" class="labelInput">{{ __('messages.Carbohydrate') }}</label>
                                    </div>

                                    <div class="col-md inputBox mt-3">
                                        <input id="quantityProteinIdU"
                                                v-model="quantityProteinIdU"
                                                type="text" 
                                                class="@error('protein') is-invalid @enderror" 
                                                name="protein" 
                                                required>
                                        <label for="protein" class="labelInput">{{ __('messages.Protein') }}</label>
                                    </div>

                                    <div class="col-md inputBox mt-3">
                                        <input id="quantityTotalFatIdU"
                                                v-model="quantityTotalFatIdU"
                                                type="text" 
                                                class="@error('total_fat') is-invalid @enderror" 
                                                name="total_fat" 
                                                required>
                                        <label for="total_fat" class="labelInput">{{ __('messages.Fat') }}</label>
                                    </div>
                                </div>
                                    
                                <div class="row m-1">
                                    <div class="col-md inputBox mt-3">
                                        <input id="quantitySaturatedFatIdU"
                                                v-model="quantitySaturatedFatIdU"
                                                type="text" 
                                                class="@error('saturated_fat') is-invalid @enderror" 
                                                name="saturated_fat" 
                                                required>
                                        <label for="saturated_fat" class="labelInput">{{ __('messages.SaturatedFat') }}</label>
                                    </div>

                                    <div class="col-md inputBox mt-3">
                                        <input id="quantityTransFatIdU"
                                                v-model="quantityTransFatIdU"
                                                type="text" 
                                                class="@error('trans_fat') is-invalid @enderror" 
                                                name="trans_fat" 
                                                required>
                                        <label for="trans_fat" class="labelInput">{{ __('messages.TransFat') }}</label>
                                    </div>
                                </div>

                                <div class="row m-1">
                                    <div class="col-md mt-3">
                                        <select id="typeOfMealU"
                                                class="form-control" 
                                                name="type_of_meal">
                                            <option value="1">Café da manhã</option>
                                            <option value="2">Almoço</option>
                                            <option value="3">Lanche</option>
                                            <option value="4">Jantar</option>
                                            <option value="5">Pre Treino</option>
                                            <option value="6">Pós Treino</option>
                                        </select>
                                    </div>
                                </div>

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
                </div>
            </div>
        </div>

    @endif
    
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/goal/index/progressBar.js') }}"></script>
<!--<script type="module" src="{{asset('js/goal-graph.js')}}"></script>-->
<script type="module" src="{{asset('js/goal-index.js')}}"></script>
<script src="{{ asset('js/goal/goals-update.js') }}"></script>
<!--<script src="{{ asset('js/goal/teste.js') }}"></script>-->
<!--<script src="{{ asset('js/food/passingDataToTheModal.js') }}"></script>-->
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@endsection