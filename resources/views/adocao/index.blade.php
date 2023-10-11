@extends('layouts.base')
@section('content')
    <h1 class="my-4">
        <i class="fa-solid fa-hand-holding-heart"></i>
        - ADOÇÕES
    </h1>

    {{-- alerts --}}
    @include('layouts.partials.alerts')
    {{-- /alerts --}}

    {{-- pesquisa --}}

    <form action="{{ route('adocao.index') }}" method="get"  class="m-3 p-2 border rounded">
        <div class="row">
            <div class="col-md-4">
                <label for="form-label" id="search">
                    &nbsp;</label>
                <input class="form-control" type="search" name="search" id="search"
                    placeholder="Digite o nome do pet ou da pessoa..." value="{{ old('search', request()->get('search')) }}">
            </div>
            {{-- data inicial --}}
            <div class="col-md-2">
                <label class="form-label" for="dt_inicio">
                    Data de inicio
                </label>
                <input class="form-control" type="date" name="dt_inicio" id="dt_inicio"
                value="{{ old('dt_inicio', request()->get('dt_inicio')) }}">
            </div>
            {{-- /data inicial --}}
            <div class="col-md-3">
                <label for="id_status" class="form-label">Status</label>
                <select id="id_status" name="id_status" class="form-select">
                    <option value="">Escolha...</option>
                    @foreach ($status::orderBy('status')->get() as $item)
                        <option value="{{ $item->id_status }}"
                            @selected(request()->get('id_status')== $item->id_status)>
                            {{ $item->status }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <input class="btn btn-success mt-4" type="submit" value="Pesquisar">
            </div>

            @if (request()->get('search') != '' || request()->get('dt_inicio') != '' || request()->get('id_status') != '')
                <div class="col-md-2">
                    <a class="btn btn-primary mt-4" href="{{ route('adocao.index') }}">
                        <i class="fa-solid fa-broom"></i>
                        Limpar
                    </a>
                </div>
            @endif
        </div>
    </form>

    {{-- /pesquisa --}}
    <h1>Relação de adoções</h1>
    {{-- paginação --}}
    {!! $adocoes->appends([
            'search' => request()->get('search', ''),
            'dt_inicio' => request()->get('dt_inicio', ''),
            'id_status' => request()->get('id_status', ''),
        ])->links() !!}
    {{-- /paginação --}}
    <div class="table-responsive mt-4">
        <table class="table table-striped  table-hover ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cod.:</th>
                    <th>Status</th>
                    <th>Inicio</th>
                    <th>Pessoa</th>
                    <th>nome do Pet</th>
                    <th>Descrição</th>
                    <th>Atualização</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($adocoes as $adocao)
                    <tr>
                        <td scope="row" class="col-1">
                            <div class="flex-column">
                                {{-- ver --}}
                                <a class="btn btn-success" href="{{ route('adocao.show', ['id' => $adocao->id_adocao]) }}">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                {{-- editar --}}
                                <a class="btn btn-dark" href=" {{ route('adocao.edit', ['id' => $adocao->id_adocao]) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                {{-- excluir --}}
                                {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalExcluir"
                                    data-identificacao="Código:{{ $adocao->id_adocao }} | Nome:{{ $adocao->pet->nome }}"
                                    data-url="{{ route('adocao.destroy', ['id' => $adocao->id_adocao]) }}">
                                    <i class="bi bi-trash"></i>
                                </button> --}}
                            </div>
                        </td>
                        <td>{{ $adocao->id_adocao }}</td>
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
