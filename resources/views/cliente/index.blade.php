@extends('layouts.base')
@section('content')
<h1 class="my-4">
    <i class="fa-solid fa-users"></i>
      Relação de Pessoas
    |
    <a class="btn btn-primary" href="{{ route('cliente.create') }}">
        Nova Pessoa
    </a>
</h1>

{{-- alerts --}}
@include('layouts.partials.alerts')
{{-- /alerts --}}

{{-- paginação --}}
{!! $clientes->links() !!}
{{-- /paginação --}}
<div class="table-responsive mt-4">
    <table class="table table-striped  table-hover ">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Contatos</th>
                <th>Adoções</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @forelse ($clientes as $cliente )
            <tr>
                <td scope="row" class="col-2">
                    <div class="flex-column">
                        {{-- ver --}}
                        <a class="btn btn-success" href="{{ route('cliente.show',['id'=>$cliente->id_cliente])}}">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        {{-- editar --}}
                        <a class="btn btn-dark" href=" {{ route('cliente.edit',['id'=>$cliente->id_cliente])}}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        {{-- excluir --}}
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modalExcluir"
                            data-identificacao="Código:{{ $cliente->id_cliente}} | Nome:{{ $cliente->cliente}}"
                            data-url="{{ route('cliente.destroy',['id'=>$cliente->id_cliente])}}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </td>
                <td>
                    <b>Cod.: {{ $cliente->id_cliente}}</b><br>
                    {{ $cliente->nome }}<br>
                    {{ $cliente->nascimento->age }} anos /
                    {{ $cliente->sexo->sexo }}

                </td>
                <td>
                    {!! $cliente->enderecoCompleto() !!}<br>
                    {!! $cliente->contatos() !!}
                </td>
                <td>{{ $cliente->adocao()->count()}}</td>
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

{{-- Modal Excluir --}}
@include('layouts.partials.modalExcluir')
{{-- /Modal Excluir --}}
@endsection
@section('scripts')
@parent

@endsection
