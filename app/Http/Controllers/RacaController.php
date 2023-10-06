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

class RacaController extends Controller
{
    public function index()
    {
        $racas = Raca::orderBy('raca')->paginate('20');
        return view('raca.index')
            ->with(compact('racas'));
    }


    public function create()
    {
        $raca = null;
        $especies = Especie::class;
        return view('raca.form')->with(compact(
            'raca',
            'especies'
        ));
    }


    public function store(Request $request)
    {
        Raca::create($request->all());
        return redirect()
            ->route('raca.index')
            ->with('success', 'Cadastrado com sucesso');
    }


    public function show(int $id)
    {
        $raca = Raca::find($id);
        return view('raca.show')->with(compact('raca'));
    }


    public function edit(int $id)
    {
        $raca = Raca::find($id);
        $especies = Especie::class;
        return view('raca.form')->with(compact(
            'raca',
            'especies'
        ));
    }


    public function update(Request $request, int $id)
    {
        $raca = Raca::find($id);
        $raca->update($request->all());
        return redirect()
            ->route('raca.index')
            ->with('info', 'Atualizado com sucesso');
    }

    public function destroy(string $id)
    {
        Raca::find($id)->delete();
        return redirect()->back()->with('destroy', ' Excluído com sucesso!');
    }

    /**
     * 05-10-2023
     * @author Thomas Melo
     *
     */
}
