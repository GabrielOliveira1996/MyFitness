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
                                            <input name="text" class="mt-1" class="form-control" draggable="false">
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

            <div class="d-flex justify-content-center">
            <div class="card col-md-8 mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <img id="imageId"
                                    src="{{ $user['profile_image'] ? asset('img/' . $user['profile_image']) : asset('img/user-image.png') }}" 
                                    class="post-user-image">
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
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownComment">
                                    @if($post->user_id === auth()->user()->id)
                                        <a class="dropdown-item edit-post-btn" data-post-id="{{ $post->id }}" href="#" data-post-text="{{ $post->text }}" data-bs-toggle="modal" data-bs-target="#updatePostModal">
                                            Editar
                                        </a>
                                        <a href="{{ route('post.delete', ['id' => $post->id]) }}" onclick="deletePost(event)" data-id="{{ $post->id }}" class="dropdown-item delete-post-button" type="button">
                                            Excluir
                                        </a>
                                    @else
                                        <a class="dropdown-item" type="button">
                                            Denunciar
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                    {{$post->text}}

                    <hr class="col-md-12"/>

                        <div class="row">
                            <a class="col-md-2 btn btn-outline-light m-1">
                                <img src="{{ asset('img/like.png') }}" height="22" width="22">
                            </a>
                            <a class="col-md-2 btn btn-outline-light m-1 show-comments-button" data-post-id="{{ $post->id }}">
                                <img src="{{ asset('img/comment.png') }}" data-post-id="{{ $post->id }}" height="22" width="22">
                            </a>
                        </div>

                        <div id="comments-{{ $post->id }}" class="comments" style="display:none;">

                            <form action="{{ route('comment.create') }}" method="POST" autocomplete="off">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <div class="row mt-2">
                                    <div class="inputBox mt-3">
                                        <input type="text" class="@error('text') is-invalid @enderror" name="text" required>
                                        <label for="text" class="labelInput">Escreva seu comentário</label>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary col-md-12">Enviar</button>
                                    </div>
                                </div>
                            </form>

                            <hr/>

                            @foreach($post->comments()->orderBy('created_at', 'desc')->get() as $comment)
                                <div class="row mt-3">

                                    <div class="col-md-2">
                                        <a href="{{ route('community.userprofile', $comment->user->nickname) }}">
                                            <img id="imageId"
                                                    src="{{ $comment->user->profile_image ? asset('img/' . $comment->user->profile_image) : asset('img/user-image.png') }}" 
                                                    class="post-user-image">
                                        </a>
                                    </div>

                                    <div class="card bg-light p-2 col-md-10">

                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="col-md-12">
                                                    <strong>
                                                        <a href="{{ route('community.userprofile', $comment->user->nickname) }}">
                                                            {{$comment->user->name}}
                                                        </a>
                                                    </strong>
                                                </div>
                                                <div class="col-md-12">
                                                    <small>{{ $comment->user->nickname }}</small>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="col-md-12">
                                                    <small>{{date("d/m/Y - H:i:s", strtotime($comment->created_at))}}</small>
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownComment">
                                                        <button class="dropdown-item" type="button">Editar</button>
                                                        <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" data-id="{{ $comment->id }}" class="dropdown-item delete-comment-button" type="button">
                                                            Excluir
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-8 mt-3">
                                            {{ $comment->text }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                </div>
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
                                    <input name="text" class="form-control mt-1">
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
    <script src="{{ asset('js/comments/show.js') }}"></script>
    <script src="{{ asset('js/comments/deleteCommentConfirm.js') }}"></script>

</div>

@endsection