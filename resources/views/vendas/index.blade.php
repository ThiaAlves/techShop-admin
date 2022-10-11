@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)
@section('plugins.JqueryValidation', true)
@section('plugins.Inputmask', true)
@section('title', 'Nova Venda')

@section('content_header')

    <div class="row">
        <div class="col">
            <h1><i class="fa fa-tags"></i> Nova Venda</h1>
            <p>Realize uma nova venda</p>
        </div>
    </div>
@stop

@section('content')
    <hr>
    {{-- Div Container --}}
    <div class="container">
        {{-- Formulário com Cliente, Vendedor, Produto e Status --}}
        <form action="{{ route('vendas.store') }}" method="POST" id="form-venda">
            @csrf
            <div class="row">
                {{-- Cliente --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cliente_id">Informe o Cliente:</label>
                        {{-- Select com os Clientes --}}
                        <select name="cliente_id" id="cliente_id" class="form-control">
                            <option value="">Selecione um Cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                {{-- Vendedor --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="vendedor_id">Vendedor:</label>
                        {{-- Select com o Vendedor logado --}}
                        <select name="usuario_id" id="vendedor_id" class="form-control">
                            <option value="{{ auth()->user()->id }}">{{ auth()->user()->nome }}</option>
                        </select>
                    </div>
                </div>
                {{-- Status --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Selecione um status</option>
                            <option value="Aguardando Pagamento">Aguardando Pagamento</option>
                            <option value="Pago">Pago</option>
                            <option value="Cancelado">Cancelado</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success btn-block" id="salvar">Iniciar Venda</button>
                </div>
            </div>
        </form>
        <div id="div-produtos">
            <input type="hidden" id="id_venda">
            <div class="row pt-5">
                {{-- Produtos, Quantidade --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="produto_id">Informe o Produto:</label>
                        {{-- Select com os Produtos --}}
                        <select name="produto_id" id="produto_id" class="form-control">
                            <option value="">Selecione um Produto</option>
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="quantidade">Quantidade:</label>
                        <input type="number" name="quantidade" id="quantidade" class="form-control" min="1" value="1" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="valor">Valor:</label>
                        <input type="text" name="valor" id="valor" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="add-produto">Adicionar Produto</label>
                        <button type="button" class="btn btn-success btn-block" id="add-produto"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered" id="tabela-produtos">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Preço</th>
                                <th>Subtotal</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input type="text" name="total" id="total" class="form-control" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@extends('components.footer')

@section('css')

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
            $('#div-produtos').hide();

            //InpuMask para o campo Valor
            $(['#valor', '#total']).inputmask('decimal', {
                radixPoint: ",",
                groupSeparator: ".",
                digits: 2,
                autoGroup: true,
                clearOnSubmit: true,
                prefix: 'R$ ', //Space after $, this will not truncate the first character.
                rightAlign: false,
            });

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

        $('#add-produto').click(function() {
            var produto_id = $('#produto_id').val();
            var produto_nome = $('#produto_id option:selected').text();
            var quantidade = $('#quantidade').val();
            var valor = $('#valor').val();
            //Removendo o R$ e o espaço
            valor = valor.replace('R$ ', '');
            //Substituindo a vírgula por ponto
            valor = valor.replace(',', '.');
            var total = $('#total').val();

            if (produto_id == '' || quantidade == '' || valor == '') {
                Swal.fire(
                    'Ops!',
                    'Preencha todos os campos!',
                    'error'
                );
            } else {
                salvarProduto(produto_id, quantidade, valor);
                var subtotal = quantidade * valor;
                var linha = '<tr>';
                linha += '<td><input type="hidden" name="produto_id[]" value="' + produto_id + '">' + produto_nome + '</td>';
                linha += '<td><input type="hidden" name="quantidade[]" value="' + quantidade + '">' + quantidade + '</td>';
                linha += '<td><input type="hidden" name="valor[]" value="' + valor + '">' + valor + '</td>';
                linha += '<td>' + subtotal + '</td>';
                linha += '<td><button type="button" class="btn btn-danger btn-sm btn-remove"><i class="fa fa-trash"></i></button></td>';
                linha += '</tr>';

                $('#tabela-produtos tbody').append(linha);

                if (total == '') {
                    total = 0;
                }

                total = parseFloat(total) + parseFloat(subtotal);
                $('#total').val(total);

                $('#produto_id').val('');
                $('#quantidade').val('1');
                $('#valor').val('');
            }

        });

        $(document).on('click', '.btn-remove', function() {
            //Confirmação
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
            }).then((result) => {
                if (result.value == true) {
                    var linha = $(this).parent().parent();
                    var subtotal = linha.find('td:eq(3)').text();
                    var total = $('#total').val();
                    total = parseFloat(total) - parseFloat(subtotal);
                    $('#total').val(total);
                    linha.remove();
                    removerProduto(linha.find('input[name="produto_id[]"]').val());
                }
            });
        });

        //Quando um produto id for selecionado enviar uma requisição ajax para buscar o valor do produto
        $('#produto_id').change(function() {
            var produto_id = $(this).val();
            if (produto_id != '') {
                $.get('api/produtos/' + produto_id, function(produto) {
                    $('#valor').val(produto.valor);
                });
            }
        });

        //Quando Quantidade for alterada pra cima ou pra baixo, atualizar o valor do subtotal
        $('#quantidade').change(function() {
            var quantidade = $(this).val();
            var valor = $('#valor').val();
            //Remover o R$ e o . do valor
            valor = valor.replace('R$ ', '');
            var subtotal = quantidade * valor;
            $('#subtotal').val(subtotal);
        });

        //Quando clicar em salvar, verificar se foi informado o cliente e status
        $('#salvar').click(function() {
            var cliente_id = $('#cliente_id').val();
            var status = $('#status').val();
            if (cliente_id == '' || status == '') {
                Swal.fire(
                    'Ops!',
                    'Preencha todos os campos!',
                    'error'
                );
            } else {
                //Envia post com parametros para o controller
                //Formata serializeArray para JSON
                var dados = $('#form-venda').serializeArray();
                $.ajax({
                    url: '/api/nova_venda',
                    type: 'POST',
                    data: dados,
                    success: function(data) {
                        console.log(data);
                        $('#tabela-produtos tbody').empty();
                        $('#total').val('');

                        $('#id_venda').val(data.id);
                        $('#div-produtos').show();
                    },
                })
            }
        });

        function salvarProduto(produto_id, quantidade, valor) {
            var venda_id = $('#id_venda').val();

            if(venda_id == ''){
                Swal.fire(
                    'Ops!',
                    'Preencha todos os campos!',
                    'error'
                );
            }
            $.ajax({
                url: '/api/venda/novo_produto',
                type: 'POST',
                data: {
                    venda_id: venda_id,
                    produto_id: produto_id,
                    quantidade: quantidade,
                    valor: valor
                },
                success: function(data) {
                    console.log(data);
                    Swal.fire(
                        'Sucesso!',
                        'Produto adicionado com sucesso!',
                        'success'
                    );
                },
            })
        }

        function removerProduto(produto_id) {
            var venda_id = $('#id_venda').val();
            $.ajax({
                url: '/api/venda/remover_produto',
                type: 'POST',
                data: {
                    venda_id: venda_id,
                    produto_id: produto_id
                },
                success: function(data) {
                    Swal.fire(
                        'Sucesso!',
                        'Produto removido com sucesso!',
                        'success'
                    );
                },
            })
        }


    </script>
@endsection