@extends('layouts.app')


@section('content')

@if($errors->any())
    <div id="modalErrorsValidateFood" class="fixed-bottom col-lg-4 alert alert-danger m-3">
        <div class="text-white d-flex flex-row-reverse">
            <a href="" onclick="closeModalErrorsValidateFood()" style="text-decoration:none;">X</a>
        </div>
        @foreach($errors->all() as $error)
            {{$error}} </br>
        @endforeach
    </div>
@endif

<div class="container d-flex justify-content-center py-5">

    <div class="row">
        <p class="text-center">Você selecionou o alimento {{$food->name}} da sua lista de metas, nesta página você pode realizar alterações no alimento, caso as informações não estejam preenchidas de forma correta.</p>

        <form method="POST" autocomplete="off">
            @csrf            
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
                    <tr>
                        <td>
                            <input type="text" class="form-control bg-light" name="name" value="{{ $food->name }}" step="any" readonly>
                        </th>
                        <td>
                            <div class="input-group mb-3">
                                <input id="quantityGramsId-1" type="number" class="form-control" name="quantity_grams" value="{{ $food->quantity_grams }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="quantityCalorieId-1" type="number" class="form-control" name="calories" value="{{ $food->calories }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Kcal</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="quantityCarbohydrateId-1" type="number" class="form-control" name="carbohydrate" value="{{ $food->carbohydrate }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="quantityProteinId-1" type="number" class="form-control" name="protein" value="{{ $food->protein }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="quantityTotalFatId-1" type="number" class="form-control" name="total_fat" value="{{ $food->total_fat }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="quantitySaturatedFatId-1" type="number" class="form-control" name="saturated_fat" value="{{ $food->saturated_fat }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="quantityTransFatId-1" type="number" class="form-control" name="trans_fat" value="{{ $food->trans_fat }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td>                    
                    </tr>
                </tbody>
            </table>

            <hr class="col-lg-12">

            <small class="col-lg-12 text-justify">
                Pesquise antes de adicionar as informações sobre os alimentos, para que não existam informações incorretas adicionadas em sistema.
            </small>

            <hr class="col-lg-12">

            <div class="col-lg-12 mt-2">
                <button type="submit" class="btn btn-primary col-lg-12">
                    {{ __('Atualizar') }}
                </button>
            </div>    
        </form>
    </div>

</div>

<script src="{{ asset('js/goals.js') }}"></script>

@endsection