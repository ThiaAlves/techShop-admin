@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)
@section('plugins.JqueryValidation', true)
@section('plugins.Inputmask', true)
@section('title', 'Usuários')

@section('content_header')

    <div class="row">
        <div class="col">
            <h1><i class="fa fa-users"></i> Usuários</h1>
            <p>Controle e Gerenciamento de Usuários.</p>
        </div>
        <div class="col text-right">
            <button type="button" class="btn bg-none text-end btn-lg" onclick="abreModal('', '', '', '', '', '')" 
                data-toggle="modal" data-target="#modalUsuario">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
@stop

@section('content')
    <div class="row">

<div class="col-md-4">
<x-adminlte-small-box title="{{$count_usuarios->total}}" text="Total de Usuários" icon="fas fa-users text-teal"
     theme="light"/>
</div>
    <div class="col-md-4">
    <x-adminlte-small-box title="{{$count_usuarios->ativos}}" text="Usuários Ativos" icon="fas fa-user-plus text-teal"
    theme="dark"/>
</div>
<div class="col-md-4">
    <x-adminlte-small-box title="{{$count_usuarios->inativos}}" text="Usuários Inativos" icon="fas fa-user-slash text-teal"
    theme="secondary" />
</div>
</div>

    <hr>
    {{-- Div Container --}}
    <div class="container">
        {{-- Tabela --}}
        @php
            $heads = ['ID', 'Nome', 'E-mail', 'CPF', 'Tipo', 'Foto', ['label' => 'Status', 'width' => 40], ['label' => 'Ações', 'no-export' => true, 'width' => 5]];
        @endphp

        <x-adminlte-datatable id="table" :heads="$heads" striped hoverable bordered with-buttons :config="$configDatatable" head-theme="dark">
            @foreach ($usuarios as $usuario)
                            <tr>
                                <td width="5%" class="text-center">{{ $usuario->id }}</td>
                                <td>{{ $usuario->nome }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->cpf }}</td>
                                <td>
                                    @if ($usuario->tipo == 1)
                                        Administrador
                                    @elseif ($usuario->tipo == 2)
                                        Vendedor
                                    @elseif ($usuario->tipo == 3)
                                        Analista
                                    @elseif ($usuario->tipo == 4)
                                        Estagiário
                                    @endif
                                </td>
                                <td width="5%" class="text-center">
                                    <img src="/usuarios/{{$usuario->foto}}" width="40px" 
                                    class="img-fluid img-circle elevation-3">
                                </td>

                                <td width="10%" class="text-center">
                                    @if ($usuario->status == 1)
                                        <span class="badge bg-success"><i class="fa fa-check"></i> Ativo</span>
                                    @else
                                        <span class="badge bg-danger"><i class="fa fa-times"></i> Inativo</span>
                                    @endif

                                <td width="10%" class="text-center">
                                    <button type="button"
                                        onclick="abreModal('{{ $usuario->id }}', '{{ $usuario->nome }}', '{{$usuario->email}}', '{{$usuario->cpf}}' , '{{$usuario->tipo}}', {{ $usuario->status ?? false }})"
                                        data-toggle="modal" data-target="#modalUsuario" class="btn btn-sm btn-info"><span
                                            class="fa fa-pen"></span></button>
                                    <form action="/usuario/{{ $usuario->id }}" method="POST" style="display: inline"
                                        class="formExclusao">
                                        <button type="button" class="btn btn-sm btn-danger m-1"
                                            onclick="confirmaExclusao()"><span class="fa fa-trash"></span></button>
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
        </x-adminlte-datatable>
        {{-- Tabela --}}

    </div>
    {{-- Fim Div Container --}}

    <!-- Modal -->
    <form method="post" action="{{ route('usuarios') }}" id="formUsuario">
        @csrf
        <x-adminlte-modal id="modalUsuario" title="Usuário" size="lg" theme="teal" icon="fas fa-user" v-centered>

            <div class="modal-body">
                <div class="row">
                    <div class="col" hidden>
                        <label for="id">Id:</label>
                        <input type="text" id="id" name="id" class="form-control">
                    </div>
                    <div class="col">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" class="form-control"
                            placeholder="Informe o Nome do usuário">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" class="form-control"
                            placeholder="Informe o CPF do usuário">
                    </div>
                    <div class="col">
                        <label for="tipo">Tipo:</label>
                        <select name="tipo" id="tipo" class="form-control">
                            <option value="">Selecione o Tipo</option>
                            <option value="1">Administrador</option>
                            <option value="2">Vendedor</option>
                            <option value="3">Analista</option>
                            <option value="4">Estagiário</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="email">E-mail:</label>
                        <input type="text" id="email" name="email" class="form-control"
                            placeholder="Informe o E-mail do usuário">
                    </div>
                    <div class="col">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="password" class="form-control"
                            placeholder="Informe a Senha do usuário">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="status">Status:</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>
                </div>
            </div>
            <x-slot name="footerSlot">
                <x-adminlte-button type="button" theme="secondary" icon="fas fa-times" label="Fechar"
                    data-dismiss="modal" />
                <x-adminlte-button type="submit" theme="success" icon="fas fa-check" label="Salvar" />
            </x-slot>
        </x-adminlte-modal>
    </form>
@stop

@extends('components.footer')

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
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

            $('#cpf').inputmask('999.999.999-99');


            $('#formUsuario').validate({
                rules: {
                    nome: {
                        required: true,
                        minlength: 4
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    cpf: {
                        required: true,
                        minlength: 11
                    },
                    tipo: {
                        required: true
                    },
                    senha: {
                        required: true,
                    },

                },
                messages: {
                    nome: {
                        required: `Por Favor, preencha o nome do usuário!`,
                        minlength: 'O nome deve ter pelo menos 4 Caracteres'
                    },
                    email: {
                        required: `Por Favor, preencha o E-mail do usuário!`,
                        email: 'Por Favor, informe um E-mail válido!'
                    },
                    cpf: {
                        required: `Por Favor, preencha o CPF do usuário!`,
                        minlength: 'O CPF deve ter pelo menos 11 Caracteres'
                    },
                    tipo: {
                        required: `Por Favor, selecione o Tipo do usuário!`,
                    },
                    senha: {
                        required: `Por Favor, preencha a Senha do usuário!`,
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
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: 'Não, cancelar!'
            }).then((result) => {
                result.value == true ? $('.formExclusao').submit() : '';
            })
        }
        function abreModal(id, nome, email, cpf, tipo,status) {
            status == undefined ? status = 0 : 1;
            $('#id').val(id);
            $('#nome').val(nome);
            $('#cpf').val(cpf);
            $('#tipo').val(tipo);
            $('#email').val(email);
            $('#status').val(status);
        }
    </script>
@endsection