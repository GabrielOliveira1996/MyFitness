@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mt-3 mx-5">
        <div class="row mb-5">
            <img src="{{ asset('img/community.png') }}" class="col-lg-5">
            <div class="col-lg-5 mt-5">
                <h1 class="mt-5 fw-bold">
                    {{ __('messages.community') }}
                </h1>
                <h5 class="mt-2">
                    {{ __('messages.communityDescription') }}
                </h5>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center mt-2">

        <form method="GET" 
            action="{{ route('community.search') }}" 
            autocomplete="off">
            
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 inputBox mt-3">
                    <input type="text" name="name" required>
                    <label class="labelInput">{{__('messages.searchUser')}}</label>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <div class="row col-md-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary col-md-4 m-1">{{__('messages.Search')}}</button>
                </div>
            </div>
            
        </form>

        <div class="d-flex justify-content-center mt-3 text-primary">
            {{ session('status') }}
        </div>

        <hr class="col-md-12 mt-5"/>
        
        @if(!empty($users))
            <div class="card col-md-10 mt-3">
                <label class="mt-3"><strong>{{ __('messages.people') }}</strong></label>
                @foreach($users as $user)

                    <hr class="col-md-12"/>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="imageInputId" class="d-flex justify-content-center">
                                <a href="{{ route('community.userprofile', ['nickname' => $user['nickname']]) }}">
                                    <img id="imageId"
                                            src="{{ $user['profile_image'] ? asset('img/' . $user['profile_image']) : asset('img/user-image.png') }}" 
                                            class="col-md-12 search-profile-image">
                                </a>
                            </label>    
                        </div>

                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-8 me-auto mt-4">
                                    <strong><a href="{{ route('community.userprofile', ['nickname' => $user['nickname']]) }}">{{$user->name}}</a></strong> 
                                    <div class="col-md-12">
                                        <small>{{ $user->nickname }}</small>
                                    </div>
                                </div>
                                @if(Auth::user()->following()->where('users.id', $user->id)->count() > 0)                                
                                <form method="POST" 
                                        action="{{ route('unfollow.user', ['nickname' => $user->nickname]) }}" 
                                        class="col-md-4 ms-auto">
                                        @csrf
                                    <button type="submit" class="btn btn-outline-danger">Desseguir -</button>
                                </form>
                                @else
                                <form method="POST" 
                                        action="{{ route('follow.user', ['nickname' => $user->nickname]) }}" 
                                        class="col-md-4 ms-auto">
                                        @csrf
                                    <button type="submit" class="btn btn-outline-primary">Seguir +</button>
                                </form>
                                @endif
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label>{{ $user->bio }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-5">
                {{$users->links()}}
            </div>
        @endif

        @if (session('unsuccessfully'))
            <div class="text-primary d-flex justify-content-center mb-3" role="alert">
                <strong class="shake-text">{{ session('unsuccessfully') }}</strong>
            </div>
        @endif

        @if(!empty($posts))
            @foreach($posts as $post)
                <div class="card col-md-7 mt-5">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <a href="{{ route('community.userprofile', $post->user->nickname) }}">
                                    <img id="imageId"
                                            src="{{ $post->user->profile_image ? asset('img/' . $post->user->profile_image) : asset('img/user-image.png') }}" 
                                            class="post-user-image">
                                </a>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <strong><a href="{{ route('community.userprofile', $post->user->nickname) }}">{{$post->user->name}}</a></strong>
                                </div>
                                <div class="col-md-12">
                                    <small>{{ $post->user->nickname }}</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <small>{{date("d/m/Y - H:i:s", strtotime($post->created_at))}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $post->text }}

                        <hr class="col-md-12"/>

                        <div class="row">
                            <a class="col-md-2 btn btn-outline-light m-1">
                                <img src="{{ asset('img/like.png') }}" height="22" width="22">
                            </a>
                            <a class="col-md-2 btn btn-outline-light m-1 show-comments-button" onclick="show(event)" data-post-id="{{ $post->id }}">
                                <img src="{{ asset('img/comment.png') }}" onclick="show(event)" data-post-id="{{ $post->id }}" height="22" width="22">
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
                                                            {{$post->user->name}}
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
                                                        <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" data-id="{{ $comment->id }}" class="dropdown-item delete-post-button" type="button">
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
            @endforeach
            <div class="d-flex justify-content-center mt-5">
                {{$posts->links()}}
            </div>
        @endif

    </div>
    
</div>

<script src="{{ asset('js/comments/show.js') }}"></script>
<script src="{{ asset('js/comments/deleteCommentConfirm.js') }}"></script>

@endsection