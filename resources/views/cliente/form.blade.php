@extends('layouts.base')
@section('content')
<h1 class="mx-3 my-4">
    <i class="fa-solid fa-users"></i>
    @if ($cliente)
    Editar Pessoa:
    Nº {{ $cliente->id_cliente}} - {{ $cliente->nome }}
    @else
    Nova Pessoa
    @endif
</h1>
<form action="{{
        $cliente?
        route('cliente.update',['id'=>$cliente->id_cliente]):
        route('cliente.store')
    }}" method="post" enctype="multipart/form-data" class="row g-3">
    @csrf
    {{-- DADOS PESSOAIS --}}
    <div class="card-deck">
        <div class="card border-dark mt-1">
            <div class="card-header">
                <h5>
                    <i class="fa-solid fa-users"></i>
                    Dados Pessoais
                </h5>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-5">
                        <label class="form-label" for="nome">Nome*</label>
                        <input class="form-control" type="text" id="nome" name="nome" value="{{ $cliente ?
                            $cliente->nome :
                            old('nome')
                        }}" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="cpf">CPF*</label>
                        <input class="form-control" type="text" id="cpf" name="cpf" value="{{
                            $cliente ?
                            $cliente->cpf :
                            old('cpf')
                        }}" required>
                        <div id="alerta" class="alert alert-danger" style="display: none;"></div>
                    </div>
                    <div class="col-md-2">
                        <label for="id_sexo" class="form-label">Sexo*</label>
                        <select id="id_sexo" name="id_sexo" class="form-select" required>
                            <option>Escolha...</option>
                            @foreach ($sexos::orderBy('sexo')->get() as $item )
                            <option value="{{ $item->id_sexo}}" @selected( ( $cliente && $cliente->id_sexo ==
                                $item->id_sexo
                                )
                                ||
                                old('id_sexo') == $item->id_sexo
                                )
                                >
                                {{ $item->sexo }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="nascimento">Nascimento*</label>
                        <input class="form-control" type="date" id="nascimento" name="nascimento" value="{{ $cliente ? $cliente->nascimento :
                            old('nascimento')
                        }}" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- /DADOS PESSOAIS --}}
    {{-- CONTATOS --}}
    <div class="card-deck">
        <div class="card border-dark mt-1">
            <div class="card-header">
                <h5>
                    <i class="fa-solid fa-mobile-screen"></i>
                    Contatos
                </h5>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-1">
                        <label for="ddd" class="form-label">DDD</label>
                        <input type="tel" class="form-control" name="ddd" id="ddd"
                            value="{!! $cliente ? $cliente->ddd : old('ddd') !!}" placeholder="" maxlength="2">
                    </div>
                    <div class="col-md-3">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="tel" class="form-control" name="celular" id="celular"
                            value="{!! $cliente ? $cliente->celular : old('celular') !!}" placeholder="Ex.: 91234-5678">
                    </div>

                    <div class="col-md-8">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email"
                            value="{!! $cliente  ? $cliente->email : old('email') !!}"
                            placeholder="Ex.: jose@email.com">
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- /CONTATOS --}}
    {{-- ENDEREÇO --}}
    <div class="card-deck">
        <div class="card border-dark mt-1">
            <div class="card-header">
                <h5>
                    <i class="fa-solid fa-location-dot"></i>
                    Endereço
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <label for="cep" class="form-label">CEP*:</label>
                        <input type="text" class="form-control" name="cep" id="cep"
                            value="{!! $cliente ? $cliente->cep : old('cep') !!}" placeholder="CEP 01122-000">
                    </div>

                    <div class="col-md-6">
                        <label for="endereco" class="form-label">Endereço*:</label>
                        <input type="text" class="form-control" name="endereco" id="endereco"
                            value="{!! $cliente ? $cliente->endereco : old('endereco') !!}"
                            placeholder="Nome da rua ou avenida" disabled>
                    </div>
                    <div class="col-md-2">
                        <label for="numero" class="form-label">Número*:</label>
                        <input type="text" class="form-control" name="numero" id="numero"
                            value="{!! $cliente ? $cliente->numero : old('numero') !!}" placeholder="Número" disabled>
                    </div>
                    <div class="col-md-2">
                        <label for="complemento" class="form-label">Complemento:</label>
                        <input type="text" class="form-control" name="complemento" id="complemento"
                            value="{!! $cliente ? $cliente->complemento : old('complemento') !!}"
                            placeholder="Ex.: Ap 123" disabled>
                    </div>

                    <div class="col-md-5">
                        <label for="bairro" class="form-label">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" id="bairro"
                            value="{!! $cliente ? $cliente->bairro : old('bairro') !!}" placeholder="Bairro" disabled>
                    </div>

                    <div class="col-md-5">
                        <label for="cidade" class="form-label">Cidade*:</label>
                        <input type="text" class="form-control" name="cidade" id="cidade"
                            value="{!! $cliente ? $cliente->cidade : old('cidade') !!}" placeholder="Cidade" disabled>
                    </div>

                    <div class="col-md-2">
                        <label for="uf" class="form-label">Estado*:</label>
                        <input type="text" class="form-control" name="uf" id="uf"
                            value="{!! $cliente ? $cliente->uf : old('uf') !!}" placeholder="Ex.: SP" maxlength="2"
                            disabled>
                        <input type="hidden" name="ibge" id="ibge"
                            value="{!! $cliente ? $cliente->ibge : old('ibge') !!}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- /ENDEREÇO --}}

    {{-- OBSERVAÇÕES --}}
    <div class="card-deck">
        <div class="card border-dark mt-1">
            <div class="card-header">
                <h5>
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Observações
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <textarea name="observacao" id="observacao" rows="5"
                        class="form-control">{{ $cliente ? $cliente->observacao:old('observacao') }}</textarea>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{--/ OBSERVAÇÕES --}}
    <div class="row my-4">
        <div class="col-md-2 offset-md-10">
            <input class="btn btn-primary" type="submit" value="{{ $cliente ? 'Atualizar' : 'Cadastrar' }}">
        </div>
    </div>



</form>
@endsection
@section('scripts')
@parent
{{-- Preenchimento automático do CEP --}}
<script src="{{ asset('js/getEndereco.js') }}"></script>

{{-- VALIDAÇÃO CPF CNPJ --}}
<script src="{{ asset('js/valida_cpf_cnpj.js') }}"></script>
<script>
    $("#alerta").hide();

        $('#cpf').blur(function() {
            var cpf = $(this).val().replace(/[^0-9]/g, '');
            $(this).val(cpf);
            // Testa a validação
            if (valida_cpf_cnpj(cpf)) {
                $("#alerta").empty().hide();
            } else {
                $("#alerta").empty().hide();
                $("#alerta").append("Nº de CPF inválido");
                $("#alerta").show();
                $('#cpf').val('');
                $('#cpf').focus();
            }
        });
</script>
@endsection
