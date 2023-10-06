@extends('layouts.base')
@section('content')
<h1 class="mx-3 my-4">
    <i class="fa-solid fa-hand-holding-heart"></i>
    Adoção Nº {{ $adocao->id_adocao}}
</h1>
<div class="row">
    <p>
        Status: {{ $adocao->status->status }} -
        Inicio: {{ $adocao->dt_inicio->format('d/m/Y') }}
    </p>
    <p>
        <i class="fa-solid fa-paw"></i>
        {{ $adocao->pet->nome }}<br>
        <i class="fa-solid fa-feather-pointed"></i>
        {!! $adocao->pet->raca->raca !!} -
        <i class="fa-solid fa-seedling"></i>
        {!! $adocao->pet->raca->especie->especie !!}
    </p>
    <p>
        <i class="fa-solid fa-user"></i>
        {{ $adocao->cliente->nome }}<br>
        Sexo: {{ $adocao->cliente->sexo->sexo }}
        @if($adocao->cliente->nascimento)
           <i class="fa-solid fa-cake-candles"></i>
            Nascimento: {{ $adocao->cliente->nascimento->format('d/m/Y') }}
            ( {{ $adocao->cliente->nascimento->age }} anos)
        @endif
        <br><br>
        <i class="fa-solid fa-location-dot"></i>
        {{ $adocao->cliente->endereco }}, Nº {{ $adocao->cliente->numero }} {{ $adocao->cliente->complemento }}<br>
        {{ $adocao->cliente->bairro }}<br>
        {{ $adocao->cliente->cep }} - {{ $adocao->cliente->cidade }} / {{ $adocao->cliente->uf }}<br><br>

        <i class="fa-solid fa-mobile-screen-button"></i>
        ( {{ $adocao->cliente->ddd }} ) {{ $adocao->cliente->celular }}<br>
        <i class="fa-regular fa-envelope"></i>
        <a href="mailto:{{ $adocao->cliente->email }}">
            {{ $adocao->cliente->email }}
        </a>
    </p>
</div>
<div class="row">
    <h2>Descrição</h2>
</div>

<div class="row">
    <h2>Histórico da adoção</h2>
    <div class="table-responsive">
        <table class="table table-striped  table-hover ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Data</th>
                    <th>Usuário</th>
                    <th>Histórico</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($adocao->historico() as $h )
                <tr>
                    <td scope="row" class="col-1">

                    </td>
                    <td>{{ $h->created_at->format('d/m/Y \a\s H:i') }}h</td>
                    <td>{{ $h->usuario->name }}</td>
                    <td>{{ $h->historico }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        Nenhum registro retornado
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection
