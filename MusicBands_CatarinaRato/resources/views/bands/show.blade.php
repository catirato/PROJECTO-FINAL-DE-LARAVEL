@extends('layouts.app')

@section('title', $band->name)

@section('content')

<h1>{{ $band->name }}</h1>


<h3>Álbuns</h3>

@auth
@if(auth()->user()->isAdmin())
    <a href="{{ route('albums.create', $band) }}" class="btn btn-success mb-3">
        + Novo Álbum
    </a>
@endif
@endauth

<ul class="list-group">
@foreach($band->albums as $album)
    <li class="list-group-item d-flex align-items-center">

        {{-- IMAGEM DO ÁLBUM --}}
        @if($album->image)
            <img src="{{ asset('storage/'.$album->image) }}"
                 width="80"
                 class="me-3">
        @endif

        <div class="flex-grow-1">
            <strong>{{ $album->title }}</strong><br>
            <small>Ano: {{ $album->release_year }}</small>
        </div>

        @auth
            <a href="{{ route('albums.edit', $album) }}"
               class="btn btn-warning btn-sm me-2">
                Editar
            </a>
        @endauth

        @auth
        @if(auth()->user()->isAdmin())
            <form method="POST"
                  action="{{ route('albums.destroy', $album) }}"
                  class="d-inline"
                  onsubmit="return confirm('Tens a certeza que queres apagar este álbum?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    Apagar
                </button>
            </form>
        @endif
        @endauth
    </li>
@endforeach
</ul>

@endsection
