@extends('layouts.base')
@section('content')
    <h1 class="mx-3 my-4">
        <i class="fa-solid fa-paw"></i>
        @if ($pet)
            Editar Pet:
            Nº {{ $pet->id_pet }}
        @else
            Novo Pet
        @endif
    </h1>
    <form action="{{ $pet ? route('pet.update', ['id' => $pet->id_pet]) : route('pet.store') }}" method="post"
        enctype="multipart/form-data" class="row g-3">
        @csrf
        <div class="col-md-2">
            <label for="id_especie" class="form-label">Especie*</label>
            @if ($pet)
                <input class="form-control" type="text" value="{{ $pet->raca->especie->especie }}" disabled>
            @else
            <select id="id_especie" name="id_especie" class="form-select" required>
                <option value="">Escolha...</option>
                @foreach ($especies::orderBy('especie')->get() as $item)
                    <option value="{{ $item->id_especie }}" @selected(($pet && $pet->id_especie == $item->id_especie) || old('id_especie') == $item->id_especie)>
                        {{ $item->especie }}
                    </option>
                @endforeach
            </select>
            @endif
        </div>
        <div class="col-md-4">
            <label for="id_raca" class="form-label">Raça*</label>
            @if ($pet)
                <input class="form-control" type="text" value="{{ $pet->raca->raca }}" disabled>
            @else
                <select id="id_raca" name="id_raca" class="form-select" required disabled>
                    <option value="1">Escolha uma espécie primeiro...</option>
                </select>
            @endif


        </div>
        <div class="col-md-3">
            <label for="id_sexo" class="form-label">Sexo*</label>
            <select id="id_sexo" name="id_sexo" class="form-select" required>
                <option value="1">Escolha...</option>
                @foreach ($sexos::all() as $sexo)
                    <option value="{{ $sexo->id_sexo }}" @selected(($pet && $pet->id_sexo == $sexo->id_sexo) || old('id_sexo') == $sexo->id_sexo)>
                        {{ $sexo->sexo }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label" for="nascimento">Data de Nascimento</label>
            <input type="date" class="form-control"
                value="{{ $pet ? $pet->nascimento->format('Y-m-d') : old('nascimento') }}">
        </div>

        <div class="col-md-12">
            <label class="form-label" for="descricao">Descrição</label>
            <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="5">{{ $pet ? $pet->descricao : old('descricao') }}</textarea>
        </div>
        <div class="col-md-12">
            <label class="form-label" for="observacao">Observações</label>
            <textarea class="form-control" name="observacao" id="observacao" cols="30" rows="5">{{ $pet ? $pet->observacao : old('observacao') }}</textarea>
        </div>

        <div class="col-md-2 offset-md-9">
            <input class="btn btn-primary" type="submit" value="{{ $pet ? 'Atualizar' : 'Cadastrar' }}">
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
