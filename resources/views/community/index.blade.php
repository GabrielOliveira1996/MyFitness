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

    <div class="row justify-content-center mt-2">

        <form method="POST" 
            action="{{ route('community.search') }}" 
            autocomplete="off">
            @csrf
            
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

        <hr class="mt-5"/>

        @if(!empty($users))
            <div class="card col-md-10 mt-3">
                <label class="mt-3"><strong>Pessoas</strong></label>
                @foreach($users as $user)

                    <hr/>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="imageInputId" 
                                    class="d-flex justify-content-center">
                                <img id="imageId"
                                        src="{{ $user['profile_image'] ? asset('img/' . $user['profile_image']) : asset('img/user-image.png') }}" 
                                        class="col-md-12 search-profile-image">
                            </label>    
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>{{$user->name}}</strong> 
                                </div>
                                <div class="col-md-3">
                                    <label>{{ __('messages.Age') }}</label>
                                    {{$user->age}}
                                </div>
                                <div class="col-md-3">
                                    <label>{{ __('messages.Height') }}</label>
                                    {{$user->stature}} 
                                </div>

                                <div class="col-md-3">
                                    <label>{{ __('messages.Weight') }} (kg)</label>
                                    {{$user->weight}}
                                </div>
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
        @endif

    </div>
</div>

@endsection