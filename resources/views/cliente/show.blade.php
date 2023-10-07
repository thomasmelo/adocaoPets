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
                    <strong>Nascimento:</strong> {{ $cliente->nascimento->format('d/m/Y') }} - {{ $cliente->nascimento->age }} anos<br>
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
                    {!!  $cliente->enderecoCompleto() !!}
                </p>
            </div>
        </div>
    </div>


</div>
{{-- /CONTATOS --}}

@endsection
@section('scripts')
@parent

@endsection
