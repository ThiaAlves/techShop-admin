@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)
@section('plugins.JqueryValidation', true)
@section('plugins.Inputmask', true)
@section('title', 'Vendas')

@section('content_header')
    <div class="row">
        <div class="col">
            <h1><i class="fa fa-tags"></i> Relatório de Vendas</h1>
            <p>Relatórios com filtros para vendas realizadas</p>
        </div>
    </div>
@stop

@section('content')
<div class="row">

    <div class="col-md-4">
    <x-adminlte-small-box title="{{$count_vendas->total}}" text="Total de Vendas" icon="fas fa-shopping-cart text-teal"
         theme="primary"/>
    </div>
        <div class="col-md-4">
        <x-adminlte-small-box title="{{$count_vendas->aguardando_pagamento}}" text="Aguardando Pagamento" icon="fa fa-clock text-teal"
        theme="dark"/>
    </div>
    <div class="col-md-4">
        <x-adminlte-small-box title="{{$count_vendas->pago}}" text="Efetivadas" icon="fas fa-check text-teal"
        theme="olive" />
    </div>
    </div>
    <x-adminlte-card title="Filtro" theme="olive" icon="fas fa-lg fa-filter" collapsible>
        <form action="{{route('relatorios.vendas')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="data_inicial">Data Inicial</label>
                        <input type="date" name="data_inicio" id="data_inicio" class="form-control" value="{{$filtro->data_inicio ?? ''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="data_final">Data Final</label>
                        <input type="date" name="data_final" id="data_final" class="form-control" value="{{$filtro->data_fim ?? ''}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Selecione um status</option>
                            <option value="A" {{!empty($filtro->status) && $filtro->status == 'A' ? 'selected' : '' }}>Aberto</option>
                            <option value="P" {{!empty($filtro->status) && $filtro->status == 'P' ? 'selected' : '' }}>Pago</option>
                            <option value="C" {{!empty($filtro->status) && $filtro->status == 'C' ? 'selected' : '' }}>Cancelado</option>
                            <option value="E" {{!empty($filtro->status) && $filtro->status == 'E' ? 'selected' : '' }}>Expirado</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cliente">Cliente</label>
                        <input type="text" name="cliente" id="cliente" class="form-control" value="{{$filtro->cliente ?? ''}}" list="clientes"
                        placeholder="Informe o Cliente">
                        <datalist id="clientes">
                            @foreach ($clientes as $cliente)
                                <option value="{{$cliente->id.' - '.$cliente->nome}}">
                            @endforeach
                        </datalist>  
                    </div>     
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
                </div>
            </div>
        </form>
    </x-adminlte-card>

    
        <hr>
        {{-- Div Container --}}
        <div class="container">
            {{-- Tabela --}}
            @php
                $heads = ['ID', 'Cliente','Valor Total', 'Data' ,['label' => 'Status', 'width' => 20], ['label' => 'Ações', 'no-export' => true, 'width' => 5]];
            @endphp
    
            <x-adminlte-datatable id="table" :heads="$heads" hoverable bordered with-buttons :config="$configDatatable" head-theme="dark" theme="light">
                @foreach ($vendas as $venda)
                                <tr>
                                    <td width="5%" class="text-center">{{ $venda->id }}</td>
                                    <td>{{$venda->cliente }}</td>
                                    <td>
                                        {{-- Mostra valor total em formato brasileiro --}}
                                        R${{ number_format($venda->valor_total, 2, ',', '.') }}
                                    </td>
                                    <td>{{ $venda->data_atualizacao
                                        ->format('d/m/Y H:i:s') }}</td>
                                    <td width="10%" class="text-center">
                                        @if ($venda->status == 'A')
                                            <span class="badge badge-warning">
                                                <i class="fa fa-clock"></i>
                                                Aguardando Pagamento</span>
                                        @elseif ($venda->status == 'P')
                                            <span class="badge badge-success">
                                                <i class="fa fa-check"></i>
                                                Pago</span>
                                        @elseif ($venda->status == 'C')
                                            <span class="badge badge-danger">
                                                <i class="fa fa-times"></i>
                                                Cancelado</span>
                                        @elseif ($venda->status == 'E')
                                            <span class="badge badge-danger">
                                                <i class="fa fa-times"></i>
                                                Expirado</span>
                                        @endif
                                    </td>
                                    <td width="10%" class="text-center">
                                        <a href="{{ route('vendas.create', $venda->id) }}" class="btn btn-sm btn-primary"  style="width: 30px; height: 30px;">
                                            <i class="fa fa-edit"></i>
                                        </a>
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
@endsection