@extends('layouts.base')
@section('content')
<h1 class="mx-3 my-4">
    <i class="fa-solid fa-seedling"></i>
    Especie: {{ $especie->especie }}
</h1>

<div class="row">
    <h2>
        <i class="fa-solid fa-feather-pointed"></i>
        Relação de Raças - {{ $especie->racas()->count()}}
    </h2>
    <div class="table-responsive">
        <table class="table table-striped  table-hover ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>#</th>
                    <th>Raça</th>
                    <th>Nº de pets</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($especie->racas()->get() as $raca )
                <tr>
                    <td scope="row" class="col-1">
                        {{-- ver --}}
                        <a class="btn btn-success" href="{{ route('raca.show',['id'=>$raca->id_raca])}}">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $raca->raca }}</td>
                    <td>{!! $raca->pets()->count() !!}</td>

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
