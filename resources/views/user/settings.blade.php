@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center mt-2">

        <h3 class="text-center mt-5">{{ __('messages.publicProfile') }}</h3>

        <hr/>

        <p class="text-center">{{ __('messages.publicProfileDescription') }}</p>

        <form method="POST" 
                action="{{ route('settings.edit') }}"
                autocomplete="off"
                enctype="multipart/form-data">
            @csrf

            <div class="row mb-3 d-flex justify-content-center">
                <div class="col-md-3">
                    <label for="imageInputId" 
                            class="d-flex justify-content-center">
                        <img id="imageId"
                                src="{{ $user['profile_image'] ? asset('img/' . $user['profile_image']) : asset('img/user-image.png') }}" 
                                class="img rounded-circle img-fluid profile-image col-md-12">
                    </label>    
                </div>
            </div>
            <input id="imageInputId" 
                    type="file" 
                    name="profile_image"
                    class="d-none">
            
            <hr/>
            
            @error('profile_image')
            <div class="d-flex justify-content-center">
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small>
            </div>
            @enderror

            <div class="row p-2 d-flex justify-content-center">
                <button type="submit" 
                        class="btn btn-primary col-md-4">{{__('messages.updateProfile')}}</button>
            </div>

        </form>

    </div>
</div>

@endsection