@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center mt-2">
        
        <h3 class="text-center mt-5">Sua lista de alimentos</h3>

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
                    <th scope="col">Remover</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userlistFood as $food)
                    <tr>
                        <td><input type="text" class="form-control border-0" style="background-color:white;" name="name" value="{{__($food->name)}}" step="any" disabled></th>
                        <td><input type="number" class="form-control border-0" style="background-color:white;" name="quantity_grams" value="{{__($food->quantity_grams)}}" step="any" disabled></td>
                        <td><input type="number" class="form-control border-0" style="background-color:white;" name="calories" value="{{__($food->calories)}}" step="any" disabled></td>
                        <td><input type="number" class="form-control border-0" style="background-color:white;" name="carbohydrate" value="{{__($food->carbohydrate)}}" step="any" disabled></td>
                        <td><input type="number" class="form-control border-0" style="background-color:white;" name="protein" value="{{__($food->protein)}}" step="any" disabled></td>
                        <td><input type="number" class="form-control border-0" style="background-color:white;" name="total_fat" value="{{__($food->total_fat)}}" step="any" disabled></td>
                        <td><input type="number" class="form-control border-0" style="background-color:white;" name="saturated_fat" value="{{__($food->saturated_fat)}}" step="any" disabled></td>
                        <td><input type="number" class="form-control border-0" style="background-color:white;" name="trans_fat" value="{{__($food->trans_fat)}}" step="any" disabled></td>                    
                        <td>
                            <a href="" class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

@endsection