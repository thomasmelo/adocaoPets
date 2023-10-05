<?php

/**
 * 04-10-2023
 * @author Thomas Melo
 *
 */

namespace App\Http\Controllers;

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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adocoes = Adocao::orderBy('id_adocao', 'asc')->paginate('20');
        $status = Status::class;
        return view('adocao.index')
            ->with(compact('adocoes', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $adocao = null;
        $status = Status::class;
        $pets = Pet::orderBy('nome')->get();
        $clientes = Cliente::orderBy('nome');
        return view('adocao.form')
            ->with(compact('adocao', 'status', 'pets', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $adocao = Adocao::find($id);
        return view('adocao.show')->with(compact('adocao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $adocao = Adocao::find($id);
        $status = Status::class;
        $pets = Pet::orderBy('nome')->get();
        $clientes = Cliente::orderBy('nome');
        return view('adocao.form')
        ->with(compact('adocao', 'status', 'pets', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Adocao $adocao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adocao $adocao)
    {
        //
    }

    /**
     * 04-10-2023
     * @author Thomas Melo
     *
     */
}
