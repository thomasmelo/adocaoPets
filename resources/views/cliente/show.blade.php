@extends('layouts.base')
@section('content')
<div class="card-deck">
    <div class="card border-dark mt-1">
        <div class="card-header">
            <H3 class="mx-3 my-4">
                <i class="fa-solid fa-users"></i>
                Cod.: {{ $cliente->id_cliente }} -
                <a class="btn btn-dark" href=" {{ route('cliente.edit',['id'=>$cliente->id_cliente])}}">
                    <i class="bi bi-pencil-square"></i>
                </a>

                {{ $cliente->nome }}
            </H3>
        </div>
    </div>
</div>
{{-- CONTATOS / ENDEREÇO --}}
<div class="row row-cols-1 row-cols-md-3 g-4">

    <div class="col">
        <div class="card border-dark mt-1">
            <div class="card-header">
                <h5>
                    <i class="fa-solid fa-users"></i>
                    Dados Pessoais
                </h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Nome:</strong> {{ $cliente->nome }} / {{ $cliente->sexo->sexo }}<br>
                    <strong>Nascimento:</strong> {{ $cliente->nascimento->format('d/m/Y') }} - {{
                    $cliente->nascimento->age }} anos<br>
                    <strong>CPF:</strong> {{ $cliente->cpf }}
                </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card border-dark mt-1">
            <div class="card-header">
                <h5>
                    <i class="fa-solid fa-mobile-screen"></i>
                    Contatos
                </h5>
            </div>
            <div class="card-body">
                <p>
                    <i class="fa-solid fa-mobile-screen"></i>
                    ({{ $cliente->ddd }}) {{ $cliente->celular }} <br>
                    <i class="fa-solid fa-envelope"></i>
                    {{ $cliente->email }}

                </p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card border-dark mt-1">
            <div class="card-header">
                <h5>
                    <i class="fa-solid fa-location-dot"></i>
                    Endereço
                </h5>
            </div>
            <div class="card-body">
                <p>
                    {!! $cliente->enderecoCompleto() !!}
                </p>
            </div>
        </div>
    </div>
</div>
{{-- /CONTATOS --}}

{{-- ADOÇÕES --}}
<div class="row mt-4">

    <h3>
        <i class="fa-solid fa-hand-holding-heart"></i>
        Adoções da pessoa
        -
        <a class="btn btn-primary" href="#">
            Nova Adoção
        </a>
    </h3>
    <div class="table-responsive mt-4">
        <table class="table table-striped  table-hover ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Raça/ Especie</th>
                    <th>Nome</th>
                    <th>Observações</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($cliente->adocao()->get() as $adocao )
                <tr>
                    <td scope="row" class="col-2">
                        <div class="flex-column">
                            {{-- ver --}}
                            <a class="btn btn-success" href="{{ route('adocao.show',['id'=>$adocao->id_adocao])}}">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                            {{-- editar --}}
                            <a class="btn btn-dark" href=" {{ route('adocao.edit',['id'=>$adocao->id_adocao])}}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </div>
                    </td>
                    <td>
                        <b>Cod.: {{ $adocao->id_adocao}}</b>
                    </td>
                    <td>
                        {{ $adocao->pet->raca->raca }}
                        /
                        {{ $adocao->pet->raca->especie->especie }}

                    </td>
                    <td>
                        {{ $adocao->pet->nome }}
                    </td>
                    <td>{{ $adocao->observacao}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        Nenhuma registro retornado
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{-- /ADOÇÕES --}}

@endsection
@section('scripts')
@parent

@endsection
