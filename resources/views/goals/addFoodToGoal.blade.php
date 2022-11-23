@extends('layouts.app')

@section('content')


<div class="container">
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
                @foreach($foods as $key => $value)
                <tr>
                    <form method="POST">
                        @csrf
                        <td><input type="text" class="form-control" name="name" value="{{__($value->name)}}" step="any" readonly></th>
                        <td><input id="quantityGramsId-{{__($key)}}" type="number" class="form-control" name="quantity_grams" value="{{__($value->quantity_grams)}}" step="any"></td>
                        <td><input id="quantityCalorieId-{{__($key)}}" type="number" class="form-control border-0" name="calories" value="{{__($value->calories)}}" step="any" readonly></td>
                        <td><input id="quantityCarbohydrateId-{{__($key)}}" type="number" class="form-control border-0" name="carbohydrate" value="{{__($value->carbohydrate)}}" step="any" readonly></td>
                        <td><input id="quantityProteinId-{{__($key)}}" type="number" class="form-control border-0" name="protein" value="{{__($value->protein)}}" step="any" readonly></td>
                        <td><input id="quantityTotalFatId-{{__($key)}}" type="number" class="form-control border-0" name="total_fat" value="{{__($value->total_fat)}}" step="any" readonly></td>
                        <td><input id="quantitySaturatedFatId-{{__($key)}}" type="number" class="form-control border-0" name="saturated_fat" value="{{__($value->saturated_fat)}}" step="any" readonly></td>
                        <td><input id="quantityTransFatId-{{__($key)}}" type="number" class="form-control border-0" name="trans_fat" value="{{__($value->trans_fat)}}" step="any" readonly></td>
                        <td><button class="btn btn-primary">{{ __('Add') }}</button></td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="d-flex justify-content-center mt-5">
        {{$foods->links()}}
    </div>

</div>

<script src="{{ asset('js/goals.js') }}"></script>
<script src="{{ url('https://unpkg.com/axios/dist/axios.min.js') }}"></script>

@endsection