@extends('layouts.base')
@section('content')
<h1 class="mx-3 my-4">
    <i class="fa-solid fa-seedling"></i>
    @if ($especie)
    Editar Especie:
    Nº {{ $especie->id_especie}} - {{ $especie->especie }}
    @else
    Nova Especie
    @endif
</h1>
<form action="{{
        $especie ?
        route('especie.update',['id'=>$especie->id_especie]):
        route('especie.store')
    }}" method="post" enctype="multipart/form-data" class="row g-3">
    @csrf
<div class="row">

    <div class="col-md-7">
        <label class="form-label" for="especie">Especie*</label>
        <input class="form-control" type="text" id="especie" name="especie" value="{{
            $especie ?
            $especie->especie :
            old('especie')
          }}" required>
    </div>
    <div class="col-md-1">
        <label class="form-label" for="">.</label>
        <input class="btn btn-primary" type="submit" value="{{ $especie ? 'Atualizar' : 'Cadastrar' }}">
    </div>
</div>

</form>
@endsection
@section('scripts')
@parent
@endsection
