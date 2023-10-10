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

    public function index(Request $request, string $search = null, string $dt_inicio = null, int $id_status = null)
    {

        $search     = $request->search ?? null;
        $dt_inicio  = $request->dt_inicio ?? null;
        $id_status  = $request->id_status ?? null;

        $adocoes = Adocao::with([
            'cliente',
            'pet',
            'status',
            'usuario',
        ])
            ->join('clientes', 'adocoes.id_cliente', '=', 'clientes.id_cliente')
            ->join('pets', 'adocoes.id_pet', '=', 'pets.id_pet')
            ->where(function ($query) use ($search, $dt_inicio,  $id_status) {
                if ($search) {
                    $query->where('pets.nome', 'like', "%$search%");
                    $query->orwhere('clientes.nome', 'like', "%$search%");
                }
                if ($dt_inicio) {
                    $query->where('adocoes.dt_inicio', '>=', $dt_inicio);
                }
                if ($id_status) {
                    $query->orwhere('adocoes.id_status', '=', $id_status);
                }
            })->orderBy('id_adocao', 'desc')->paginate('20');
        $status = Status::class;
        return view('adocao.index')
            ->with(compact('adocoes', 'status'));
    }


    public function create(
        Request $request,
        int $id_cliente = null,
        int $id_raca = null,
        int $id_sexo = null
    ) {
        if (!$id_cliente) {
            return redirect()
                ->route('adocao.index');
        }

        $adocao     = null;
        $cliente    = Cliente::find($id_cliente);
        $status     = Status::class;
        $especies   = Especie::class;
        $racas      = Raca::class;
        $sexos      = Sexo::class;

        $id_raca    = $request->id_raca ?? null;
        $id_sexo    = $request->id_sexo ?? null;

        $pets = Pet::where(function ($query) use ($id_raca, $id_sexo) {
            if ($id_raca) {
                $query->where('id_raca', $id_raca);
            }
            if ($id_sexo) {
                $query->where('id_sexo', $id_sexo);
            }
        })->orderBy('nome')->paginate('40');

        return view('adocao.form')
            ->with(compact(
                'adocao',
                'cliente',
                'status',
                'especies',
                'racas',
                'sexos',
                'pets'
            ));
    }


    public function store(Request $request, int $id_cliente)
    {
        $adocao = Adocao::create([
            'id_pet' => $request->id_pet,
            'id_cliente' => $id_cliente,
            'id_status' => Status::INICIADO,
            'dt_inicio' => date('Y-m-d'),
        ]);

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
        return view('adocao.formEdicao')
            ->with(compact('adocao', 'status'));
    }


    public function update(Request $request, int $id)
    {
        $adocao = Adocao::find($id);
        $adocao->update($request->all());
        AdocaoHistorico::create([
            'id_user' => Auth::user()->id,
            'id_adocao' => $id,
            'historico' => $request->historico,
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
