<?php

/**
 * 04-10-2023
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


class AdocaoController extends Controller
{

    public function index()
    {
        $adocoes = Adocao::orderBy('id_adocao', 'asc')->paginate('20');
        $status = Status::class;
        return view('adocao.index')
            ->with(compact('adocoes', 'status'));
    }


    public function create()
    {
        $adocao = null;
        $status = Status::class;
        $pets = Pet::orderBy('nome')->get();
        $clientes = Cliente::orderBy('nome');
        return view('adocao.form')
            ->with(compact('adocao', 'status', 'pets', 'clientes'));
    }


    public function store(Request $request)
    {
        $adocao = Adocao::create($request->all());
        AdocaoHistorico::create([
            'id_user' => Auth::user()->id,
            'id_adocao' => $adocao->id_adocao,
            'historico' => 'Adoção iniciada'
        ]);
        return redirect()
            ->route('adocao.show', ['id' => $adocao->id_adocao])
            ->with('success', 'Cadastrado com sucesso');
    }


    public function show(int $id)
    {
        $adocao = Adocao::find($id);
        return view('adocao.show')->with(compact('adocao'));
    }


    public function edit(int $id)
    {
        $adocao = Adocao::find($id);
        $status = Status::class;
        $pets = Pet::orderBy('nome')->get();
        $clientes = Cliente::orderBy('nome');
        return view('adocao.form')
            ->with(compact('adocao', 'status', 'pets', 'clientes'));
    }


    public function update(Request $request, int $id)
    {
        $adocao = Adocao::find($id);
        $adocao->update($request->all());
        AdocaoHistorico::create([
            'id_user' => Auth::user()->id,
            'id_adocao' => $id,
            'historico' => 'Adoção atualizada'
        ]);
        return redirect()
            ->route('adocao.show', ['id' => $adocao->id_adocao])
            ->with('success', 'Cadastrado com sucesso');
    }

    public function destroy(string $id)
    {
        Adocao::find($id)->delete();
        return redirect()->back()->with('destroy', ' Excluído com sucesso!');
    }

    /**
     * 04-10-2023
     * @author Thomas Melo
     *
     */
}
