@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)
@section('plugins.JqueryValidation', true)
@section('title', 'Categorias')

@section('content_header')

    <div class="row">
        <div class="col">
            <h1><i class="fa fa-tags"></i> Categorias</h1>
            <p>Controle e Gerenciamento de Categorias.</p>
        </div>
        <div class="col text-right">
            <button type="button" class="btn bg-none text-end btn-lg" onclick="abreModal('', '', '', '', '1')"
                data-toggle="modal" data-target="#modalCategoria">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
@stop

@section('content')
    <div class="row">

<div class="col-md-4">
<x-adminlte-small-box title="{{$count_categorias->total}}" text="Total de Categorias" icon="fas fa-tags text-teal"
     theme="light"/>
</div>
    <div class="col-md-4">
    <x-adminlte-small-box title="{{$count_categorias->ativas}}" text="Categorias Ativas" icon="fas fa-tag text-teal"
    theme="dark"/>
</div>
<div class="col-md-4">
    <x-adminlte-small-box title="{{$count_categorias->inativas}}" text="Categorias Inativas" icon="fas fa-tag text-teal"
    theme="secondary" />
</div>
</div>

    <hr>
    {{-- Div Container --}}
    <div class="container">
        {{-- Tabela --}}
        @php
            $heads = ['ID', 'Nome', 'Icone',['label' => 'Status', 'width' => 40], ['label' => 'Ações', 'no-export' => true, 'width' => 5]];
        @endphp

        <x-adminlte-datatable id="table" :heads="$heads" striped hoverable bordered with-buttons :config="$configDatatable" head-theme="dark">
            @foreach ($categorias as $categoria)
                            <tr>
                                <td width="5%" class="text-center">{{ $categoria->id }}</td>
                                <td>{{ $categoria->nome }}</td>
                                <td><i class="{{ $categoria->icone }}"></i></td>

                                <td width="10%" class="text-center">
                                    @if ($categoria->status == 1)
                                        <span class="badge bg-success"><i class="fa fa-check"></i> Ativo</span>
                                    @else
                                        <span class="badge bg-danger"><i class="fa fa-times"></i> Inativo</span>
                                    @endif

                                <td width="10%" class="text-center">
                                    <button type="button"
                                        onclick="abreModal('{{ $categoria->id }}', '{{ $categoria->nome }}', '{{$categoria->icone}}', {{ $categoria->status ?? false }})"
                                        data-toggle="modal" data-target="#modalCategoria" class="btn btn-sm btn-info"><span
                                            class="fa fa-pen"></span></button>
                                    <form action="/categorias/{{ $categoria->id }}" method="POST" style="display: inline"
                                        class="formPerfil">
                                        <button type="button" class="btn btn-sm  {{$categoria->status == 1 ? "btn-danger" : "btn-success"}} m-1"
                                            onclick="confirmaExclusao()">
                                            @if ($categoria->status == 1)
                                                <span class="fa fa-times"></span>
                                            @else
                                                <span class="fa fa-check"></span>
                                            @endif
                                        </button>
                                        @csrf
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
        function confirmaExclusao() {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, alterar!',
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