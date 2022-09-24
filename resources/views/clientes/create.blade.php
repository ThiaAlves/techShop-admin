@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)
@section('plugins.JqueryValidation', true)
@section('plugins.Inputmask', true)
@section('title', 'Clientes')

@section('content_header')

    <div class="row">
        <div class="col">
            <h1><i class="fa fa-users"></i> Clientes</h1>
            <p>Alteração de Clientes.</p>
        </div>
        <div class="col text-right">
            <button type="button" class="btn bg-none text-end btn-lg"
                onclick="window.location.href='{{ route('clientes.index') }}'">
                <i class="fa fa-list"></i>
            </button>
        </div>
    </div>
@stop

@section('css')

    <style>
        .dadosCliente,
        .dadosEndereco {
            cursor: pointer;
        }

        .dadosCliente {
            /* Light olive */
            background-color: #b4daa9;
        }

        .dadosEndereco {
            /* Light blue */
            background-color: #ade7e7;
        }

        #btnDadosCliente:hover,
        #btnDadosEndereco:hover {
            filter: brightness(90%);
            transition: 0.3s;
        }

        /* Remove background-color in inputs */
        .row input,
        .row select,
        .row textarea {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #000;
            border-radius: 0;
            box-shadow: none;
            outline: none;
            transition: none;
            color: #000;
        }

        /* placeholder */
        .row input::-webkit-input-placeholder,
        .row select::-webkit-input-placeholder,
        .row textarea::-webkit-input-placeholder {
            color: rgb(54, 53, 53);
        }

        .row input:focus,
        .row select:focus,
        .row textarea:focus {
            border-bottom: 1px solid #000;
            box-shadow: none;
            outline: none;
            background-color: transparent;
            color: #000;
        }

        .accordionEndereco {
            background-color: #ade7e781 !important;
        }
    </style>
@endsection

