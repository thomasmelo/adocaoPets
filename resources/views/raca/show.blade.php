@extends('layouts.base')
@section('content')
<h1 class="mx-3 my-4">
    <i class="fa-solid fa-feather-pointed"></i>
    Raça {{ $raca->raca }} -
    <i class="fa-solid fa-seedling"></i>
    {{ $raca->especie->especie }}
</h1>

<div class="row">
    <h2>
        <i class="fa-solid fa-paw"></i>
        Relação de Pets
    </h2>
    <div class="table-responsive">
        <table class="table table-striped  table-hover ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>#</th>
                    <th>Nome do pet</th>
                    <th>Descrição</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($raca->pets()->get() as $pet )
                <tr>
                    <td scope="row" class="col-1">
                        {{-- ver --}}
                        <a class="btn btn-success" href="{{ route('pet.show',['id'=>$pet->id_pet])}}">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pet->nome }}</td>
                    <td>{!! $pet->descricao !!}</td>
                    <td>{!! $pet->observacao !!}</td>

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
