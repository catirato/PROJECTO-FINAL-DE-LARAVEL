@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1>Dashboard</h1>

<div class="alert alert-success">
    Olá, <strong>{{ auth()->user()->name }}</strong>
</div>

@if(auth()->user()->isAdmin())
    <p><strong>Perfil:</strong> Administrador</p>
@else
    <p><strong>Perfil:</strong> Utilizador</p>
@endif

@endsection