@section('content')
    <!-- Modal -->
    <form method="post" action="{{ route('clientes') }}" id="formCliente">
        @csrf
        <div class="modal-body">
            <div class="row text-center">
                <div id="btnDadosCliente" class="dadosCliente col rounded-top mr-2 ml-2 p-2">
                    <i class="fa fa-user"></i> Dados do Cliente
                </div>
                <div id="btnDadosEndereco" class="dadosEndereco col rounded-top mr-2 ml-2 p-2">
                    <i class="fa fa-map-marker-alt"> </i> Endereços Cadastrados
                </div>
            </div>
            <div id="dadosCliente" class="p-4 rounded-bottom dadosCliente">
                <div class="row">
                    <div class="col" hidden>
                        <label for="id">Id:</label>
                        <input type="text" id="id" name="id" class="form-control"
                            value="{{ $cliente->id ?? '' }}">
                    </div>
                    <div class="col">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" class="form-control"
                            placeholder="Informe o Nome do cliente" value="{{ $cliente->nome ?? '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" class="form-control"
                            placeholder="Informe o CPF do cliente" value="{{ $cliente->cpf ?? '' }}">
                    </div>
                    <div class="col">
                        <label for="data_nascimento">Data de Nascimento:</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" class="form-control"
                            placeholder="Informe a Data de Nascimento do cliente"
                            value="{{ $cliente->data_nascimento ?? '' }}">
                    </div>
                    <div class="col">
                        <label for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" class="form-control"
                            placeholder="Informe o Telefone do cliente" value="{{ $cliente->telefone ?? '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="email">E-mail:</label>
                        <input type="text" id="email" name="email" class="form-control"
                            placeholder="Informe o E-mail do cliente" value="{{ $cliente->email ?? '' }}">
                    </div>
                    <div class="col">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" class="form-control"
                            placeholder="Informe a Senha do cliente">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="status">Status:</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" {{ isset($cliente) ? ($cliente->status == 1 ? 'selected' : '') : '' }}>
                                Ativo</option>
                            <option value="0" {{ isset($cliente) ? ($cliente->status == 0 ? 'selected' : '') : '' }}>
                                Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="text-right mt-4">
                    <x-adminlte-button type="button" theme="secondary" icon="fas fa-arrow-left" label="Voltar"
                        onclick="window.location.href='{{ route('clientes.index') }}'" />
                    
                    <x-adminlte-button type="submit" theme="success" icon="fas fa-check" label="Salvar" />
                </div>
    </form>
    </div>
    <div id="dadosEndereco" class="p-4 rounded-bottom dadosEndereco">
        {{-- Accordion --}}
        <div class="accordion" id="accordionExample">
            {{-- Novo endereço --}}
            <div class="card">
                <div class="card-header" id="headingNovo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapseNovo" aria-expanded="true"
                            aria-controls="collapseNovo">
                            Adicionar novo endereço <i class="fas fa-plus"></i>
                        </button>
                    </h2>
                </div>
                <form action="{{route('enderecos')}}" method="POST">
                    @csrf
                <div id="collapseNovo" class="collapse" aria-labelledby="headingNovo"
                    data-parent="#accordionExample">
                    <div class="card-body accordionEndereco">
                        <div class="row">
                            <input type="text" id="cliente_id" name="cliente_id" class="form-control"
                                value="{{ $cliente->id ?? '' }}" hidden>
                            <div class="col">
                                <label for="cep">CEP:</label>
                                <input type="text" id="cep" name="cep" class="form-control"
                                    placeholder="Informe o CEP do cliente">
                            </div>
                            <div class="col">
                                <label for="logradouro">Logradouro:</label>
                                <input type="text" id="logradouro" name="logradouro" class="form-control"
                                    placeholder="Informe o Logradouro do cliente">
                            </div>
                            <div class="col">
                                <label for="numero">Número:</label>
                                <input type="text" id="numero" name="numero" class="form-control"
                                    placeholder="Informe o Número do cliente">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="complemento">Complemento:</label>
                                <input type="text" id="complemento" name="complemento" class="form-control"
                                    placeholder="Informe o Complemento do cliente">
                            </div>
                            <div class="col">
                                <label for="bairro">Bairro:</label>
                                <input type="text" id="bairro" name="bairro" class="form-control"
                                    placeholder="Informe o Bairro do cliente">
                            </div>
                            <div class="col">
                                <label for="cidade">Cidade:</label>
                                <input type="text" id="cidade" name="cidade" class="form-control"
                                    placeholder="Informe a Cidade do cliente">
                            </div>
                            <div class="col">
                                <label for="estado">Estado:</label>
                                <input type="text" id="estado" name="estado" class="form-control"
                                    placeholder="Informe o Estado do cliente">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="ativo">Status:</label>
                                <select class="form-control" name="ativo" id="ativo">
                                    <option value="1">
                                        Ativo</option>
                                    <option value="0">
                                        Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-right mt-4">
                            <x-adminlte-button type="submit" theme="success" icon="fas fa-check" label="Salvar" />
                        </div>
                    </div>
                </div>
            </form>
            </div>
            {{-- Fim do Novo Endereco --}}
            @foreach ($enderecos as $endereco)
                <div class="card">
                    <div class="card-header" id="heading{{ $endereco->id }}" 
                        style="background-color: {{ $endereco->ativo == 1 ? '#3F474E' : '#FFF' }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#collapse{{ $endereco->id }}" aria-expanded="true"
                                aria-controls="collapse{{ $endereco->id }}">
                            <div class="row">
                                <div class="col-10">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $endereco->logradouro }}, {{ $endereco->numero }} - {{ $endereco->bairro }}
                                </div>
                                <div class="col-2 text-right">
                                    <form action="/endereco/{{ $endereco->id }}" method="POST" style="display: inline"
                                        class="formExclusao">
                                        <i class="fas fa-trash text-danger" onclick="confirmaExclusao()"></i>
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </button>
                        </h2>
                    </div>
                    <form action="/endereco" method="POST" id="formEndereco">
                        @csrf
                    <div id="collapse{{ $endereco->id }}" class="collapse" aria-labelledby="heading{{ $endereco->id }}"
                        data-parent="#accordionExample">
                        <div class="card-body accordionEndereco">
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $endereco->id }}">
                                <input type="hidden" name="cliente_id" value="{{ $endereco->cliente_id }}">
                                <div class="col">
                                    <label for="cep">CEP:</label>
                                    <input type="text" id="cep" name="cep" class="form-control"
                                        placeholder="Informe o CEP do cliente" value="{{ $endereco->cep }}">
                                </div>
                                <div class="col">
                                    <label for="logradouro">Logradouro:</label>
                                    <input type="text" id="logradouro" name="logradouro" class="form-control"
                                        placeholder="Informe o Logradouro do cliente" value="{{ $endereco->logradouro }}">
                                </div>
                                <div class="col">
                                    <label for="numero">Número:</label>
                                    <input type="text" id="numero" name="numero" class="form-control"
                                        placeholder="Informe o Número do cliente" value="{{ $endereco->numero }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="complemento">Complemento:</label>
                                    <input type="text" id="complemento" name="complemento" class="form-control"
                                        placeholder="Informe o Complemento do cliente" value="{{ $endereco->complemento }}">
                                </div>
                                <div class="col">
                                    <label for="bairro">Bairro:</label>
                                    <input type="text" id="bairro" name="bairro" class="form-control"
                                        placeholder="Informe o Bairro do cliente" value="{{ $endereco->bairro }}">
                                </div>
                                <div class="col">
                                    <label for="cidade">Cidade:</label>
                                    <input type="text" id="cidade" name="cidade" class="form-control"
                                        placeholder="Informe a Cidade do cliente" value="{{ $endereco->cidade }}">
                                </div>
                                <div class="col">
                                    <label for="estado">Estado:</label>
                                    <input type="text" id="estado" name="estado" class="form-control"
                                        placeholder="Informe o Estado do cliente" value="{{ $endereco->estado }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="ativo">Status:</label>
                                    <select class="form-control" name="ativo" id="ativo">
                                        <option value="1" {{ isset($endereco) ? ($endereco->ativo == 1 ? 'selected' : '') : '' }}>
                                            Ativo</option>
                                        <option value="0" {{ isset($endereco) ? ($endereco->ativo == 0 ? 'selected' : '') : '' }}>
                                            Inativo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-right mt-4">
                                <x-adminlte-button type="button" theme="secondary" icon="fas fa-arrow-left" label="Voltar"
                                    onclick="window.location.href='{{ route('clientes.index') }}'" />
                                <x-adminlte-button type="submit" theme="success" icon="fas fa-check" label="Salvar" />
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            @endforeach
            </div>
    </div>
    </div>
