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

<div class="container d-flex justify-content-center">

    <div class="row">
        <p class="text-center col-lg-12">Adicione alimentos para melhorar ainda mais os seus resultados.</p>

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
                            <input type="text" class="form-control" name="name" step="any">
                        </th>
                        <td>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="quantity_grams">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="calories">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Kcal</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="carbohydrate">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="protein">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="total_fat">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="saturated_fat">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="trans_fat">
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
                    {{ __('Adicionar') }}
                </button>
            </div>    
        </form>
    </div>
</div>

@endsection