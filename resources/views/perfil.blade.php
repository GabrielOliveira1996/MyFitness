@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center mt-2">
        
        <h3 class="text-center mt-5">Seja bem-vindo {{$user->name}}.</h3>

        <form method="POST">
            @csrf
            <button type="submit" class="btn btn-primary text-white col-sm-12 m-2">{{__('SALVAR ALTERAÇÕES')}}</button>

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">Perfil</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td>Altura (cm)</td>
                        <td>
                            <input id="statureId" onkeyup="basalMetabolicRateCalculation()" type="text" maxlength="4" class="form-control col-lg-4" name="stature" value="{{$settingGoal->stature}}" step="any">
                        </td> 
                        <td></td>            
                    </tr>
                    <tr>
                        <td>Peso (kg)</td>
                        <td>
                            <input id="weightId" onkeyup="basalMetabolicRateCalculation()" type="number" class="form-control col-lg-4" name="weight" value="{{$settingGoal->weight}}" step="any">
                        </td>      
                        <td></td>    
                    </tr>
                    <tr>
                        <td>Gênero</td> 
                        <td>
                            <input type="hidden" id="genderHiddenId" value="{{$settingGoal->gender}}"><!-- valor de gender escondido, isso deve ser ajustado no futuro -->
                            <select id="genderId" onchange="basalMetabolicRateCalculation()" name="gender" class="form-control col-lg-4">
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                            </select>
                        </td>  
                        <td></td>         
                    </tr>
                    <tr>
                        <td>Idade</td>
                        <td>
                            <input id="ageId" onkeyup="basalMetabolicRateCalculation()" type="number" class="form-control col-lg-4" name="age" value="{{$settingGoal->age}}" step="any">
                        </td>      
                        <td></td>        
                    </tr>
                    <tr>
                        <td>Atividade</td>
                        <td>
                            <input type="hidden" id="activityRateFactorHiddenId" value="{{$settingGoal->activity_rate_factor}}"><!-- valor de activityRateFactor escondido, isso deve ser ajustado no futuro -->
                            <select id="activityRateFactorId" onchange="basalMetabolicRateCalculation()" name="activity_rate_factor" class="form-control col-lg-4">
                                <option value="1.2">Sedentário</option>
                                <option value="1.38">Levemente ativo</option>
                                <option value="1.55">Moderadamente ativo</option> 
                                <option value="1.72">Altamente ativo</option>
                                <option value="1.9">Extremamente ativo</option>
                            </select>
                            
                        </td>       
                        <td></td>
                    </tr>
                    <tr>
                        <td>Objetivo</td>
                        <td>
                            <input type="hidden" id="objectiveHiddenId" value="{{$settingGoal->objective}}">
                            <select id="objectiveId" onchange="basalMetabolicRateCalculation()" name="objective" class="form-control col-lg-4">
                                <option value="Perder peso rápidamente">Perder peso rápidamente</option>
                                <option value="Perder peso lentamente">Perder peso lentamente</option>
                                <option value="Manter o peso">Manter o peso</option> 
                                <option value="Aumentar peso lentamente">Aumentar peso lentamente</option>
                                <option value="Aumentar peso rápidamente">Aumentar peso rápidamente</option>
                            </select>
                        </td>       
                        <td></td>
                    </tr>
                    <tr>

                        <!-- Button trigger modal -->
                        <td>
                            <a style="cursor: pointer;" title="Clique aqui para mais informações." data-toggle="modal" data-target="#typeOfDietModal">
                                Tipo de dieta
                                <img src="{{ asset('img/icons/interrogation.png') }}" height="22">
                            </a>
                        </td>
                        <td>
                            <input type="hidden" id="typeOfDietHiddenId" value="{{$settingGoal->type_of_diet}}">
                            <select id="typeOfDietId" onchange="basalMetabolicRateCalculation()" name="type_of_diet" value="{{$settingGoal->type_of_diet}}" class="form-control col-lg-4">
                                <option value="Padrão">Padrão</option>
                                <option value="Equilibrado">Equilibrado</option>
                                <option value="Pobre em gorduras">Pobre em gorduras</option> 
                                <option value="Rico em proteínas">Rico em proteínas</option>
                                <option value="Cetogénica">Cetogénica (Atkins)</option>
                            </select>
                        </td>
                        <td></td>
                        <!-- Modal -->
                        <div class="modal fade" id="typeOfDietModal" tabindex="-1" role="dialog" aria-labelledby="typeOfDietModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="typeOfDietModalLabel">Tipos de dietas</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>Padrão</p>
                                            <p class="mx-3">Carboidrato 50%, Proteína 20%, Gordura 30%</p>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <p>Equilibrado</p>
                                            <p class="mx-3">Carboidrato 50%, Proteína 25%, Gordura 25%</p>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <p>Pobre em gorduras</p>
                                            <p class="mx-3">Carboidrato 60%, Proteína 25%, Gordura 15%</p>
                                        </div>

                                        <div class="col-lg-12">
                                            <p>Rico em proteínas</p>
                                            <p class="mx-3">Carboidrato 25%, Proteína 40%, Gordura 35%</p>
                                        </div>

                                        <div class="col-lg-12">
                                            <p>Cetogénica (Atkins)</p>
                                            <p class="mx-3">Carboidrato 5%, Proteína 30%, Gordura 65%</p>
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
                        <th scope="col">Resultados</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    
                    <tr>
                        <td><img src="{{ asset('img/icons/flame.png') }}" height="22"> Taxa Metabólica Basal</td>
                        <td>
                            <input id="basalMetabolicRateId" type="number" class="form-control col-lg-4" name="basal_metabolic_rate" value="{{$settingGoal->basal_metabolic_rate}}" step="any" readonly>
                        </td>         
                        <td></td>    
                    </tr>
                    <tr>
                        <td><img src="{{ asset('img/icons/imc.png') }}" height="22"> Índice de Massa Corporal (IMC)</td>
                        <td>
                            <input id="imcId" type="number" class="form-control col-lg-4" name="imc" value="{{$settingGoal->imc}}" step="any" readonly>
                        </td>     
                        <td></td>       
                    </tr>
                    <tr>
                        <td><img src="{{ asset('img/icons/water.png') }}" height="22"> Requisitos de Água (ml)</td>
                        <td>
                            <input id="waterId" type="number" class="form-control col-lg-4" name="water" value="{{$settingGoal->water}}" step="any" readonly>
                        </td>     
                        <td></td>    
                    </tr>
                    
                </tbody>

                <thead>
                    <tr>
                        <th scope="col">Requisitos Calóricos Diários & Macro Nutrientes</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    
                    <tr>
                        <td class="font-weight-bold"><img src="{{ asset('img/icons/flame.png') }}" height="22"> Calorías</td>
                        <td>
                            <input id="dailyCaloriesId" type="number" class="form-control col-lg-4" name="daily_calories" value="{{$settingGoal->daily_calories}}" step="any" readonly>
                        </th>           
                    </tr>
                    <tr>
                        <td class="text-danger font-weight-bold"><img src="{{ asset('img/icons/carboidrato.png') }}" height="22"> Carboidratos</td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="dailyCarbohydrateId" type="number" class="form-control col-lg-4" name="daily_carbohydrate" value="{{$settingGoal->daily_carbohydrate}}" step="any" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td> 
                        <td>
                            <div class="input-group mb-3">
                                <input id="dailyCarbohydrateKcalId" type="number" class="form-control col-lg-4" name="daily_carbohydrate_kcal" value="{{$settingGoal->daily_carbohydrate_kcal}}" step="any" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Kcal</span>
                                </div>
                            </div>
                        </td> 
                    </tr>
                    <tr>
                        <td class="text-primary font-weight-bold"><img src="{{ asset('img/icons/proteina.png') }}" height="22"> Proteínas</td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="dailyProteinId" type="number" class="form-control col-lg-4" name="daily_protein" value="{{$settingGoal->daily_protein}}" step="any" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </th>
                        <td>
                            <div class="input-group mb-3">
                                <input id="dailyProteinKcalId" type="number" class="form-control col-lg-4" name="daily_protein_kcal" value="{{$settingGoal->daily_protein_kcal}}" step="any" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Kcal</span>
                                </div>
                            </div>
                        </th>                     
                    </tr>
                    <tr>
                        <td class="text-warning font-weight-bold"><img src="{{ asset('img/icons/gordura.png') }}" height="22"> Gorduras</td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="dailyFatId" type="number" class="form-control col-lg-4" name="daily_fat" value="{{$settingGoal->daily_fat}}" step="any" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td> 
                        <td>
                            <div class="input-group mb-3">
                                <input id="dailyFatKcalId" type="number" class="form-control col-lg-4" name="daily_fat_kcal" value="{{$settingGoal->daily_fat_kcal}}" step="any" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Kcal</span>
                                </div>
                            </div>
                        </td>            
                    </tr>
                    
                </tbody>

                <thead>
                    <tr>
                        <th scope="col">Meu Conteúdo</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><img src="{{ asset('img/icons/maca.png') }}" height="22"> Meus Alimentos</td>
                        <td><a href="{{route('allFoodsView')}}" class="text-decoration-none">Abrir<img src="{{ asset('img/icons/seta-direita.png') }}" class="animate__animated animate__slideOutRight animate__infinite	infinite animate__slow" height="22"></a></td> 
                        <td></td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('img/icons/chapeu-de-chef.png') }}" height="22"> Minhas Receitas</td>
                        <td>Abrir<img src="{{ asset('img/icons/seta-direita.png') }}" class="animate__animated animate__slideOutRight animate__infinite	infinite animate__slow" height="22"></td>    
                        <td></td>            
                    </tr>
                    
                </tbody>
            </table>

        </form>

    </div>

</div>


<script src="{{asset('js/tmb.js')}}"></script>
<script src="{{asset('js/inputMasks.js')}}"></script>
<script src="{{asset('js/masks.js')}}"></script>

@endsection