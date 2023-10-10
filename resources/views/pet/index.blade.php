@extends('layouts.base')
@section('content')
<h1 class="my-4">
    <i class="fa-solid fa-paw"></i>
    - Pets
    |
    <a class="btn btn-primary" href="{{ route('pet.create') }}">
        Novo Pet
    </a>
</h1>

{{-- alerts --}}
@include('layouts.partials.alerts')
{{-- /alerts --}}

{{-- pesquisa --}}
<form action="{{ route('pet.index') }}" method="get" class="m-1 p-2 border rounded">
    <div class="row">
        <div class="col-md-4">
            <label for="form-label" id="search">Informe o nome do pet</label>
            <input class="form-control" type="search" name="search" id="search"
                placeholder="Digite o que deseja pesquisar..." value="{{ old('search',request()->get('search')) }}">
        </div>

        <div class="col-md-3">
            <label for="id_raca" class="form-label">Raça</label>
            <select id="id_raca" name="id_raca" class="form-select">
                <option value="">Escolha...</option>
                @foreach ($racas::get() as $item )
                <option value="{{$item->id_raca}}"
                    @selected(request()->get('id_raca') && request()->get('id_raca') == $item->id_raca)>
                    {{ $item->raca}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label for="id_sexo" class="form-label">Sexo</label>
            <select id="id_sexo" name="id_sexo" class="form-select">
                <option value="">Escolha...</option>
                @foreach ($sexos::get() as $item )
                <option value="{{$item->id_sexo}}"
                    @selected(request()->get('id_sexo') && request()->get('id_sexo') == $item->id_sexo)>
                    {{ $item->sexo}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <input class="btn btn-success mt-4" type="submit" value="Pesquisar">
        </div>

        @if(
            request()->get('search') !='' ||
            request()->get('id_raca') !='' ||
            request()->get('id_sexo') !=''
        )
        <div class="col-md-2">
        <a class="btn btn-primary mt-4" href="{{ route('pet.index') }}">
            <i class="fa-solid fa-broom"></i>
            Limpar
        </a>
        </div>
        @endif
    </div>
</form>
{{-- /pesquisa --}}
<h1>Relação de Pets</h1>
{{-- paginação --}}
{!! $pets->appends([
'search'=>request()->get('search',''),
'id_raca'=>request()->get('id_raca',''),
'id_sexo'=>request()->get('id_sexo',''),
])->links() !!}
{{-- /paginação --}}
<div class="table-responsive mt-4">
    <table class="table table-striped  table-hover ">
        <thead>
            <tr>
                <th>#</th>
                <th>Cód.:</th>
                <th>Raca/Espécie</th>
                <th>Sexo</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Atualização</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @forelse ($pets as $pet )
            <tr>
                <td scope="row" class="col-2">
                    <div class="flex-column">
                        {{-- ver --}}
                        <a class="btn btn-success" href="{{ route('pet.show',['id'=>$pet->id_pet])}}">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        {{-- editar --}}
                        <a class="btn btn-dark" href=" {{ route('pet.edit',['id'=>$pet->id_pet])}}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        {{-- excluir --}}
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modalExcluir"
                            data-identificacao="Código:{{ $pet->id_pet}} | Nome:{{ $pet->nome}}"
                            data-url="{{ route('pet.destroy',['id'=>$pet->id_pet])}}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </td>
                <td>
                    {{ $pet->id_pet }}
                </td>
                <td>
                    {{ $pet->raca->raca }}
                    /
                    {{ $pet->raca->especie->especie }}
                </td>
                <td>{{ $pet->sexo->sexo }}</td>
                <td>{{ $pet->nome }}</td>
                <td>{{ $pet->descricao }}</td>
                <td>
                    {{ $pet->updated_at->format('d/m/Y \a\s H:i') }}h
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
