@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center mt-2">
        
        <h3 class="text-center mt-5">Seja bem-vindo {{$user->name}}.</h3>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Perfil</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td>Altura (cm)</td>
                    <td><input type="text" class="form-control col-lg-3" name="height" value="{{$settingGoal->stature}}" step="any"></th>               
                </tr>
                <tr>
                    <td>Peso (kg)</td>
                    <td><input type="text" class="form-control col-lg-3" name="weight" value="{{$settingGoal->weight}}" step="any"></th>               
                </tr>
                <tr>
                    <td>Gênero</td> 
                    <td>
                        <select id="genderId" name="gender" class="form-control col-lg-3">
                            <option value="masculine">Masculino</option>
                            <option value="feminine">Feminino</option>
                        </select>
                    </th>               
                </tr>
                <tr>
                    <td>Idade</td>
                    <td><input type="text" class="form-control col-lg-3" name="age" value="{{$settingGoal->age}}" step="any"></th>               
                </tr>
                <tr>
                    <td>Atividade</td>
                    <td>
                        
                        <select id="activityRateFactorId" name="activity_rate_factor" class="form-control col-lg-3">
                            <option value="1.2">Sedentário</option>
                            <option value="1.375">Levemente ativo</option>
                            <option value="1.55">Moderadamente ativo</option> 
                            <option value="1.725">Altamente ativo</option>
                            <option value="1.9">Extremamente ativo</option>
                        </select>
                        
                    </td>       

                </tr>
                <tr>
                    <td>Objetivo</td>
                    <td>
                        <select id="objectiveId" name="objective" class="form-control col-lg-3">
                            <option value="-0.20">Perder peso</option>
                            <option value="-0.10">Perder peso lentamente</option>
                            <option value="0">Manter o peso</option> 
                            <option value="0.10">Aumentar peso lentamente</option>
                            <option value="0.20">Aumentar peso</option>
                        </select>
                    </th>               
                </tr>
                
            </tbody>

            <thead>
                <tr>
                    <th scope="col">Resultados</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                
                <tr>
                    <td><img src="img/icons/flame.png" height="22"> Taxa Metabólica Basal</td>
                    <td><input type="text" class="form-control col-lg-3" name="basal_metabolic_rate" value="{{$settingGoal->basal_metabolic_rate}}" step="any"></th>               
                </tr>
                <tr>
                    <td><img src="img/icons/imc.png" height="22"> Índice de Massa Corporal (IMC)</td>
                    <td><input type="text" class="form-control col-lg-3" name="imc" value="{{$settingGoal->imc}}" step="any"></th>               
                </tr>
                <tr>
                    <td><img src="img/icons/water.png" height="22"> Requisitos de Água (ml)</td>
                    <td><input type="text" class="form-control col-lg-3" name="water" value="{{$settingGoal->water}}" step="any"></th>               
                </tr>
                
            </tbody>

            <thead>
                <tr>
                    <th scope="col">Requisitos Calóricos Diários & Macro Nutrientes</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                
                <tr>
                    <td><img src="img/icons/flame.png" height="22"> Calorías</td>
                    <td><input type="text" class="form-control col-lg-3" name="daily_calories" value="{{$settingGoal->daily_calories}}" step="any"></th>               
                </tr>
                <tr>
                    <td><img src="img/icons/carboidrato.png" height="22"> Carboidratos</td>
                    <td><input type="text" class="form-control col-lg-3" name="daily_carbohydrate" value="{{$settingGoal->daily_carbohydrate}}" step="any"></th>               
                </tr>
                <tr>
                    <td><img src="img/icons/proteina.png" height="22"> Proteínas</td>
                    <td><input type="text" class="form-control col-lg-3" name="daily_protein" value="{{$settingGoal->daily_protein}}" step="any"></th>               
                </tr>
                <tr>
                    <td><img src="img/icons/gordura.png" height="22"> Gorduras</td>
                    <td><input type="text" class="form-control col-lg-3" name="daily_fat" value="{{$settingGoal->daily_fat}}" step="any"></th>               
                </tr>
                
            </tbody>

            <thead>
                <tr>
                    <th scope="col">Meu Conteúdo</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><img src="img/icons/maca.png" height="22"> Meus Alimentos</td>
                    <td><a href="{{route('allFoodsView')}}" class="text-decoration-none">Abrir<img src="img/icons/seta-direita.png" class="animate__animated animate__slideOutRight animate__infinite	infinite animate__slow" height="22"></a></td>   
                </tr>
                <tr>
                    <td><img src="img/icons/chapeu-de-chef.png" height="22"> Minhas Receitas</td>
                    <td>Abrir<img src="img/icons/seta-direita.png" class="animate__animated animate__slideOutRight animate__infinite	infinite animate__slow" height="22"></th>               
                </tr>
                
            </tbody>
        </table>


    </div>

</div>


@endsection