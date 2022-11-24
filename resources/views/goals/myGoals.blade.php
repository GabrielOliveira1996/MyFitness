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
                        <input id="goalCarbohydrateId" type="text" style="background-color:white;" class="form-control border-0" value="{{__($goalCarbohydrate)}}" disabled> 
                    </label>

                    <label class="font-weight-bold">
                        Proteínas 
                        <input id="goalProteinId" type="text" style="background-color:white;" class="form-control border-0" value="{{__($goalProtein)}}" disabled>
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
                    <div id="progressbarCalorieId" class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="d-flex flex-column">
                <label class="d-flex flex-row">
                    Carboidratos 
                    <input id="todaysCarbohydrateId" type="text" style="background-color:white;" class="form-control border-0 p-0 mx-2" value="{{__($todaysCarbohydrate)}}" disabled>
                </label>
                <div class="progress col-lg-8">
                    <div id="progressbarCarbohydrateId" class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="d-flex flex-column">
                <label class="d-flex flex-row">
                    Proteínas 
                    <input id="todaysProteinId" type="text" style="background-color:white;" class="form-control border-0 p-0 mx-2" value="{{__($todaysProtein)}}" disabled>
                </label>
                <div class="progress col-lg-8">
                    <div id="progressbarProteinId" class="progress-bar bg-danger" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="d-flex flex-column">
                <label class="d-flex flex-row">
                    Gorduras 
                    <input id="todaysTotalFatId" type="text" style="background-color:white;" class="form-control border-0 p-0 mx-2" value="{{__($todaysTotalFat)}}" disabled>
                </label>
                <div class="progress col-lg-8">
                    <div id="progressbarTotalFatId" class="progress-bar bg-warning" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
             
        </div>

    </div>


    <div class="row justify-content-center mt-2">
        
        <h3 class="text-center mt-5">Consumo do dia</h3>

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
                    <th scope="col">Remover</th>
                </tr>
            </thead>
            <tbody>
                @foreach($goalFoods as $goalFood)
                    <tr>
                        <td><input type="text" class="form-control border-0" style="background-color:white;" name="name" value="{{__($goalFood->name)}}" step="any" disabled></th>
                        <td><input type="number" class="form-control border-0" style="background-color:white;" name="quantity_grams" value="{{__($goalFood->quantity_grams)}}" step="any" disabled></td>
                        <td><input type="number" class="form-control border-0" style="background-color:white;" name="calories" value="{{__($goalFood->calories)}}" step="any" disabled></td>
                        <td><input type="number" class="form-control border-0" style="background-color:white;" name="carbohydrate" value="{{__($goalFood->carbohydrate)}}" step="any" disabled></td>
                        <td><input type="number" class="form-control border-0" style="background-color:white;" name="protein" value="{{__($goalFood->protein)}}" step="any" disabled></td>
                        <td><input type="number" class="form-control border-0" style="background-color:white;" name="total_fat" value="{{__($goalFood->total_fat)}}" step="any" disabled></td>
                        <td><input type="number" class="form-control border-0" style="background-color:white;" name="saturated_fat" value="{{__($goalFood->saturated_fat)}}" step="any" disabled></td>
                        <td><input type="number" class="form-control border-0" style="background-color:white;" name="trans_fat" value="{{__($goalFood->trans_fat)}}" step="any" disabled></td>                    
                        <td>
                            <a href="{{ route('deleteGoalFood', ['id' => $goalFood->id]) }}" class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg>
                            </a>
                        </td>
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
