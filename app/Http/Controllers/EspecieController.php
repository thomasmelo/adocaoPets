<?php

/**
 * 05-10-2023
 * @author Thomas Melo
 *
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\{
    Adocao,
    AdocaoHistorico,
    Cliente,
    ClienteHistorico,
    Especie,
    Pet,
    PetHistorico,
    Raca,
    Sexo,
    Status
};

class EspecieController extends Controller
{
    public function index()
    {
        $especies = Especie::orderBy('especie')->paginate('20');
        return view('especie.index')
            ->with(compact('especies'));
    }


    public function create()
    {
        $especie = null;
        return view('especie.form')->with(compact('especie'));
    }


    public function store(Request $request)
    {
        Especie::create($request->all());
        return redirect()
            ->route('especie.index')
            ->with('success', 'Cadastrado com sucesso');
    }


    public function show(int $id)
    {
        $especie = Especie::find($id);
        return view('especie.show')->with(compact('especie'));
    }


    public function edit(int $id)
    {
        $especie = Especie::find($id);
        return view('especie.form')->with(compact('especie'));
    }


    public function update(Request $request, int $id)
    {
        $especie = Especie::find($id);
        $especie->update($request->all());
        return redirect()
            ->route('especie.index')
            ->with('info', 'Atualizado com sucesso');
    }

    public function destroy(string $id)
    {
        Especie::find($id)->delete();
        return redirect()->back()->with('destroy', ' Excluído com sucesso!');
    }

    /**
     * 05-10-2023
     * @author Thomas Melo
     *
     */
}
