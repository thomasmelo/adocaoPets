@extends('layouts.base')
@section('content')
    <h1 class="mx-3 my-4">
        <i class="fa-solid fa-hand-holding-heart"></i>
        Adoção Nº {{ $adocao->id_adocao }}
    </h1>
    <form action="{{ route('adocao.update', ['id' => $adocao->id_adocao]) }}" method="post" enctype="multipart/form-data"
        class="row g-3 border border-black rounded p-3">
        @csrf
        <div class="row">
            <div class="col-md-2">
                <label for="id_status" class="form-label fw-bold">Status da adoção</label>
                <select id="id_status" name="id_status" class="form-select">
                    <option value="">Escolha...</option>
                    @foreach ($status::orderBy('status')->get() as $item)
                        <option value="{{ $item->id_status }}" @selected($adocao->id_status == $item->id_status)>
                            {{ $item->status }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-8">
                <label for="historico" class="form-label fw-bold">Observação*</label>
                <input class="form-control" type="text" name="historico" id="historico" value="" required>
            </div>
            <div class="col-md-2">
                <input class="btn btn-primary mt-4" type="submit" value="Atualizar Adoção">
            </div>
        </div>
    </form>

    <div class="row border border-black rounded p-3 mt-4">
        <p>
            <b>Status: </b>{{ $adocao->status->status }} -
            <b>Inicio: </b>{{ $adocao->dt_inicio->format('d/m/Y') }}
        </p>
        <p>
            <i class="fa-solid fa-paw"></i>
            {{ $adocao->pet->nome }} -
            <i class="fa-solid fa-feather-pointed"></i>
            {!! $adocao->pet->raca->raca !!} -
            <i class="fa-solid fa-seedling"></i>
            {!! $adocao->pet->raca->especie->especie !!}
        </p>
        <p>
            <i class="fa-solid fa-user"></i>
            {{ $adocao->cliente->nome }}<br>
            Sexo: {{ $adocao->cliente->sexo->sexo }}
            @if ($adocao->cliente->nascimento)
                <i class="fa-solid fa-cake-candles"></i>
                Nascimento: {{ $adocao->cliente->nascimento->format('d/m/Y') }}
                ( {{ $adocao->cliente->nascimento->age }} anos)
            @endif
            <br><br>
            <i class="fa-solid fa-location-dot"></i>
            {{ $adocao->cliente->endereco }}, Nº {{ $adocao->cliente->numero }} {{ $adocao->cliente->complemento }}<br>
            {{ $adocao->cliente->bairro }}<br>
            {{ $adocao->cliente->cep }} - {{ $adocao->cliente->cidade }} / {{ $adocao->cliente->uf }}<br>
        </p>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
