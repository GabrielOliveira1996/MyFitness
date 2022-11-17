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

    <div class="card col-lg-6 rounded-0">
        <div class="card-body">

            <p class="text-center">Adicione alimentos para melhorar ainda mais seus cálculos.</p>
            
            <form method="POST" autocomplete="off">
                @csrf
                <div class="d-flex flex-column offset-lg-3">
                    <div class="col-lg-8 mt-2">
                        <input type="text" name="name" class="form-control" placeholder="Nome">
                    </div>
                    <div class="col-lg-8 mt-2">
                        <input type="text" name="protein" class="form-control" placeholder="Proteína">
                    </div>
                    <div class="col-lg-8 mt-2">
                        <input type="text" name="carbohydrate" class="form-control" placeholder="Carboidrato">
                    </div>
                    <div class="col-lg-8 mt-2">
                        <input type="text" name="saturated_fat" class="form-control" placeholder="Gordura Saturada">
                    </div>
                    <div class="col-lg-8 mt-2">
                        <input type="text" name="monounsaturated_fat" class="form-control" placeholder="Gordura Monoinsaturada">
                    </div>
                    <div class="col-lg-8 mt-2">
                        <input type="text" name="polyunsaturated_fat" class="form-control" placeholder="Gordura Poli-insaturada">
                    </div>

                    <hr class="col-lg-8">

                    <small class="col-lg-8 text-justify">
                        Pesquise antes de adicionar as informações sobre os alimentos, para que não existam informações incorretas adicionadas em sistema.
                    </small>

                    <hr class="col-lg-8">

                    <div class="col-lg-8 mt-2">
                        <button class="btn btn-primary col-lg-12">
                            {{ __('Adicionar') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="createViewPage.js"></script>

@endsection