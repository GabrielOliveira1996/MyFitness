@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="text-center mt-3">Estabelecendo metas</h3>

    <h5 class="mt-3">Preenchendo as informações abaixo calcularemos sua Taxa Metabólica Basal (TMB), 
        essa taxa é o mínimo de energia necessária para manter as funções do organismo 
        em repouso, como os batimentos cardíacos, a pressão arterial, a respiração e a 
        manutenção da temperatura corporal. Através desse cálculo é possível saber a quantidade 
        de alimento que você precisa comer para ganhar peso ou perder.
    </h5>

    <hr class="mt-5">

    <form method="post" class="mt-5">
        @csrf

        <div class="row mt-3 d-flex justify-content-center">
            
            <div class="col-sm-2">
                {{__('Sexo')}}
                <select id="genderId" name="gender" class="form-control mt-1">
                    <option value="masculine">Masculino</option>
                    <option value="feminine">Feminino</option>
                </select>

            </div>

            <div class="col-sm-2">
                <label>Idade</label>

                <div class="input-group mt-1">
                    <input id="ageId" type="number" name="age" class="form-control" aria-describedby="addon-age" placeholder="Idade">
                    <div class="input-group-append">
                        <span class="input-group-text" id="addon-age">Anos</span>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="row mt-3 d-flex justify-content-center">
            <div class="col-sm-2">
                <label>Peso</label>

                <div class="input-group mt-1">
                    <input id="weightId" type="number" name="weight" class="form-control" aria-describedby="addon-weight" placeholder="Peso" step="any">
                    <div class="input-group-append">
                        <span class="input-group-text" id="addon-weight">Kg</span>
                    </div>
                </div>
            </div>

            <div class="col-sm-2">
                <label>Estatura</label>

                <div class="input-group mt-1">
                    <input id="statureId" type="number" name="stature" class="form-control" aria-describedby="addon-stature" placeholder="Estatura" step="any">
                    <div class="input-group-append">
                        <span class="input-group-text" id="addon-stature">cm</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-3 d-flex justify-content-center">
            <div class="col-sm-4">
                <label>Atividade Diária</label>
                <select id="activityRateFactorId" name="activity_rate_factor" class="form-control mt-1">
                    <option value="1.2">Sedentário</option>
                    <option value="1.375">Levemente ativo</option>
                    <option value="1.55">Moderadamente ativo</option> 
                    <option value="1.725">Altamente ativo</option>
                    <option value="1.9">Extremamente ativo</option>
                </select>
            </div>
            
        </div>

        <div class="row mt-3 d-flex justify-content-center">
            <div class="col-sm-4">

                <div class="input-group mt-1">
                    <input id="basalMetabolicRateId" type="number" name="basal_metabolic_rate" class="form-control" aria-describedby="addon-result" placeholder="Calorias" step="any">
                    <div class="input-group-append">
                        <span class="input-group-text" id="addon-result">Calorias</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-3 d-flex justify-content-center">
            <div class="col-sm-4">

                <div class="input-group mt-1">
                    <input id="dailyCarbohydrateId" type="number" name="daily_carbohydrate" class="form-control" aria-describedby="addon-result" placeholder="Carboidratos" step="any">
                    <div class="input-group-append">
                        <span class="input-group-text" id="addon-result">Carboidratos</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-3 d-flex justify-content-center">
            <div class="col-sm-4">

                <div class="input-group mt-1">
                    <input id="dailyProteinId" type="number" name="daily_protein" class="form-control" aria-describedby="addon-result" placeholder="Proteínas" step="any">
                    <div class="input-group-append">
                        <span class="input-group-text" id="addon-result">Proteínas</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-3 d-flex justify-content-center">
            <div class="col-sm-4">

                <div class="input-group mt-1">
                    <input id="dailyFatId" type="number" name="daily_fat" class="form-control" aria-describedby="addon-result" placeholder="Gorduras" step="any">
                    <div class="input-group-append">
                        <span class="input-group-text" id="addon-result">Gorduras</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex justify-content-center mt-3">
            <small class="col-sm-4">
                Tente responder as perguntas de forma precisa, dessa forma é possível chegar o mais próximo possível do real valor. Esses valores também podem ser alterados por você conforme desejar.
            </small>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            <a id="showResultId" class="btn btn-primary col-sm-2 m-2">Calcular</a>
            <button class="btn btn-primary col-sm-2 m-2">Finalizar</button>
        </div>
        
    </form>

    <hr class="mt-5">

    <script src="{{asset('js/tmb.js')}}"></script>

</div>
@endsection