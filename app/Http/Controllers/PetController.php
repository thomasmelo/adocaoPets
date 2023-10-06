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

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::orderBy('id_pet', 'asc')->paginate('20');
        return view('pet.index')
            ->with(compact('pets'));
    }


    public function create()
    {
        $pet = null;
        $especies = Especie::class;
        $racas = Raca::class;
        $sexos = Sexo::class;

        return view('pet.form')->with(compact(
            'pet',
            'especies',
            'racas',
            'sexos'
        ));
    }


    public function store(Request $request)
    {
        $pet = Pet::create($request->all());
        PetHistorico::create([
            'id_user' => Auth::user()->id,
            'id_pet' => $pet->id_pet,
            'historico' => 'Relizado cadastro no sistema'
        ]);
        return redirect()
            ->route('pet.show', ['id' => $pet->id_pet])
            ->with('success', 'Cadastrado com sucesso');
    }


    public function show(int $id)
    {
        $pet =Pet::find($id);
        return view('pet.show')->with(compact('pet'));
    }


    public function edit(int $id)
    {
        $pet = Pet::find($id);
        $especies = Especie::class;
        $racas = Raca::class;
        $sexos = Sexo::class;

        return view('pet.form')->with(compact(
            'pet',
            'especies',
            'racas',
            'sexos'
        ));
    }


    public function update(Request $request, int $id)
    {
        $pet =Pet::find($id);
        $pet->update($request->all());
        PetHistorico::create([
            'id_user' => Auth::user()->id,
            'id_pet' => $id,
            'historico' => 'Adoção atualizada'
        ]);
        return redirect()
            ->route('pet.show', ['id' => $pet->id_pet])
            ->with('success', 'Cadastrado com sucesso');
    }

    public function destroy(string $id)
    {
       Pet::find($id)->delete();
        return redirect()->back()->with('destroy', ' Excluído com sucesso!');
    }

    /**
     * 05-10-2023
     * @author Thomas Melo
     *
     */
}
