@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row d-flex justify-content-center mt-5">

        <div class="col-md-12">

            <h3 class="text-center">Suas metas</h3>

            <div class="row mt-4 justify-content-center">
                <div class="col-md-8 d-flex justify-content-around">

                    <label class="font-weight-bold">
                        Calorias 
                        <input id="goalCaloriesId" type="text" style="background-color:white;" class="form-control border-0" value="{{__($goalCalories)}}" disabled>
                    </label>

                    <label class="font-weight-bold">
                        Carboidratos 
                        <input id="goalProteinId" type="text" style="background-color:white;" class="form-control border-0" value="{{__($goalProtein)}}" disabled>
                    </label>

                    <label class="font-weight-bold">
                        Proteínas 
                        <input id="goalCarbohydrateId" type="text" style="background-color:white;" class="form-control border-0" value="{{__($goalCarbohydrate)}}" disabled>
                    </label>

                    <label class="font-weight-bold">
                        Gorduras 
                        <input id="goalTotalFatId" type="text" style="background-color:white;" class="form-control border-0" value="{{__($goalTotalFat)}}" disabled>
                    </label>

                </div>
            </div>

        </div>

        <h5 class="text-center mt-5">Você ainda não tem metas estabelidas? Clique no botão abaixo e ajudaremos você a obter o melhor resultado para si.<h5>
        
        <div class="d-flex justify-content-center">
            <a class="btn btn-primary mt-3 col-sm-3" href="{{ route('settingGoalsView') }}">ESTABELEÇA SUAS META</a>
        </div>
        
    </div>

    
    <hr class="mt-5"> 


    <div class="col-md-12">

        <h3 class="text-center">Resultados do dia</h3>

        <h5 class="text-center mt-3">Até o momento esse foi a sua ingestão de nutrientes.</h5>

        <div class="flex-row d-flex justify-content-center mt-4">
            
            <div class="d-flex flex-column">
                <label class="d-flex flex-row">
                    Calorias 
                    <input id="todaysCaloriesId" type="text" style="background-color:white;" class="form-control border-0 p-0 mx-2" value="{{__($todaysCalories)}}" disabled>
                </label>
                
                <div class="progress col-lg-8">
                    <div id="progressbarCalorieId" class="progress-bar bg-success" role="progressbar" style="width: 5%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="d-flex flex-column">
                <label class="d-flex flex-row">
                    Carboidratos 
                    <input id="todaysCarbohydrateId" type="text" style="background-color:white;" class="form-control border-0 p-0 mx-2" value="{{__($todaysCarbohydrate)}}" disabled>
                </label>
                <div class="progress col-lg-8">
                    <div id="progressbarCarbohydrateId" class="progress-bar bg-primary" role="progressbar" style="width: 5%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="d-flex flex-column">
                <label class="d-flex flex-row">
                    Proteínas 
                    <input id="todaysProteinId" type="text" style="background-color:white;" class="form-control border-0 p-0 mx-2" value="{{__($todaysProtein)}}" disabled>
                </label>
                <div class="progress col-lg-8">
                    <div id="progressbarProteinId" class="progress-bar bg-danger" role="progressbar" style="width: 5%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="d-flex flex-column">
                <label class="d-flex flex-row">
                    Gorduras 
                    <input id="todaysTotalFatId" type="text" style="background-color:white;" class="form-control border-0 p-0 mx-2" value="{{__($todaysTotalFat)}}" disabled>
                </label>
                <div class="progress col-lg-8">
                    <div id="progressbarFatId" class="progress-bar bg-warning" role="progressbar" style="width: 5%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
             
        </div>

    </div>


    <div class="row justify-content-center mt-2">
        
        <h3 class="text-center mt-5">Consumo de hoje</h3>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Quantidade Em Gramas</th>
                    <th scope="col">Calorias</th>
                    <th scope="col">Carboidratos</th>
                    <th scope="col">Proteínas</th>
                    <th scope="col">Gordura Total</th>
                    <th scope="col">Gordura Saturada</th>
                    <th scope="col">Gordura Trans</th>
                </tr>
            </thead>
            <tbody>
                @foreach($goalFoods as $goalFood)
                    <tr>
                        <td><input type="text" class="form-control" name="name" value="{{__($goalFood->name)}}" step="any" readonly></th>
                        <td><input type="number" class="form-control" name="quantity_grams" value="{{__($goalFood->quantity_grams)}}" step="any" readonly></td>
                        <td><input type="number" class="form-control border-0" name="calories" value="{{__($goalFood->calories)}}" step="any" readonly></td>
                        <td><input type="number" class="form-control border-0" name="carbohydrate" value="{{__($goalFood->carbohydrate)}}" step="any" readonly></td>
                        <td><input type="number" class="form-control border-0" name="protein" value="{{__($goalFood->protein)}}" step="any" readonly></td>
                        <td><input type="number" class="form-control border-0" name="total_fat" value="{{__($goalFood->total_fat)}}" step="any" readonly></td>
                        <td><input type="number" class="form-control border-0" name="saturated_fat" value="{{__($goalFood->saturated_fat)}}" step="any" readonly></td>
                        <td><input type="number" class="form-control border-0" name="trans_fat" value="{{__($goalFood->trans_fat)}}" step="any" readonly></td>                    
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="d-flex justify-content-center">
        <a class="btn btn-primary mt-5" href="{{ route('addFoodToDayGoalView') }}">Adicionar Alimentos</a>
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{$goalFoods->links()}}
    </div>

    <hr class="mt-5">

</div>

<script src="{{ asset('js/macroNutrientProgress.js') }}"></script>

@endsection
