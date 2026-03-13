<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Band;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Mostrar formulário de criação de álbum
    |--------------------------------------------------------------------------
    */
    public function create(Band $band)
    {
        return view('albums.create', compact('band'));
    }

    /*
    |--------------------------------------------------------------------------
    | Guardar novo álbum
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'band_id' => 'required|exists:bands,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'release_year' => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        $album = new Album();
        $album->band_id = $request->band_id;
        $album->title = $request->title;
        $album->release_year = $request->release_year; // ✅ CORRIGIDO

        if ($request->hasFile('image')) {
            $album->image = $request->file('image')->store('albums', 'public');
        }

        $album->save();

        return redirect()->route('bands.show', $album->band_id);
    }

    /*
    |--------------------------------------------------------------------------
    | Mostrar formulário de edição
    |--------------------------------------------------------------------------
    */
    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    /*
    |--------------------------------------------------------------------------
    | Atualizar álbum
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Album $album)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'release_year' => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        $album->title = $request->title;
        $album->release_year = $request->release_year; // ✅ CORRIGIDO

        if ($request->hasFile('image')) {
            $album->image = $request->file('image')->store('albums', 'public');
        }

        $album->save();

        return redirect()->route('bands.show', $album->band_id);
    }

    /*
    |--------------------------------------------------------------------------
    | Apagar álbum
    |--------------------------------------------------------------------------
    */
    public function destroy(Album $album)
    {
        $bandId = $album->band_id;
        $album->delete();

        return redirect()->route('bands.show', $bandId);
    }
}
