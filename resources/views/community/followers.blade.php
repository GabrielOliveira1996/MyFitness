@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-3">
            <div class="card mt-5">
                <div class="card-body">

                    <div class="col-md-12 d-flex justify-content-center">
                        <label for="imageInputId">
                            <img id="imageId"
                                    src="{{ auth()->user()->profile_image ? asset('img/' . auth()->user()->profile_image) : asset('img/user-image.png') }}" 
                                    class="profile-image-follower">
                        </label>  
                    </div>
                    
                    <div class="col-md-12 d-flex justify-content-center mt-2">
                        <strong><h4>{{auth()->user()->name}}</h4></strong>
                    </div>

                    <div class="col-md-12 d-flex justify-content-center">
                        {{auth()->user()->bio}}
                    </div>

                    <hr class="mt-2"/>

                </div> 
            </div> 
        </div>

        <div class="col-md-9">
            <div class="row">
        
                @if(!empty($followers))
                    @foreach($followers as $follower)

                        <div class="col-md-10">

                            <div class="card mt-5">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <a href="{{ route('community.userprofile', ['nickname' => $follower->nickname]) }}">
                                                <img id="imageId"
                                                        src="{{ $follower['profile_image'] ? asset('img/' . $follower['profile_image']) : asset('img/user-image.png') }}" 
                                                        class="post-user-image">
                                            </a>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <strong>
                                                    <a href="{{ route('community.userprofile', ['nickname' => $follower->nickname]) }}">
                                                        {{$follower->name}}
                                                    </a>
                                                </strong>
                                            </div>
                                            <div class="col-md-12">
                                                <small>{{$follower->nickname}}</small>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            @if(Auth::user()->following()->where('users.id', $follower->id)->count() > 0)                       
                                                <form method="POST" 
                                                        action="{{ route('unfollow.user', ['nickname' => $follower->nickname]) }}" 
                                                        class="col-md-12 d-flex justify-content-center">
                                                        @csrf
                                                    <button type="submit" class="btn btn-outline-danger">Desseguir -</button>
                                                </form>  
                                            @else  
                                                <form method="POST" 
                                                        action="{{ route('follow.user', ['nickname' => $follower->nickname]) }}" 
                                                        class="col-md-12 d-flex justify-content-center">
                                                        @csrf
                                                    <button type="submit" class="btn btn-outline-primary">Seguir +</button>
                                                </form>
                                            @endif
                                        </div>

                                        <div class="col-md-1">
                                            <div class="dropdown">
                                                
                                                <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownComment">
                                                    <a class="dropdown-item" type="button">
                                                        Denunciar Perfil
                                                    </a>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                    {{ $follower->bio }}
                                </div>
                            </div>
                            
                        </div>
                        
                    @endforeach

                @else
                    <div class="text-primary d-flex justify-content-center mt-5" role="alert">
                        <strong class="shake-text">{{ session('searchUserFailure') }}</strong>
                    </div>
                @endif

            </div>
        </div>
    </div>

</div>

@endsection