@extends('layouts.base')
@section('content')
<h1 class="my-4">
    <i class="fa-solid fa-feather-pointed"></i>
      Relação de Raças
    |
    <a class="btn btn-primary" href="{{ route('raca.create') }}">
        Nova Raça
    </a>
</h1>

{{-- alerts --}}
@include('layouts.partials.alerts')
{{-- /alerts --}}

{{-- paginação --}}
{!! $racas->links() !!}
{{-- /paginação --}}
<div class="table-responsive mt-4">
    <table class="table table-striped  table-hover ">
        <thead>
            <tr>
                <th>#</th>
                <th>Total de pets</th>
                <th>Raça</th>
                <th>Especie</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @forelse ($racas as $raca )
            <tr>
                <td scope="row" class="col-2">
                    <div class="flex-column">
                        {{-- ver --}}
                        <a class="btn btn-success" href="{{ route('raca.show',['id'=>$raca->id_raca])}}">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        {{-- editar --}}
                        <a class="btn btn-dark" href=" {{ route('raca.edit',['id'=>$raca->id_raca])}}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        {{-- excluir --}}
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modalExcluir"
                            data-identificacao="Código:{{ $raca->id_raca}} | Nome:{{ $raca->raca}}"
                            data-url="{{ route('raca.destroy',['id'=>$raca->id_raca])}}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </td>
                <td>{{ $raca->pets()->count() }}</td>
                <td>{{ $raca->raca }}</td>
                <td>{{ $raca->especie->especie}}</td>
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
