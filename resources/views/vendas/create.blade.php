@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)
@section('plugins.JqueryValidation', true)
@section('plugins.Inputmask', true)
@section('title', 'Nova Venda')

@section('content_header')

    <div class="row">
        <div class="col-10">
            <h1><i class="fa fa-tags"></i> Nova Venda</h1>
            <p>Realize uma nova venda</p>
        </div>
        <div class="col-2 text-right">
            <div class="contador">
                <h4 class="text-right" id="contador"></h4>
            </div>
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
                <div class="col">
                    <div class="form-group">
                        <label for="cliente_id">Informe o Cliente:</label>
                        <div class="input-group">
                            <input type="hidden" id="cliente_id" name="cliente_id" class="form-control" value="{{$venda->cliente_id ?? ''}}">
                        <input type="text" id="cliente_nome" name="cliente_nome" class="form-control" readonly
                            placeholder="Informe o Ciente" value="{{$venda->cliente_nome ?? ''}}">
                            <div class="input-group-append">
                                <button type="button" class="btn bg-gradient-info input-group-text"
                                 data-toggle="modal" data-target="#modalCliente"><i class="fa fa-search pr-1"></i> Buscar Cliente</button>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- Vendedor --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="vendedor_id">Vendedor:</label>
                        {{-- Select com o Vendedor logado --}}
                        <select name="usuario_id" id="vendedor_id" class="form-control">
                            <option value="{{ auth()->user()->id }}">{{ auth()->user()->nome }}</option>
                        </select>
                    </div>
                </div>
                {{-- Status --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Selecione um status</option>
                            <option value="A" {{!empty($venda->status) && $venda->status == 'A' ? 'selected' : '' }}>Aberto</option>
                            <option value="P" {{!empty($venda->status) && $venda->status == 'P' ? 'selected' : '' }}>Pago</option>
                            <option value="C" {{!empty($venda->status) && $venda->status == 'C' ? 'selected' : '' }}>Cancelado</option>
                            <option value="E" {{!empty($venda->status) && $venda->status == 'E' ? 'selected' : '' }}>Expirado</option>
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
            <input type="hidden" id="id_venda" value="{{ $venda->id ?? '' }}">
            <div class="row pt-5">
                {{-- Produtos, Quantidade --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="produto_id">Informe o Produto:</label>
                        {{-- Select com os Produtos --}}

                        <div class="input-group">
                            <input type="hidden" id="produto_id" name="produto_id" class="form-control">
                        <input type="text" id="produto_nome" name="produto_nome" class="form-control" readonly
                            placeholder="Selecione o Produtos">
                            <div class="input-group-append">
                                <button type="button" class="btn bg-gradient-info input-group-text"
                                 data-toggle="modal" data-target="#modalProduto"><i class="fa fa-search pr-1"></i> Buscar Produto</button>
                            </div>
                        </div>
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
                            
                            @if (!empty($carrinho))
                                @foreach ($carrinho as $produto)
                                <tr>
                                    <td>{{ $produto->nome }}</td>
                                    <td>{{ $produto->quantidade }}</td>
                                    <td>{{ $produto->valor }}</td>
                                    <td>{{ $produto->valor * $produto->quantidade }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm btn-remove" data-id="{{ $produto->id }}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
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
                <div class="col-md-12">
                    <button type="button" class="btn btn-success btn-block" onclick="finalizarVenda()">Finalizar Venda</button>
                </div>
            </div>
        </div>
    </div>

    <x-adminlte-modal id="modalCliente" title="Clientes" size="xl" theme="olive" icon="fas fa-user" v-centered>

        <div class="modal-body">
                   {{-- Tabela --}}
        @php
            $heads = ['Nome', 'CPF', 'Email', 'Status'];
        @endphp

    <x-adminlte-datatable id="tabelaCliente" :heads="$heads" striped hoverable bordered :config="$configDatatable"
        head-theme="dark">
        @foreach ($clientes as $cliente)
            <tr style="cursor: pointer" onclick="selecionaCliente('{{$cliente->id}}', '{{$cliente->nome}}')">
                <td>{{ $cliente->nome }}</td>
                <td width="20%" class="text-center">{{ $cliente->cpf}}</td>
                <td width="20%" class="text-center">{{ $cliente->email}}</td>
                <td width="10%" class="text-center">
                    @if ($cliente->status == 0)
                    <h3 class='bg-gradient-danger badge'><i class='fa fa-times'></i> Inativo </h3>
                @elseif($cliente->status == 1)
                    <h3 class='bg-gradient-success badge'><i class='fa fa-check'></i> Ativo </h3>
                @endif
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button type="button" theme="secondary" icon="fas fa-times" label="Fechar"
                data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>

    <x-adminlte-modal id="modalProduto" title="Produtos" size="xl" theme="olive" icon="fas fa-user" v-centered>

        <div class="modal-body">
                   {{-- Tabela --}}
        @php
            $heads = ['Nome', 'Preço', 'Estoque', 'Imagem'];
        @endphp

    <x-adminlte-datatable id="tabelaProduto" :heads="$heads" striped hoverable bordered with-buttons :config="$configDatatable"
        head-theme="dark">
        @foreach ($produtos as $produto)
            <tr style="cursor: pointer" onclick="selecionaProduto('{{$produto->id}}', '{{$produto->nome}}')">
                <td>{{ $produto->nome }}</td>
                <td width="10%" class="text-center">
                    {{ number_format($produto->preco_promocional ?? $produto->preco, 2, ',', '.') }}
                </td> 
                <td width="5%" class="text-center">{{ $produto->estoque}}</td>
                <td width="20%" class="bg-white">
                    <div style="display: flex; justify-content: center; align-items: center;">
                    <img src="/produtos/{{ $produto->imagem1 }}" width="30%">
                    <img src="/produtos/{{ $produto->imagem2 }}" width="30%">
                    <img src="/produtos/{{ $produto->imagem3 }}" width="30%">
                    </div>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button type="button" theme="secondary" icon="fas fa-times" label="Fechar"
                data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>
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
            if ($('#id_venda').val() == '') {
                $('#div-produtos').hide();
                //Adiciona contador de 6 horas para a venda expirar
                var data = new Date();
                data.setHours(data.getHours() + 6);
                //Contador de 6 horas
                var countDownDate = data.getTime();
                // Atualiza o contador a cada 1 segundo
                var x = setInterval(function() {
                    // Pega a data e hora atual
                    var now = new Date().getTime();
                    // Encontra a distância entre agora e a data do contador
                    var distance = countDownDate - now;
                    // Calcula os dias, horas, minutos e segundos
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    // Exibe o resultado no elemento com id="demo"
                    document.getElementById("contador").innerHTML = hours + "h "
                    + minutes + "m " + seconds + "s ";
                    // Se o contador chegar a zero, escreve algumas palavras
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("contador").innerHTML = "EXPIROU";
                        //Seta status como E para expirado
                        $('#status').val('E');
                        finalizarVenda();
                    }
                }, 1000);


            }



            var valor_total = '{{ $valor_total ?? 0 }}';
            //Remove 00 do final do valor
            valor_total = valor_total.replace(/(\d)(\d{2})$/, "$1");
            //Converte para valor brasileiro
            valor_total = valor_total.toLocaleString('pt-br', {minimumFractionDigits: 2});
            $('#total').val(parseInt(valor_total));

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
            var produto_nome = $('#produto_nome').val();
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
                $.get('/api/produtos/' + produto_id, function(produto) {
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
            $('#salvar').prop('disabled', true);
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

        function finalizarVenda() {
            var venda_id = $('#id_venda').val();
            var status = $('#status').val();
            $.ajax({
                url: '/api/venda/finalizar',
                type: 'POST',
                data: {
                    venda_id,
                    status
                },
                success: function(data) {
                    //Mostra mensagem e quando clicar em ok redireciona para a listagem de vendas
                    Swal.fire(
                        'Sucesso!',
                        'Venda finalizada com sucesso!',
                        'success'
                    ).then((result) => {
                        if (result.value == true) {
                            window.location.href = '/vendas';
                        }
                    });
                },
                error: function(data) {
                    Swal.fire(
                        'Ops!',
                        data.responseJSON.error,
                        'error'
                    );
                }
            })
        }

        function selecionaCliente(id, nome){
            $('#modalCliente').modal('hide');
            $('#cliente_id').val(id);
            $('#cliente_nome').val(nome);
        }

        function selecionaProduto(id, nome){
            $('#modalProduto').modal('hide');
            $('#produto_id').val(id);
            $('#produto_nome').val(nome);

            $.get('/api/produtos/' + id, function(produto) {
                    $('#valor').val(produto.valor);
            });
        }


    </script>
@endsection