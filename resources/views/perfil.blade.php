@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center mt-2">

        <div class="row mb-3 d-flex justify-content-center mt-5">
            <div class="col-md-3">
                <label for="imageInputId" 
                        class="d-flex justify-content-center">
                    <img id="imageId"
                            src="{{ $user['profile_image'] ? asset('img/' . $user['profile_image']) : asset('img/user-image.png') }}" 
                            class="img rounded-circle img-fluid profile-image col-md-12">
                </label>    
            </div>
        </div>

        <h3 class="text-center">{{ __('messages.WelcomeMessage') }} {{$user->name}}.</h3>
        <hr/>

        <form method="POST" autocomplete="off">
            @csrf
            
            <div id="perfil">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th colspan="4">{{ __('messages.Profile') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">{{ __('messages.Height') }} (cm)</td>
                            <td colspan="1">
                                <input :id="statureId" @keyup="calculations()" type="text" maxlength="3" class="form-control @error('stature') is-invalid @enderror" name="stature" value="{{$user->stature}}" step="any">
                                @error('stature')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">{{ __('messages.Weight') }} (kg)</td>
                            <td colspan="1">
                                <input :id="weightId" @keyup="calculations()" type="text" maxlength="3" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{$user->weight}}" step="any">
                                @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">{{ __('messages.Gender') }}</td>
                            <td colspan="1">
                                <select :id="genderId" @change="calculations()" name="gender" class="form-control col-lg-4 @error('gender') is-invalid @enderror">
                                    <option value="1" {{ $user->gender == '1' ? 'selected' : ''}}>{{ __('messages.Masculine') }}</option>
                                    <option value="2" {{ $user->gender == '2' ? 'selected' : ''}}>{{ __('messages.Feminine') }}</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">{{ __('messages.Age') }}</td>
                            <td colspan="1">
                                <input :id="ageId" @keyup="calculations()" type="text" class="form-control col-lg-4 @error('age') is-invalid @enderror" name="age" value="{{$user->age}}" step="any">
                                @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">{{ __('messages.Activity') }}</td>
                            <td colspan="1">
                                <select :id="activityRateFactorId" @change="calculations()" name="activity_rate_factor" class="form-control col-lg-4 @error('activity_rate_factor') is-invalid @enderror">
                                    <option value="1.2" {{ $user->activity_rate_factor == 1.2 ? 'selected' : '' }}>{{ __('messages.Sedentary') }}</option>
                                    <option value="1.38" {{ $user->activity_rate_factor == 1.38 ? 'selected' : '' }}>{{ __('messages.SlightlyActive') }}</option>
                                    <option value="1.55" {{ $user->activity_rate_factor == 1.55 ? 'selected' : '' }}>{{ __('messages.ModeratelyActive') }}</option>
                                    <option value="1.72" {{ $user->activity_rate_factor == 1.72 ? 'selected' : '' }}>{{ __('messages.HighlyActive') }}</option>
                                    <option value="1.9" {{ $user->activity_rate_factor == 1.9 ? 'selected' : '' }}>{{ __('messages.ExtremelyActive') }}</option>
                                </select>
                                @error('activity_rate_factor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">{{ __('messages.Objetive') }}</td>
                            <td colspan="1">
                                <select :id="objectiveId" @change="calculations()" name="objective" class="form-control col-lg-4 @error('objetive') is-invalid @enderror">
                                    <option value="1" {{ $user->objective == '1' ? 'selected' : '' }}>{{ __('messages.LoseWeightFast') }}</option>
                                    <option value="2" {{ $user->objective == '2' ? 'selected' : '' }}>{{ __('messages.LoseWeightSlowly') }}</option>
                                    <option value="3" {{ $user->objective == '3' ? 'selected' : '' }}>{{ __('messages.KeepWeight') }}</option>
                                    <option value="4" {{ $user->objective == '4' ? 'selected' : '' }}>{{ __('messages.IncreaseWeightSlowly') }}</option>
                                    <option value="5" {{ $user->objective == '5' ? 'selected' : '' }}>{{ __('messages.GainWeightFast') }}</option>
                                </select>
                                @error('objetive')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>

                            <!-- Button trigger modal -->
                            <td colspan="3">
                                <a style="cursor: pointer;" title="Clique aqui para mais informações." data-bs-toggle="modal" data-bs-target="#typeOfDietModal">
                                    {{ __('messages.TypeOfDiet') }}
                                    <img src="{{ asset('img/icons/interrogation.png') }}" height="22">
                                </a>
                            </td>
                            <td>
                                <select :id="typeOfDietId" @change="calculations()" name="type_of_diet" value="{{$user->type_of_diet}}" class="form-control col-lg-4 @error('type_of_diet') is-invalid @enderror">
                                    <option value="1" {{ $user->type_of_diet == '1' ? 'selected' : '' }}>{{ __('messages.Pattern') }}</option>
                                    <option value="2" {{ $user->type_of_diet == '2' ? 'selected' : '' }}>{{ __('messages.Balanced') }}</option>
                                    <option value="3" {{ $user->type_of_diet == '3' ? 'selected' : '' }}>{{ __('messages.LowInFat') }}</option>
                                    <option value="4" {{ $user->type_of_diet == '4' ? 'selected' : '' }}>{{ __('messages.RichInProtein') }}</option>
                                    <option value="5" {{ $user->type_of_diet == '5' ? 'selected' : '' }}>{{ __('messages.Ketogenic') }}</option>
                                </select>
                                @error('type_of_diet')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                            <!-- Modal -->
                            <div class="modal fade" id="typeOfDietModal" tabindex="-1" aria-labelledby="typeOfDietModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-bold" id="typeOfDietModalLabel">{{ __('messages.TypeOfDiet') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    {{ __('messages.ObjetiveMacro') }}
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-lg-12">
                                                    <p class="font-weight-bold">{{ __('messages.Pattern') }}</p>
                                                    <p class="mx-3">

                                                    <div class="col-md-12">
                                                        <div class="text-danger">
                                                            {{ __('messages.Carbohydrate') }}
                                                            {{ __('50%') }}
                                                        </div>
                                                        <div class="text-primary">
                                                            {{ __('messages.Protein') }}
                                                            {{ __('20%') }}
                                                        </div>
                                                        <div class="text-warning">
                                                            {{ __('messages.Fat') }}
                                                            {{ __('30%') }}
                                                        </div>
                                                    </div>

                                                    </p>
                                                </div>

                                                <div class="col-lg-12">
                                                    <p class="font-weight-bold">{{ __('messages.Balanced') }}</p>
                                                    <p class="mx-3">

                                                    <div class="col-md-12">
                                                        <div class="text-danger">
                                                            {{ __('messages.Carbohydrate') }}
                                                            {{ __('50%') }}
                                                        </div>
                                                        <div class="text-primary">
                                                            {{ __('messages.Protein') }}
                                                            {{ __('25%') }}
                                                        </div>
                                                        <div class="text-warning">
                                                            {{ __('messages.Fat') }}
                                                            {{ __('25%') }}
                                                        </div>
                                                    </div>

                                                    </p>
                                                </div>

                                                <div class="col-lg-12">
                                                    <p class="font-weight-bold">{{ __('messages.LowInFat') }}</p>
                                                    <p class="mx-3">

                                                    <div class="col-md-12">
                                                        <div class="text-danger">
                                                            {{ __('messages.Carbohydrate') }}
                                                            {{ __('60%') }}
                                                        </div>
                                                        <div class="text-primary">
                                                            {{ __('messages.Protein') }}
                                                            {{ __('25%') }}
                                                        </div>
                                                        <div class="text-warning">
                                                            {{ __('messages.Fat') }}
                                                            {{ __('15%') }}
                                                        </div>
                                                    </div>

                                                    </p>
                                                </div>

                                                <div class="col-lg-12">
                                                    <p class="font-weight-bold">{{ __('messages.RichInProtein') }}</p>
                                                    <p class="mx-3">

                                                    <div class="col-md-12">
                                                        <div class="text-danger">
                                                            {{ __('messages.Carbohydrate') }}
                                                            {{ __('25%') }}
                                                        </div>
                                                        <div class="text-primary">
                                                            {{ __('messages.Protein') }}
                                                            {{ __('40%') }}
                                                        </div>
                                                        <div class="text-warning">
                                                            {{ __('messages.Fat') }}
                                                            {{ __('35%') }}
                                                        </div>
                                                    </div>

                                                    </p>
                                                </div>

                                                <div class="col-lg-12">
                                                    <p class="font-weight-bold">{{ __('messages.Ketogenic') }}</p>
                                                    <p class="mx-3">

                                                    <div class="col-md-12">
                                                        <div class="text-danger">
                                                            {{ __('messages.Carbohydrate') }}
                                                            {{ __('5%') }}
                                                        </div>
                                                        <div class="text-primary">
                                                            {{ __('messages.Protein') }}
                                                            {{ __('30%') }}
                                                        </div>
                                                        <div class="text-warning">
                                                            {{ __('messages.Fat') }}
                                                            {{ __('65%') }}
                                                        </div>
                                                    </div>

                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </tr>

                    </tbody>

                    <thead>
                        <tr>
                            <th colspan="4">{{ __('messages.Results') }}</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td colspan="3"><img src="{{ asset('img/icons/imc.png') }}" height="22"> {{ __('messages.BodyMassIndex') }}</td>
                            <td>
                                <input :id="imcId" type="number" class="form-control col-lg-4 @error('imc') is-invalid @enderror" name="imc" value="{{$user->imc}}" step="any" readonly>
                                @error('imc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><img src="{{ asset('img/icons/water.png') }}" height="22"> {{ __('messages.WaterRequirements') }}</td>
                            <td>
                                <input :id="waterId" type="number" class="form-control col-lg-4 @error('water') is-invalid @enderror" name="water" value="{{$user->water}}" step="any" readonly>
                                @error('water')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>

                    </tbody>

                    <thead>
                        <tr>
                            <th colspan="4">{{ __('messages.DailyCaloricRequirements&MacroNutrients') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="font-weight-bold col-lg-4" colspan="2"><img src="{{ asset('img/icons/flame.png') }}" height="22"> {{ __('messages.Calories') }}</td>
                            <td class="col-lg-8" colspan="2">
                                <input :id="dailyCaloriesId" type="number" class="form-control col-lg-4 @error('daily_calories') is-invalid @enderror" name="daily_calories" value="{{$user->daily_calories}}" step="any" readonly>
                                @error('daily_calories')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td class="text-danger font-weight-bold col-lg-6" colspan="2"><img src="{{ asset('img/icons/carboidrato.png') }}" height="22"> {{ __('messages.Carbohydrate') }}</td>
                            <td class="col-lg-4" colspan="1">
                                <div class="input-group">
                                    <input :id="dailyCarbohydrateId" type="number" class="form-control @error('daily_carbohydrate') is-invalid @enderror" name="daily_carbohydrate" value="{{$user->daily_carbohydrate}}" step="any" readonly>
                                    @error('daily_carbohydrate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">g</span>
                                    </div>
                                </div>
                            </td>
                            <td class="col-lg-4" colspan="1">
                                <div class="input-group">
                                    <input :id="dailyCarbohydrateKcalId" type="number" class="form-control @error('daily_carbohydrate_kcal') is-invalid @enderror" name="daily_carbohydrate_kcal" value="{{$user->daily_carbohydrate_kcal}}" step="any" readonly>
                                    @error('daily_carbohydrate_kcal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                    @error('daily_protein')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">g</span>
                                    </div>
                                </div>
                            </td>
                            <td class="col-lg-4" colspan="1">
                                <div class="input-group">
                                    <input :id="dailyProteinKcalId" type="number" class="form-control col-lg-4 @error('daily_protein_kcal') is-invalid @enderror" name="daily_protein_kcal" value="{{$user->daily_protein_kcal}}" step="any" readonly>
                                    @error('daily_protein_kcal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                    @error('daily_fat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">g</span>
                                    </div>
                                </div>
                            </td>
                            <td class="col-lg-4" colspan="1">
                                <div class="input-group">
                                    <input :id="dailyFatKcalId" type="number" class="form-control col-lg-4 @error('daily_fat_kcal') is-invalid @enderror" name="daily_fat_kcal" value="{{$user->daily_fat_kcal}}" step="any" readonly>
                                    @error('daily_fat_kcal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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

    </div>

</div>

<script src="{{asset('js/perfil/perfil.js')}}"></script>

@endsection