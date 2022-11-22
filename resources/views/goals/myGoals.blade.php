@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row d-flex justify-content-center mt-5">
        
        <div class="col-md-12">
            
            <h3 class="text-center">Suas metas</h3>
            
            <div class="row mt-4 justify-content-center">
                <div class="col-md-8 d-flex justify-content-around">

                    <label class="font-weight-bold">Calorias {{__('0')}}</label>

                    <label class="font-weight-bold">Proteínas {{__('0')}}</label>

                    <label class="font-weight-bold">Carboidratos {{__('0')}}</label>

                    <label class="font-weight-bold">Gorduras {{__('0')}}</label>

                </div>
            </div>
            
        </div>
    </div>

    <hr class="mt-5">

    <div class="row d-flex justify-content-center mt-5">
        
        <div class="col-md-12">
            
            <h3 class="text-center">Metas do dia</h3>
            
            <div class="row justify-content-center mt-4">
                <div class="col-md-8 d-flex justify-content-around">

                    <label class="font-weight-bold">Calorias {{__('0')}}</label>

                    <label class="font-weight-bold">Proteínas {{__('0')}}</label>

                    <label class="font-weight-bold">Carboidratos {{__('0')}}</label>

                    <label class="font-weight-bold">Gorduras {{__('0')}}</label>

                </div>
            </div>
            
        </div>
    </div>

    <div class="row justify-content-center mt-2">
            
        <div class="col-md-8 d-flex justify-content-around">

            <div class="progress col-lg-2">
                <div class="progress-bar bg-success" role="progressbar" style="width: 5%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <div class="progress col-lg-2">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 5%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <div class="progress col-lg-2">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 5%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <div class="progress col-lg-2">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 5%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

        </div>

    </div>

    <hr class="mt-5">

    <div class="row">

        <h3 class="text-center">Alimentos</h3>

        <p class="text-center">Adicione alimentos para sua meta do dia.</p>

        <table class="table">
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
                    <th scope="col">Adicionar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($foods as $food)
                <tr>

                    <input id="quantityGramsFixId" type="number" class="d-none" name="quantity_grams" value="{{__($food->quantity_grams)}}" step="any">
                    <input id="quantityCalorieFixId" type="number" class="d-none" name="quantity_grams" value="{{__($food->calories)}}" step="any" readonly>
                    <input id="quantityCarbohydrateFixId" type="number" class="d-none" name="carbohydrate" value="{{__($food->carbohydrate)}}" step="any" readonly>
                    <input id="quantityProteinFixId" type="number" class="d-none" name="protein" value="{{__($food->protein)}}" step="any" readonly>
                    <input id="quantityTotalFatFixId" type="number" class="d-none" name="total_fat" value="{{__($food->total_fat)}}" step="any" readonly>
                    <input id="quantitySaturatedFatFixId" type="number" class="d-none" name="saturated_fat" value="{{__($food->saturated_fat)}}" step="any" readonly>
                    <input id="quantityTransFatFixId" type="number" class="d-none" name="trans_fat" value="{{__($food->trans_fat)}}" step="any" readonly>

                    <td>{{__($food->name)}}</th>
                    <td><input id="quantityGramsId" type="number" class="form-control" name="quantity_grams" value="{{__($food->quantity_grams)}}" step="any"></td>
                    <td><input id="quantityCalorieId" type="number" class="form-control border-0" name="quantity_calories" value="{{__($food->calories)}}" step="any" readonly></td>
                    <td><input id="quantityCarbohydrateId" type="number" class="form-control border-0" name="carbohydrate" value="{{__($food->carbohydrate)}}" step="any" readonly></td>
                    <td><input id="quantityProteinId" type="number" class="form-control border-0" name="protein" value="{{__($food->protein)}}" step="any" readonly></td>
                    <td><input id="quantityTotalFatId" type="number" class="form-control border-0" name="total_fat" value="{{__($food->total_fat)}}" step="any" readonly></td>
                    <td><input id="quantitySaturatedFatId" type="number" class="form-control border-0" name="saturated_fat" value="{{__($food->saturated_fat)}}" step="any" readonly></td>
                    <td><input id="quantityTransFatId" type="number" class="form-control border-0" name="trans_fat" value="{{__($food->trans_fat)}}" step="any" readonly></td>
                    <td><a class="btn btn-primary" href="">Add</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

<script src="{{ url('https://unpkg.com/axios/dist/axios.min.js') }}"></script>
<script src="{{ asset('js/goals.js') }}"></script>

@endsection