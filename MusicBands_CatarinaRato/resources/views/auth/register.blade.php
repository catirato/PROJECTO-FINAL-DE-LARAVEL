@extends('layouts.app')

@section('title', 'Registo')

@section('content')

<h1>Registo</h1>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
        <label>Confirmar Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <button class="btn btn-success">Registar</button>
</form>

@endsection
