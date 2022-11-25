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

            <p class="text-center">Você selecionou o alimento {{$food->name}}, nesta página você pode realizar alterações no alimento, caso as informações não estejam preenchidas de forma correta.</p>
            
            <form method="POST" autocomplete="off">
                @csrf
                <div class="d-flex flex-column offset-lg-3">
                    <div class="col-lg-8 mt-2">
                        <input type="text" value="{{$food->name}}" name="name" class="form-control" placeholder="Nome">
                    </div>
                    <div class="col-lg-8 mt-2">
                        <input type="number" value="{{ $food->quantity_grams }}" name="quantity_grams" class="form-control" placeholder="Gramas" step="any">
                    </div>
                    <div class="col-lg-8 mt-2">
                        <input type="number" value="{{ $food->calories }}" name="calories" class="form-control" placeholder="Calorias" step="any">
                    </div>
                    <div class="col-lg-8 mt-2">
                        <input type="number" value="{{ $food->carbohydrate }}" name="carbohydrate" class="form-control" placeholder="Carboidrato" step="any">
                    </div>
                    <div class="col-lg-8 mt-2">
                        <input type="number" value="{{ $food->protein }}" name="protein" class="form-control" placeholder="Proteína" step="any">
                    </div>
                    <div class="col-lg-8 mt-2">
                        <input type="number" value="{{ $food->total_fat }}" name="total_fat" class="form-control" placeholder="Gordura Total" step="any">
                    </div>
                    <div class="col-lg-8 mt-2">
                        <input type="number" value="{{ $food->saturated_fat }}" name="saturated_fat" class="form-control" placeholder="Gordura Saturada" step="any">
                    </div>
                    <div class="col-lg-8 mt-2">
                        <input type="number" value="{{ $food->trans_fat }}" name="trans_fat" class="form-control" placeholder="Gordura Trans" step="any">
                    </div>

                    <hr class="col-lg-8">

                    <div class="col-lg-8 mt-2">
                        <button class="btn btn-primary col-lg-12">
                            {{ __('Atualizar') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection