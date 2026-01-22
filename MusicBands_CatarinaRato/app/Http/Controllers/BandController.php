<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Band;

/**
 * Controller responsável pela gestão das Bandas
 * (listar, criar, visualizar, editar e remover)
 */
class BandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Mostra a lista de todas as bandas existentes.
     * É também calculado o número de álbuns associados a cada banda
     * através do método withCount().
     */
    public function index()
    {
        // Obtém todas as bandas e conta os álbuns associados a cada uma
        $bands = Band::withCount('albums')->get();

        // Envia os dados para a view bands.index
        return view('bands.index', compact('bands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * Apresenta o formulário para criação de uma nova banda.
     * O acesso a este método é normalmente protegido por middleware de administrador.
     */
    public function create()
    {
        return view('bands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * Valida os dados recebidos do formulário e guarda
     * uma nova banda na base de dados.
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'name'  => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Criação de uma nova instância da banda
        $band = new Band();
        $band->name = $request->name;

        // Caso exista uma foto, faz o upload e guarda o caminho
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('bands', 'public');
            $band->photo = $path;
        }

        // Guarda a banda na base de dados
        $band->save();

        // Redireciona para a lista de bandas
        return redirect()->route('bands.index');
    }

    /**
     * Display the specified resource.
     *
     * Mostra os detalhes de uma banda específica
     * e carrega os álbuns associados à mesma.
     */
    public function show(Band $band)
    {
        // Carrega a relação com os álbuns
        $band->load('albums');

        // Envia a banda para a view bands.show
        return view('bands.show', compact('band'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * Apresenta o formulário para edição de uma banda.
     */
    public function edit(Band $band)
{
    return view('bands.edit', compact('band'));
}


    /**
     * Update the specified resource in storage.
     *
     * Atualiza os dados de uma banda existente.
     
     */
    public function update(Request $request, Band $band)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'photo' => 'nullable|image|max:2048',
    ]);

    $band->name = $request->name;

    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('bands', 'public');
        $band->photo = $path;
    }

    $band->save();

    return redirect()
        ->route('bands.index')
        ->with('success', 'Banda atualizada com sucesso!');
}

    /**
     * Remove the specified resource from storage.
     *
     * Elimina uma banda da base de dados.
     * (Método ainda por implementar)
     */
    public function destroy(Band $band)
{
    // Apaga primeiro os álbuns associados (evita erro de foreign key)
    $band->albums()->delete();

    // Apaga a banda
    $band->delete();

    // Redireciona com mensagem de sucesso
    return redirect()
        ->route('bands.index')
        ->with('success', 'Banda apagada com sucesso!');
}

}
