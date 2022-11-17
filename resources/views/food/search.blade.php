@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <p class="text-center">Busque por alimentos e adicione a sua lista de favoritos.</p>
            <form method="post">
                <div class="row">
                    <div class="col-lg-4 offset-lg-4">
                        <input type="text" class="form-control col-lg-2">
                    </div>
                </div>
                <button class="btn btn-primary col-lg-2 offset-lg-5 mt-3">Buscar</button>
            </form>

        </div>
    </div>
</div>

@endsection