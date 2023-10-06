@extends('layouts.base')
@section('content')
<h1 class="my-4">
    <i class="fa-solid fa-seedling"></i>
      Relação de Especies
    |
    <a class="btn btn-primary" href="{{ route('especie.create') }}">
        Nova Especie
    </a>
</h1>

{{-- alerts --}}
@include('layouts.partials.alerts')
{{-- /alerts --}}

{{-- paginação --}}
{!! $especies->links() !!}
{{-- /paginação --}}
<div class="table-responsive mt-4">
    <table class="table table-striped  table-hover ">
        <thead>
            <tr>
                <th>#</th>
                <th>Especie</th>
                <th>Total de raças</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @forelse ($especies as $especie )
            <tr>
                <td scope="row" class="col-2">
                    <div class="flex-column">
                        {{-- ver --}}
                        <a class="btn btn-success" href="{{ route('especie.show',['id'=>$especie->id_especie])}}">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        {{-- editar --}}
                        <a class="btn btn-dark" href=" {{ route('especie.edit',['id'=>$especie->id_especie])}}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        {{-- excluir --}}
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modalExcluir"
                            data-identificacao="Código:{{ $especie->id_especie}} | Nome:{{ $especie->raca}}"
                            data-url="{{ route('especie.destroy',['id'=>$especie->id_especie])}}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </td>
                <td>{{ $especie->especie }}</td>
                <td>{{ $especie->racas()->count() }}</td>
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
