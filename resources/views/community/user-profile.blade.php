@extends('layouts.app')

@section('content')

<script src="{{ asset('js/user-profile/passingDataToTheModal.js') }}"></script>

<div class="container">

    <div class="card mt-5">
        <div class="card-body row mt-4">

            <div class="col-md-12 d-flex justify-content-center">
                <label for="imageInputId">
                    <img id="imageId"
                            src="{{ $user['profile_image'] ? asset('img/' . $user['profile_image']) : asset('img/user-image.png') }}" 
                            class="profile-image-follower">
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
                        <form method="POST" 
                                action="{{ route('post.create') }}"
                                autocomplete="off"
                                class="col-md-12">
                                @csrf
                            <div class="modal-body">
                                <div class="row d-flex justify-content-center">
                                    
                                    <div class="row">
                                        <div class="col-md-12 inputBox align-self-center">
                                            <label for="text"></label>
                                            <textarea name="text" class="resize-false mt-1" cols="10" rows="5" draggable="false"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary col-md-12">Salvar</button>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>  

        </div> 
    </div>  

    @if(session('status'))
        <div class="text-primary d-flex justify-content-center mb-3 mt-3" role="alert">
            <strong>{{ session('status') }}</strong>
        </div>
    @endif

    @if(!empty($posts))
        @foreach($posts as $post)
            <div class="card mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-1">
                            <img id="imageId"
                                    src="{{ $user['profile_image'] ? asset('img/' . $user['profile_image']) : asset('img/user-image.png') }}" 
                                    class="col-md-12 post-user-image">
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-12">
                                <strong>{{$user->name}}</strong>
                            </div>
                            <div class="col-md-12">
                                <small>{{$user->nickname}}</small>
                            </div>
                            @if($post->created_at != $post->updated_at)
                                <div class="col-md-12">
                                    <small>Este post foi editado em <strong>{{date("d/m/Y - H:i:s", strtotime($post->updated_at))}}</strong></small>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <small>Este post foi criado em <strong>{{date("d/m/Y - H:i:s", strtotime($post->created_at))}}</strong></small>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-1">
                        <a class="btn btn-outline-secondary edit-post-btn" data-post-id="{{ $post->id }}" data-post-text="{{ $post->text }}" data-bs-toggle="modal" data-bs-target="#updatePostModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg>
                        </a>
                        </div>
                        <div class="col-md-1">
                            <a id="deletePostButton" class="btn btn-outline-secondary delete-post-button" href="{{ route('post.delete', ['id' => $post->id]) }}" data-id="{{ $post->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{$post->text}}
                </div>
            </div>
             
        @endforeach
    @endif

    <!-- Update Publication Modal -->
    <div class="modal fade" id="updatePostModal" tabindex="-1" role="dialog" aria-labelledby="updatePostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Escreva sobre o que está pensando...</h5>
                <button :id="closeModalId" @click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form method="POST" 
                        action="{{ route('post.update') }}"
                        autocomplete="off"
                        class="col-md-12">
                        @csrf
                    <input type="hidden" name="id" id="post_id" value="">
                    <div class="modal-body">
                        <div class="row d-flex justify-content-center">
                            
                            <div class="row">
                                <div class="col-md-12 inputBox align-self-center">
                                    <label for="text"></label>
                                    <textarea name="text" class="resize-false mt-1" cols="10" rows="5" draggable="false"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary col-md-12">Salvar</button>
                    </div>
                
                </form>
            </div>
        </div>
    </div> 

    <script src="{{ asset('js/user-profile/deletePostConfirm.js') }}"></script>

</div>

@endsection