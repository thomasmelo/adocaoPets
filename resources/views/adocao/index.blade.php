@extends('layouts.base')
@section('content')
<h1>
    <i class="fa-solid fa-hand-holding-heart"></i>
    - ADOÇÕES
    |
    <a class="btn btn-primary" href="{{ route('adocao.create') }}">
        Nova Adoção
    </a>
</h1>

{{-- alerts --}}
@include('layouts.partials.alerts')
{{-- /alerts --}}
{{-- paginação --}}
{!! $adocoes->appends(['search'=>request()->get('search','')])->links() !!}
{{-- /paginação --}}
{{-- pesquisa --}}
<div class="row">
    <form action="{{ route('adocao.index') }}" method="get">

        <input class="form-control col-md-4" type="search" name="search" id="search"
            placeholder="Digite o que deseja pesquisar..." value="{{ old('search',request()->get('search')) }}">

        {{-- data inicial --}}
        <div class="col-md-3">
            <label class="form-label" for="dt_inicio">
                Data de inicio
            </label>
            <input class="form-control" type="date" name="dt_inicio" id="dt_inicio">
        </div>
        {{-- /data inicial --}}
        <div class="col-md-3">
            <label for="id_status" class="form-label">Status</label>
            <select id="id_status" name="id_status" class="form-select">
                <option value="">Escolha...</option>
                @foreach ($status::orderBy('status')->get() as $item )
                <option value="{{$item->id_status}}">
                    {{ $item->status}}
                </option>
                @endforeach
            </select>
        </div>

        <input class="btn btn-success col-md-1" type="submit" value="Pesquisar">

        @if(request()->get('search') !='')
        <a class="btn btn-primary col-md-1" href="{{ route('adocao.index') }}">
            Limpar
        </a>
        @endif

    </form>
</div>
{{-- /pesquisa --}}
<div class="table-responsive">
    <table class="table table-striped  table-hover ">
        <thead>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Inicio</th>
                <th>Pessoa</th>
                <th>Pet</th>
                <th>Descrição</th>
                <th>Atulização</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @forelse ($adocoes as $adocao )
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
                        {{-- excluir --}}
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modalExcluir"
                            data-identificacao="Código:{{ $adocao->id_adocao}} | Nome:{{ $adocao->pet->nome}}"
                            data-url="{{ route('adocao.destroy',['id'=>$adocao->id_adocao])}}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </td>
                <td>{{ $adocao->status->status }}</td>
                <td>{{ $adocao->dt_inicio->format('d/m/Y') }}</td>
                <td>{{ $adocao->cliente->nome }}</td>
                <td>{{ $adocao->pet->nome }}</td>
                <td>{{ $adocao->descricao }}</td>
                <td>
                    {{ $adocao->updated_at->format('d/m/Y \a\s H:i') }}h
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    Nenhum registro retornado
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
