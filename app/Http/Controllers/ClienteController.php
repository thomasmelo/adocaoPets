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

class ClienteController extends Controller
{
    public function index(Request $request, string $search = null)
    {
        $search   = $request->search ?? null;
        $clientes = Cliente::where(function ($query) use ($search) {
            $query->where('nome', 'like', "%$search%");
            $query->orwhere('cpf', 'like', "%$search%");
            $query->orwhere('celular', 'like', "%$search%");
            $query->orwhere('cidade', 'like', "%$search%");
        })->orderBy('id_cliente', 'asc')
            ->paginate('20');
        return view('cliente.index')
            ->with(compact('clientes'));
    }


    public function create()
    {
        $cliente = null;
        $sexos = Sexo::class;
        return view('cliente.form')
            ->with(compact('cliente', 'sexos'));
    }


    public function store(Request $request)
    {
        $cliente = Cliente::create($request->all());
        ClienteHistorico::create([
            'id_user' => Auth::user()->id,
            'id_cliente' => $cliente->id_cliente,
            'historico' => 'Relizado cadastro no sistema'
        ]);
        return redirect()
            ->route('cliente.show', ['id' => $cliente->id_cliente])
            ->with('success', 'Cadastrado com sucesso');
    }


    public function show(int $id)
    {
        $cliente = Cliente::find($id);
        return view('cliente.show')->with(compact('cliente'));
    }


    public function edit(int $id)
    {
        $cliente = Cliente::find($id);
        $sexos = Sexo::class;
        return view('cliente.form')
            ->with(compact('cliente', 'sexos'));
    }


    public function update(Request $request, int $id)
    {
        $cliente = Cliente::find($id);
        $cliente->update($request->all());
        ClienteHistorico::create([
            'id_user' => Auth::user()->id,
            'id_cliente' => $id,
            'historico' => 'Adoção atualizada'
        ]);
        return redirect()
            ->route('cliente.show', ['id' => $cliente->id_cliente])
            ->with('success', 'Cadastrado com sucesso');
    }

    public function destroy(string $id)
    {
        Cliente::find($id)->delete();
        return redirect()->back()->with('destroy', ' Excluído com sucesso!');
    }

    /**
     * 05-10-2023
     * @author Thomas Melo
     *
     */
}
