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

            <h3 class="text-center">Meta de hoje</h3>

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

@endsection
