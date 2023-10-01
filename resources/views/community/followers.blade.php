@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mt-3 mx-5">
        <div class="row mb-5">
            <img src="{{ asset('img/following.png') }}" class="col-lg-5">
            <div class="col-lg-5 mt-5">
                <h1 class="mt-5 fw-bold">
                    {{ __('messages.following') }}
                </h1>
                <h5 class="mt-2">
                    {{ __('messages.followingDescription') }}
                </h5>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-2">

        <hr class="mt-5"/>

        @if(!empty($followers))
            <div class="card col-md-10 mt-3">
                <label class="mt-3"><strong>{{__('messages.following')}}</strong></label>
                @foreach($followers as $follower)

                    <hr/>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="imageInputId" 
                                    class="d-flex justify-content-center">
                                <a href="{{ route('community.userprofile', ['nickname' => $follower->nickname]) }}">
                                    <img id="imageId"
                                            src="{{ $follower['profile_image'] ? asset('img/' . $follower['profile_image']) : asset('img/user-image.png') }}" 
                                            class="col-md-12 search-profile-image">
                                </a>
                            </label>    
                        </div>

                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-8 me-auto mt-4">
                                    <strong>
                                        <a href="{{ route('community.userprofile', ['nickname' => $follower->nickname]) }}">
                                            {{$follower->name}}
                                        </a>
                                    </strong> 
                                    <div class="col-md-12">
                                        <small>{{ $follower->nickname }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label>{{ $follower->bio }}</label>
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