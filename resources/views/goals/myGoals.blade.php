@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row d-flex justify-content-center mt-5">
        
        <div class="col-md-12">
            
            <h3 class="text-center">Suas metas</h3>
            
            <div class="row mt-4">
                <div class="col-md-12 d-flex justify-content-around">

                    <label class="font-weight-bold">Calorias {{__('0')}}</label>

                    <label class="font-weight-bold">Proteínas {{__('0')}}</label>

                    <label class="font-weight-bold">Carboidratos {{__('0')}}</label>

                    <label class="font-weight-bold">Gorduras {{__('0')}}</label>

                </div>
            </div>
            
        </div>
    </div>

</div>


@endsection