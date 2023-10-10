@extends('layouts.base')
@section('content')
<h1 class="mx-3 my-4">
    <i class="fa-solid fa-paw"></i>
    Pet Nº {{ $pet->id_pet}}
    -
    <a class="btn btn-dark" href=" {{ route('pet.edit',['id'=>$pet->id_pet])}}">
        <i class="bi bi-pencil-square"></i>
    </a>
</h1>
<div class="row">
    <p class="fs-5">
        Nome: {{ $pet->nome }}<br>
        <i class="fa-solid fa-feather-pointed"></i>
        {!! $pet->raca->raca !!} -
        <i class="fa-solid fa-seedling"></i>
        {!! $pet->raca->especie->especie !!}
    </p>
</div>
<div class="row mt-2">
    <h2>Descrição</h2>
    {!! $pet->descricao !!}
</div>
<div class="row mt-2">
    <h2>Observações</h2>
    {!! $pet->observacao !!}
</div>

<div class="row mt-4">
    <h2>Histórico do Pet</h2>
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
                @forelse ($pet->historico() as $h )
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
