@extends('layouts.base')
@section('content')
<h1 class="mx-3 my-4">
    <i class="fa-solid fa-feather-pointed"></i>
    @if ($raca)
    Editar Raça:
    Nº {{ $raca->id_raca}} - {{ $raca->raca }}
    @else
    Nova Raça
    @endif
</h1>
<form action="{{
        $raca?
        route('raca.update',['id'=>$raca->id_raca]):
        route('raca.store')
    }}" method="post" enctype="multipart/form-data" class="row g-3">
    @csrf
<div class="row">
    <div class="col-md-4">
        <label for="id_especie" class="form-label">Espécie*</label>
        <select id="id_especie" name="id_especie" class="form-select" required>
            <option>Escolha...</option>
            @foreach ($especies::orderBy('especie')->get() as $item )
            <option value="{{ $item->id_especie}}" @selected( ( $raca && $raca->id_especie == $item->id_especie
                )
                ||
                old('id_especie') == $item->id_especie
                )
                >
                {{ $item->especie }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-7">
        <label class="form-label" for="raca">Raça*</label>
        <input class="form-control" type="text" id="raca" name="raca" value="{{
            $raca ?
            $raca->raca :
            old('raca')
          }}" required>
    </div>
    <div class="col-md-1">
        <label class="form-label" for="raca">.</label>
        <input class="btn btn-primary" type="submit" value="{{ $raca ? 'Atualizar' : 'Cadastrar' }}">
    </div>
</div>

</form>
@endsection
@section('scripts')
@parent
@endsection
