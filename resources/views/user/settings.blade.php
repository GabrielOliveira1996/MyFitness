@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center mt-2">

        <h3 class="text-center mt-5"><strong>{{ __('messages.publicProfile') }}</strong></h3>

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

            <div class="row mb-3  d-flex justify-content-center">
                <div class="col-md-6 inputBox">
                    <input id="name" type="text" name="name" value="{{ $user->name }}" required autofocus>
                    <label for="name" class="labelInput">{{ __('messages.Name') }}</label>
                </div>
                <div class="col-md-12">
                    @error('name')
                        <small class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 d-flex justify-content-center">
                <div class="col-md-6 inputBox">
                    <label class="d-flex justify-content-center" for="bio">Aqui fica a sua bio. Escreva algo sobre você...</label>
                    <textarea name="bio" class="resize-false mt-1" cols="30" rows="10" draggable="false">{{ $user->bio }}</textarea>
                </div>
                <div class="col-md-12">
                    @error('bio')
                        <small class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
            </div>
            
            @error('profile_image')
            <div class="d-flex justify-content-center">
                <small class="text-danger">
                    <strong>{{ $message }}</strong>
                </small>
            </div>
            @enderror

            <div class="row p-2 d-flex justify-content-center">
                <button type="submit" 
                        class="btn btn-primary col-md-6">{{__('messages.updateProfile')}}</button>
            </div>

        </form>
          
        <hr/>
        
    </div>
</div>

@endsection