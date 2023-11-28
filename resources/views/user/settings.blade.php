@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mt-2">

        <h3 class="text-center mt-5"><strong>{{ __('messages.publicProfile') }}</strong></h3>

        <hr/>

        <label class="text-center mb-5">{{ __('messages.publicProfileDescription') }}</label>
        
        <div id="settings">
            <div class="row mb-3">
                <form method="POST" 
                        action="{{ route('perfil-image.update') }}"
                        autocomplete="off"
                        enctype="multipart/form-data"
                        class="col-md-4">
                    @csrf

                    <label for="imageInputId" 
                            class="d-flex justify-content-center">
                        <img id="imageId" 
                                src="{{ $user['profile_image'] ? asset('img/' . $user['profile_image']) : asset('img/user-image.png') }}" 
                                class="profile-image"
                                title="Para alterar, clique na imagem.">
                    </label>   

                    <input id="imageInputId" 
                            type="file" 
                            @change="changeImage"
                            name="profile_image"
                            class="d-none">

                    <!-- Image Preview In Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Esta é uma prévia da sua foto de perfil.</h5>
                                <button :id="closeModalId" @click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <div class="modal-body d-flex justify-content-center">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <img :id="imageModalId"
                                                    v-if="image"
                                                    :src="image"
                                                    class="profile-image">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary col-md-12">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </div>  
                </form>

                <!-- Error Modal -->
                <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Houve um erro ao enviar o arquivo.</h5>
                                <button :id="closeModalId" @click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="text-danger"><strong>Verifique as seguintes condições:</strong></div>
                                        <div class="text-danger">São permitidos apenas formatos de imagem JPG/JPEG e PNG.</div>
                                        <div class="text-danger">Imagem deve ter um tamanho máximo de 10MB.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <form method="POST" 
                        action="{{ route('public-perfil.update') }}"
                        autocomplete="off"
                        class="col-md-6">
                        @csrf

                    <div class="row">
                        <div class="col-md-6 inputBox">
                            <input id="name" type="text" name="name" value="{{ $user->name }}" required autofocus>
                            <label for="name" class="labelInput">{{ __('messages.Name') }}</label>
                        </div>
                        <div class="col-md-6 inputBox">
                            <input id="nickname" type="text" name="nickname" value="{{ $user->nickname }}" required autofocus>
                            <label for="nickname" class="labelInput">{{ __('Apelido') }}</label>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12 inputBox">
                            <input id="bio" type="text" name="bio" value="{{ $user->bio }}" required autofocus>
                            <label for="bio" class="labelInput">{{ __('Bio') }}</label>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary col-md-12">{{__('messages.updateProfile')}}</button>
                        </div>
                    </div>
                    
                    @if (session('success'))
                        <div class="text-primary d-flex justify-content-center mt-3" role="alert">
                            <strong class="shake-text">{{ session('success') }}</strong>
                        </div>
                    @endif

                    @if (session('unsuccessfully'))
                        <div class="text-danger d-flex justify-content-center mt-3" role="alert">
                            <strong class="shake-text">{{ session('unsuccessfully') }}</strong>
                        </div>
                    @endif

                </form>
            </div>
        </div>
     
        <hr/>
        
    </div>
</div>
<script src="{{ asset('js/settings/settings.js') }}"></script>
@endsection