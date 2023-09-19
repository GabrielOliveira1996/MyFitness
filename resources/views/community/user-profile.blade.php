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

        </div> 
    </div>  

</div>

@endsection