@stop

@extends('components.footer')

@section('css')
    <style>
        .error {
            color: #F00;
            background-color: #FFF;
        }
    </style>
@stop

@section('js')
    @if (!empty($mensagem))
        <script>
            Swal.fire(
                'Pronto!',
                '{{ $mensagem }}',
                'success'
            );
        </script>
    @endif
    @if (!empty($error))
        <script>
            Swal.fire(
                'Ops!',
                '{{ $error }}',
                'error'
            );
        </script>
    @endif
    <script>
        $(document).ready(function() {

            $('#dadosEndereco').hide();

            $('#telefone').inputmask('(99) 99999-9999');
            $('#cpf').inputmask('999.999.999-99');

            $('#cep').inputmask('99999-999');

            $('#cep').blur(function() {
                var cep = $(this).val().replace(/\D/g, '');

                if (cep != "") {
                    var validacep = /^[0-9]{8}$/;

                    if (validacep.test(cep)) {
                        $('#logradouro').val("...");
                        $('#bairro').val("...");
                        $('#cidade').val("...");
                        $('#estado').val("...");

                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                            if (!("erro" in dados)) {
                                $('#logradouro').val(dados.logradouro);
                                $('#bairro').val(dados.bairro);
                                $('#cidade').val(dados.localidade);
                                $('#estado').val(dados.uf);
                                
                                $('#numero').focus();
                            } else {
                                Swal.fire(
                                    'Ops!',
                                    'CEP não encontrado.',
                                    'error'
                                );
                            }
                        });
                    } else {
                        Swal.fire(
                            'Ops!',
                            'Formato de CEP inválido.',
                            'error'
                        );
                    }
                }
            });


            $('#formCliente').validate({
                rules: {
                    nome: {
                        required: true,
                        minlength: 4
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    telefone: {
                        required: true
                    },
                    cpf: {
                        required: true,
                        minlength: 11
                    },
                    data_nascimento: {
                        required: true,
                    },
                    senha: {
                        required: false,
                    },

                },
                messages: {
                    nome: {
                        required: `Por Favor, preencha o nome do cliente!`,
                        minlength: 'O nome deve ter pelo menos 4 Caracteres'
                    },
                    email: {
                        required: `Por Favor, preencha o E-mail do cliente!`,
                        email: 'Por Favor, informe um E-mail válido!'
                    },
                    telefone: {
                        required: `Por Favor, preencha o Telefone do cliente!`,
                    },
                    cpf: {
                        required: `Por Favor, preencha o CPF do cliente!`,
                        minlength: 'O CPF deve ter pelo menos 11 Caracteres'
                    },
                    data_nascimento: {
                        required: `Por Favor, preencha a Data de Nascimento do cliente!`,
                    },
                    senha: {
                        required: `Por Favor, preencha a Senha do cliente!`,
                    },

                },
            });

            $('#formEndereco').validate({
                rules: {
                    cep: {
                        required: true,
                        minlength: 8
                    },
                    logradouro: {
                        required: true,
                        minlength: 4
                    },
                    numero: {
                        required: true,
                    },
                    bairro: {
                        required: true,
                        minlength: 4
                    },
                    cidade: {
                        required: true,
                        minlength: 4
                    },
                    estado: {
                        required: true,
                        minlength: 2
                    },
                },
                messages: {
                    cep: {
                        required: `Por Favor, preencha o CEP do cliente!`,
                        minlength: 'O CEP deve ter pelo menos 8 Caracteres'
                    },
                    logradouro: {
                        required: `Por Favor, preencha o Logradouro do cliente!`,
                        minlength: 'O Logradouro deve ter pelo menos 4 Caracteres'
                    },
                    numero: {
                        required: `Por Favor, preencha o Número do cliente!`,
                    },
                    bairro: {
                        required: `Por Favor, preencha o Bairro do cliente!`,
                        minlength: 'O Bairro deve ter pelo menos 4 Caracteres'
                    },
                    cidade: {
                        required: `Por Favor, preencha a Cidade do cliente!`,
                        minlength: 'A Cidade deve ter pelo menos 4 Caracteres'
                    },
                    estado: {
                        required: `Por Favor, preencha o Estado do cliente!`,
                        minlength: 'O Estado deve ter pelo menos 2 Caracteres'
                    },
                },
            });

        });
        $.validator.setDefaults({
            highlight: function(element) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            //add
            errorElement: 'span',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                if (element.parent('.form-control').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
            // end add
        });

        function confirmaExclusao() {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                showCancelButton: true,
                type: 'warning',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: 'Não, cancelar!'
            }).then((result) => {
                result.value == true ? $('.formExclusao').submit() : '';
            })
        }

        $('#btnDadosCliente').click(function() {
            $('#dadosCliente').slideDown(500);
            $('#dadosEndereco').hide();
            $('#btnDadosCliente').addClass('active');
            $('#btnDadosEndereco').removeClass('active');
        });

        $('#btnDadosEndereco').click(function() {
            $('#dadosCliente').hide();
            // Mostra o formulário de endereço com animação
            $('#dadosEndereco').slideDown(500);

        });
    </script>
@endsection
