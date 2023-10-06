@extends('layouts.base')
@section('content')
<h1 class="mx-3 my-4">
    <i class="fa-solid fa-hand-holding-heart"></i>
    @if ($adocao)
    Editar Adoção:
    Nº {{ $adocao->id_adocao}}
    @else
    Nova Adoção
    @endif
</h1>
<form action="{{
        $adocao?
        route('adocao.update',['id'=>$adocao->id_adocao]):
        route('adocao.store')
    }}" method="post" enctype="multipart/form-data" class="row g-3">
    @csrf
    <div class="col-md-2">
        <label for="id_status" class="form-label">Pet*</label>
        <select id="id_status" name="id_status" class="form-select" required>
            <option>Escolha...</option>
            @foreach ($status::orderBy('status')->get() as $item )
            <option value="{{ $item->id_status}}" @selected( ( $adocao && $adocao->id_status == $item->id_status
                )
                ||
                old('id_status') == $item->id_status
                )
                >
                {{ $item->status }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="id_pet" class="form-label">Pet*</label>
        <select id="id_pet" name="id_pet" class="form-select" required>
            <option>Escolha...</option>
            @foreach ($pets as $pet )
            <option value="{{ $pet->id_pet}}"
            @selected(
                (
                    $adocao &&
                    $adocao->id_pet == $pet->id_pet
                )
                ||
                old('id_pet') == $pet->id_pet
                )
                >
                {{ $pet->nome }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label for="id_cliente" class="form-label">Pessoa*</label>
        <select id="id_cliente" name="id_cliente" class="form-select" required>
            <option value="">Escolha...</option>
                @foreach ($clientes->get() as $cliente )
                    <option value="{{$cliente->id_cliente}}"
                        @selected(
                            (
                                $adocao &&
                                $adocao->id_cliente == $cliente->id_cliente
                            )
                            ||
                            old('id_cliente') == $cliente->id_cliente
                        )
                    >
                        {{ $cliente->nome}}
                    </option>
                @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <label class="form-label" for="valor">Data de Inicio</label>
        <input type="text" class="disabled" value="{{
            $adocao?
            $adocao->dt_inicio->format('d/m/Y'):
            date('d/m/Y')
        }}" >
    </div>

    <div class="col-md-12">
        <label class="form-label" for="descricao">Descrição*</label>
        <input class="form-control" type="text" id="descricao" name="descricao"
        value="{{
            $adocao ?
            $adocao->descricao :
            old('descricao')
          }}"
          required>
    </div>
    <div class="col-md-2 offset-md-9">
        <input class="btn btn-primary" type="submit"
         value="{{ $adocao ? 'Atualizar' : 'Cadastrar' }}"
         >
    </div>


</form>
@endsection
@section('scripts')
@parent
@endsection
