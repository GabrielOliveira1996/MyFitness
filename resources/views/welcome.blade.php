@extends('layouts.app')

@section('content')

<div class="container">

    @guest

        <div class="row">
            <div class="row mb-5">
                <div class="col-lg-5 mt-5">
                    <h1 class="mt-5 fw-bold">
                        Que seu remédio seja seu alimento, e que seu alimento seja seu remédio.
                    </h1>
                    <h5 class="mt-2">
                        Quer comer com mais atenção? Monitore refeições, aprenda sobre seus hábitos e alcance seus objetivos com o MyFitness.
                    </h5>
                    <button class="btn btn-primary">COMECE GRATUITAMENTE</button>
                </div>
                <img src="img/alimento.png" class="col-lg-7">
            </div>
        </div>

        <div class="row mt-5">
            <div class="row">
                <img src="img/alimento2.png" class="col-lg-6">
                <div class="col-lg-5 mt-5">
                    <h1 class="mt-5 fw-bold ">
                        Utilize os alimentos de nossa base, ou registre o seu próprio.
                    </h1>
                    <h5 class="mt-2">
                        Veja o detalhamento de calorias e nutrientes, compare porções e descubra como os alimento que você ingere contribuem com os seus objetivos.
                    </h5>
                </div>
            </div>
        </div>

    @else

        <div class="row mt-5">

            <div class="col-lg-5">
                <h1 class="fw-bolder">Explore a nossa galeria de receitas, e tenha uma dieta mais agradavél ao seu paladar.</h1>
                <h5>Hehehehehehheheheheheheheh</h5>
                <button class="btn btn-primary col-lg-5 p-2 mt-2">RECEITAS</button>
            </div>
            <img src="img/receita1.png" class="col-lg-5">
        </div>

        
        
    @endguest
    
</div>


@endsection