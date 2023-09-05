@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-2">

    <form method="POST" 
            class="input-group d-flex justify-content-center" 
            action="{{ route('community.search') }}"
            autocomplete="off">
        <input class="form-control col-md-12" 
                type="search" 
                placeholder="Buscar usuário..." 
                aria-label="Search" 
                required>
        <button class="btn btn-outline-dark" 
                type="submit">Buscar</button>
    </form>

    @if(!empty($users))
        @foreach($users as $user)
            <ul>
                {{ session('name'); }}
            </ul>
        @endforeach
    @endif

    </div>
</div>

@endsection