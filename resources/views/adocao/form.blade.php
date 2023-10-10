@extends('layouts.base')
@section('content')
    <h1 class="mx-3 my-4">
        <i class="fa-solid fa-hand-holding-heart"></i>
        Nova Adoção - {{ $cliente->nome }}
    </h1>
    {{-- PESQUISA --}}
    <form action="{{ route('adocao.create', ['id_cliente' => $cliente->id_cliente]) }}" method="get"
        class="m-3 p-2 border rounded">
        <div class="row">
            <div class="col-md-2">
                <label for="id_especie" class="form-label">Especie*</label>
                <select id="id_especie" name="id_especie" class="form-select" required>
                    <option value="">Escolha...</option>
                    @foreach ($especies::orderBy('especie')->get() as $item)
                        <option value="{{ $item->id_especie }}">
                            {{ $item->especie }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="id_raca" class="form-label">Raça*</label>
                <select id="id_raca" name="id_raca" class="form-select" required disabled>
                    <option value="1">Escolha uma espécie primeiro...</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="id_sexo" class="form-label">Sexo*</label>
                <select id="id_sexo" name="id_sexo" class="form-select" required>
                    <option value="1">Escolha...</option>
                    @foreach ($sexos::orderBy('sexo')->get() as $sexo)
                        <option value="{{ $sexo->id_sexo }}">
                            {{ $sexo->sexo }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <input class="btn btn-success mt-4" type="submit" value="Pesquisar">
            </div>

        </div>
    </form>
    {{-- /PESQUISA --}}
    <h1>
        Lista de Pets
        @if (request()->get('id_especie') != '' || request()->get('id_raca') != '' || request()->get('id_raca') != '')
            -
            <a class="btn btn-primary" href="{{ route('adocao.create', ['id_cliente' => $cliente->id_cliente]) }}">
                <i class="fa-solid fa-broom"></i>
                Limpar
            </a>
        @endif

    </h1>

    <form action="{{ route('adocao.store',['id_cliente'=>$cliente->id_cliente]) }}"
        method="post" enctype="multipart/form-data" class="row g-3">
        @csrf
       {{-- PETS --}}
        <div class="table-responsive mt-4">
            <caption>
                {{-- paginação --}}
                {!! $pets->appends([
                        'id_raca' => request()->get('id_raca', ''),
                        'id_sexo' => request()->get('id_sexo', ''),
                    ])->links() !!}
                {{-- /paginação --}}
            </caption>
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
                    @forelse ($pets as $pet)
                        <tr>
                            <td scope="row" class="col-1">
                                <input class="form-check-input" type="radio" name="id_pet" value="{{ $pet->id_pet }}"
                                    required>
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
        {{-- /PETS --}}

        <div class="col-md-2 offset-md-9 mb-4">
            <input class="btn btn-primary" type="submit" value="Iniciar Adoção">
        </div>


    </form>
@endsection
@section('scripts')
    @parent
    <script>
        $('#id_especie').change(function(e) {
            e.preventDefault();
            let id_especie = this.value;
            $.ajax({
                type: "get",
                url: "{{ url('') }}/animais/racas/" + id_especie,
                dataType: "json",
                success: function(response) {
                    let racas = response.length;
                    let options = "";
                    if (racas > 0) {
                        options += '<option value="">Selecione uma Raça</option>';
                        $.each(response, function(key, value) {
                            options += '<option value="' + value.id_raca + '">' + value.raca +
                                '</option>';
                        });
                    } else {
                        options += '<option value="1">Selecione uma especie primeiro</option>';
                    }
                    $("#id_raca").html(options);
                    $('#id_raca').removeAttr('disabled', 'disabled');
                    $('#id_raca').focus();
                }
            }).fail(function(jqXHR, textStatus, error) {
                let options = '<option value="1">Selecione uma especie primeiro</option>';
                $("#id_raca").html(options);
                $('#id_raca').removeAttr('disabled', 'disabled');
                $('#id_raca').focus();
            });
        });
    </script>
@endsection
