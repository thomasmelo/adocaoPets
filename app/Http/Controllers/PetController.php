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
    public function index(Request $request, string $search = null, int $id_raca = null, int $id_sexo = null)
    {
        $search   = $request->search ?? null;
        $id_raca  = $request->id_raca ?? null;
        $id_sexo  = $request->id_sexo ?? null;
        $pets = Pet::where(function ($query) use ($search, $id_raca, $id_sexo) {
            if ($search) {
                $query->where('nome', 'like', "%$search%");
            }
            if($id_raca) {
                $query->where('id_raca', $id_raca);
            }
            if ($id_sexo) {
                $query->where('id_sexo', $id_sexo);
            }
        })->orderBy('id_pet', 'asc')->paginate('20');

        $racas = Raca::orderBy('raca');
        $especies = Especie::class;
        $racas = Raca::class;
        $sexos = Sexo::class;

        return view('pet.index')->with(compact(
            'pets',
            'especies',
            'racas',
            'sexos'
        ));
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
        $pet = Pet::find($id);
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
        $pet = Pet::find($id);
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
     * Exibição de raças de acordo com a especie
     * 09-10-2023
     * @param  int $id_especie
     * @return json
     */
    public function racas(Request $request)
    {
        $resposta =  Raca::where('id_especie', $request->id_especie)->select('*')->orderBy('raca')->get();
        if ($resposta->count() > 0) {
            echo json_encode($resposta);
        } else {
            echo json_encode('');
        }
    }

    /**
     * 05-10-2023
     * @author Thomas Melo
     *
     */
}
