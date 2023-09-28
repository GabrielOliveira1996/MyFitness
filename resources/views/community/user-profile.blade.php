@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card mt-5">
        <div class="card-body row mt-4">

            <div class="col-md-12 d-flex justify-content-center">
                <label for="imageInputId">
                    <img id="imageId"
                            src="{{ $user['profile_image'] ? asset('img/' . $user['profile_image']) : asset('img/user-image.png') }}" 
                            class="col-md-12 profile-image-follower">
                </label>  
            </div>
            
            <div class="col-md-12 d-flex justify-content-center mt-2">
                <strong><h4>{{$user->name}}</h4></strong>
            </div>

            <div class="col-md-12 d-flex justify-content-center">
                {{$user->bio}}
            </div>

            <hr class="mt-2"/>
    
            @if(auth()->user()->id != $user->id)
                @if(Auth::user()->following()->where('users.id', $user->id)->count() > 0)                       
                    <form method="POST" 
                            action="{{ route('unfollow.user', ['nickname' => $user->nickname]) }}" 
                            class="col-md-12 d-flex justify-content-center">
                            @csrf
                        <button type="submit" class="btn btn-outline-danger">Desseguir -</button>
                    </form>  
                @else  
                    <form method="POST" 
                            action="{{ route('follow.user', ['nickname' => $user->nickname]) }}" 
                            class="col-md-12 d-flex justify-content-center">
                            @csrf
                        <button type="submit" class="btn btn-outline-primary">Seguir +</button>
                    </form>
                @endif
            @else

                <div class="row d-flex justify-content-center">
                    <button class="btn btn-outline-primary col-md-8" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Faça uma publicação...                   
                    </button>
                </div>

            @endif

            <!-- Publication Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Escreva sobre o que está pensando...</h5>
                        <button :id="closeModalId" @click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                            <div class="row d-flex justify-content-center">
                                <form method="POST" 
                                            action=""
                                            autocomplete="off"
                                            class="col-md-12">
                                            @csrf

                                    <div class="row">
                                        <div class="col-md-12 inputBox align-self-center">
                                            <label for="text"></label>
                                            <textarea name="text" class="resize-false mt-1" cols="10" rows="5" draggable="false"></textarea>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary col-md-12">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>  

        </div> 
    </div>  

</div>

@endsection