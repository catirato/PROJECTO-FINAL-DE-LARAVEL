<h2>Álbuns da banda: {{ $band->name }}</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Imagem</th>
            <th>Nome do Álbum</th>
            <th>Data de Lançamento</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($albums as $album)
            <tr>
                <td>
                    @if($album->image)
                        <img src="{{ asset('storage/'.$album->image) }}" width="80">
                    @else
                        Sem imagem
                    @endif
                </td>
                <td>{{ $album->title }}</td>
                <td>{{ $album->release_date ?? '—' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Esta banda ainda não tem álbuns.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<a href="{{ route('bands.index') }}" class="btn btn-secondary">
    Voltar às Bandas
</a>
