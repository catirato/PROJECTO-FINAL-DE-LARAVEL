@extends('layouts.app')

@section('title', 'Bandas')

@section('content')

<h1>Lista de Bandas</h1>

@auth
@if(auth()->user()->isAdmin())
    <a href="{{ route('bands.create') }}" class="btn btn-success mb-3">
        + Nova Banda
    </a>
@endif
@endauth

<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>Foto</th>
            <th>Nome da Banda</th>
            <th>Nº de Álbuns</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        @foreach($bands as $band)
            <tr>
                <td>
                    @if($band->photo)
                        <img src="{{ Storage::url($band->photo) }}" width="80">
                    @else
                        —
                    @endif
                </td>

                <td>{{ $band->name }}</td>
                <td>{{ $band->albums_count }}</td>

                <td>
    {{-- VER ÁLBUNS (PÚBLICO) --}}
    <a href="{{ route('bands.show', $band) }}"
       class="btn btn-primary btn-sm">
        Ver Álbuns
    </a>

    {{-- AÇÕES ADMIN --}}
    @auth
        @if(auth()->user()->isAdmin())
            <a href="{{ route('bands.edit', $band) }}"
               class="btn btn-warning btn-sm ms-1">
                Editar
            </a>

            <form action="{{ route('bands.destroy', $band) }}"
                  method="POST"
                  class="d-inline"
                  onsubmit="return confirm('Tens a certeza que queres apagar esta banda?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm ms-1">
                    Apagar
                </button>
            </form>
        @endif
    @endauth
</td>
            </tr>
        @endforeach
    </tbody>
</table>


@endsection
