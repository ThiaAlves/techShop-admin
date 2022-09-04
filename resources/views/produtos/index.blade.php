@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)
@section('plugins.JqueryValidation', true)
@section('title', 'Produtos')

@section('content_header')

    <div class="row">
        <div class="col">
            <h1><i class="fa fa-tags"></i> Produtos</h1>
            <p>Controle e Gerenciamento de Produtos.</p>
        </div>
        <div class="col text-right">
            <a href="{{route('produtos.create')}}" class="btn bg-none text-end btn-lg">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">

<div class="col-md-4">
<x-adminlte-small-box title="{{$count_produtos->total}}" text="Total de Produtos" icon="fas fa-boxes text-teal"
     theme="light"/>
</div>
    <div class="col-md-4">
    <x-adminlte-small-box title="{{$count_produtos->ativos}}" text="Produtos Ativos" icon="fas fa-box-open text-teal"
    theme="dark"/>
</div>
<div class="col-md-4">
    <x-adminlte-small-box title="{{$count_produtos->inativos}}" text="Produtos Inativos" icon="fas fa-box text-teal"
    theme="secondary" />
</div>
</div>

    <hr>
    {{-- Div Container --}}
    <div class="container">
        @if (!empty($mensagem))
            <div class="alert bg-success">
                {{ $mensagem }}
            </div>
        @endif

        @if(!empty($error))
        <div class="alert bg-danger" title="Erro ao tentar salvar" :dismissable="true">
            {{ $error }}
        </div>
        @endif
        {{-- Tabela --}}
        @php
            $heads = ['ID', 'Nome', ['label' => 'Imagem', 'width' => 15],['label' => 'Status', 'width' => 40], ['label' => 'Ações', 'no-export' => true, 'width' => 5]];
        @endphp

        <x-adminlte-datatable id="table" :heads="$heads" hoverable bordered with-buttons :config="$configDatatable" head-theme="dark" theme="light">
            @foreach ($produtos as $produto)
                            <tr>
                                <td width="5%" class="text-center">{{ $produto->id }}</td>
                                <td>{{ $produto->nome }}</td>
                                <td class="bg-light">
                                    <div style="display: flex; justify-content: center; align-items: center;">
                                    <img src="/produtos/{{ $produto->imagem1 }}" width="30%">
                                    <img src="/produtos/{{ $produto->imagem2 }}" width="30%">
                                    <img src="/produtos/{{ $produto->imagem3 }}" width="30%">
                                    </div>
                                </td>

                                <td width="10%" class="text-center">
                                    @if ($produto->status == 1)
                                        <span class="badge bg-success"><i class="fa fa-check"></i> Ativo</span>
                                    @else
                                        <span class="badge bg-danger"><i class="fa fa-times"></i> Inativo</span>
                                    @endif

                                <td width="10%" class="text-center">
                                    {{-- Button Vizualização --}}
                                    <a href="{{ url('produtos/' . $produto->id) }}" class="btn btn-sm btn-success" title="Visualizar">
                                        <i class="fa fa-fw fa-eye"></i>
                                    </a>
                                    {{-- Button Acessar Produto na Loja --}}
                                    <a href="{{ url('loja/produto/' . $produto->id) }}" class="btn btn-sm btn-dark" title="Acessar Produto na Loja">
                                        <i class="fa fa-fw fa-shopping-cart"></i>
                                    </a>

                                    <a href="{{ route('produtos.editar', $produto->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="/produto/{{ $produto->id }}" method="POST" style="display: inline">
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
    <form method="post" action="{{ route('categorias') }}" id="formCategoria">
        @csrf
        <x-adminlte-modal id="modalCategoria" title="Categoria" size="lg" theme="teal" icon="fas fa-tag" v-centered>

            <div class="modal-body">
                <div class="row">
                    <div class="col" hidden>
                        <label for="id">Id:</label>
                        <input type="text" id="id" name="id" class="form-control">
                    </div>
                    <div class="col">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" class="form-control"
                            placeholder="Informe o Nome da Categoria">
                    </div>
                    <div class="col">
                        <label for="icone">Icone:</label>
                        <input type="text" id="icone" name="icone" class="form-control"
                            placeholder="Informe o Icone: Ex - fa fa-user-circle">
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

@section('footer')
    <div class="text-center">
        Exemplo de Footer {{ date('Y') }}
    </div>
@stop

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
    <script>
        $(document).ready(function() {
            $('#formCategoria').validate({
                rules: {
                    nome: {
                        required: true,
                        minlength: 4
                    },
                    icone: {
                        required: true,
                    }
                },
                messages: {
                    nome: {
                        required: `Por Favor, preencha o nome da categoria!`,
                        minlength: 'O nome deve ter pelo menos 4 Caracteres'
                    },
                    icone: {
                        required: 'Por Favor, preencha o icone!',
                    }
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
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: 'Não, cancelar!'
            }).then((result) => {
                result.value == true ? $('.formPerfil').submit() : '';
            })
        }
        function abreModal(id, nome, icone, status) {
            status == undefined ? status = 0 : 1;
            $('#id').val(id);
            $('#nome').val(nome);
            $('#icone').val(icone);
            $('#status').val(status);
        }
    </script>
@endsection