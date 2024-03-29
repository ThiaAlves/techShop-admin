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
        <form method="POST" action="{{route('produtos.search')}}" id="formCategoria">
            @csrf
        <div class="row pb-4">
            <div class="col-md-12">
                <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria" class="form-control">
                    <option value="">Selecione a Categoria</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}"
                            {{!empty($request->categoria) && $request->categoria == $categoria->id ? 'selected' : ''}}>
                            {{$categoria->nome}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        </form>

        {{-- Tabela --}}
        @php
            $heads = ['ID', 'Nome', 'Estoque', ['label' => 'Imagem', 'width' => 15],['label' => 'Status', 'width' => 40], ['label' => 'Ações', 'no-export' => true, 'width' => 5]];
        @endphp

        <x-adminlte-datatable id="table" :heads="$heads" hoverable bordered with-buttons :config="$configDatatable" head-theme="dark" theme="light">
            @foreach ($produtos as $produto)
                            <tr>
                                <td width="5%" class="text-center">{{ $produto->id }}</td>
                                {{-- Mostrar nome do produto até 50 caracteres --}}
                                <td>{{ Str::limit($produto->nome, 50) }}</td>
                                <td width="10%" class="text-center">{{ $produto->estoque }}</td>
                                <td class="bg-white">
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
                                    <a href="{{ route('produtos.editar', $produto->id) }}" class="btn btn-sm btn-primary"  style="width: 30px; height: 30px;">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @if($produto->vendas > 0)
                                    <form action="/produto/{{ $produto->id }}" method="POST" style="display: inline" id="formProduto_{{ $produto->id }}">
                                        <button type="button" class="btn btn-sm {{$produto->status == 1 ? "btn-danger" : "btn-success"}}" style="width: 30px; height: 30px;"
                                            onclick="confirmaInativacao('{{ $produto->id }}')">
                                        @if ($produto->status == 1)
                                            <i class="fa fa-times"></i>
                                        @else
                                            <i class="fa fa-check"></i>
                                        @endif
                                        </button>
                                        @csrf
                                    </form>
                                    @else
                                    <form action="/produto/{{ $produto->id }}" method="POST" style="display: inline" id="formProduto_excluir_{{ $produto->id }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-danger" style="width: 30px; height: 30px;"
                                            onclick="confirmaExclusao('{{ $produto->id }}')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        @csrf
                                    </form>

                                    @endif
                                </td>
                            </tr>
                        @endforeach
        </x-adminlte-datatable>
        {{-- Tabela --}}

    </div>
    {{-- Fim Div Container --}}

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

        function confirmaInativacao(produto_id) {
            Swal.fire({
                title: 'Opa!',
                text: "Deseja alterar o status do produto?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, alterar!',
                cancelButtonText: 'Não, cancelar!'
            }).then((result) => {
                result.value == true ? $(`#formProduto_${produto_id}`).submit() : '';
            })
        }

        function confirmaExclusao(produto_id) {
            Swal.fire({
                title: 'Opa!',
                text: "Deseja excluir o produto?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Não, cancelar!'
            }).then((result) => {
                result.value == true ? $(`#formProduto_excluir_${produto_id}`).submit() : '';
            })
        }
        function abreModal(id, nome, icone, status) {
            status == undefined ? status = 0 : 1;
            $('#id').val(id);
            $('#nome').val(nome);
            $('#icone').val(icone);
            $('#status').val(status);
        }

        $('#categoria').on('change', function() {
            $('#formCategoria').submit();
        });
    </script>
@endsection