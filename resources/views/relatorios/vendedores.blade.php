@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)
@section('plugins.JqueryValidation', true)
@section('plugins.Inputmask', true)
@section('title', 'Relatório de Vendedores')

@section('content_header')
    <div class="row">
        <div class="col">
            <h1><i class="fa fa-tags"></i> Relatório de Vendedores</h1>
            <p>Relatórios com filtros para vendedores</p>
        </div>
    </div>
@stop

@section('content')
<div class="row">

    <div class="col-md-4">
    <x-adminlte-small-box title="1°" text="{{$ranking->primeiro}}" icon="fas fa-trophy text-warning"
         theme="olive"/>
    </div>
        <div class="col-md-4">
        <x-adminlte-small-box title="2°" text="{{$ranking->segundo}}" icon="fa fa-trophy text-secondary"
        theme="light"/>
    </div>
    <div class="col-md-4">
        <x-adminlte-small-box title="3°" text="{{$ranking->terceiro}}" icon="fas fa-trophy text-dark"
        theme="light" />
    </div>
    </div>
    <x-adminlte-card title="Filtro" theme="olive" icon="fas fa-lg fa-filter" collapsible>
        <form action="{{route('relatorios.vendedores')}}" method="POST">
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
                        <label for="vendedor">Vendedor</label>
                        <select name="vendedor" id="vendedor" class="form-control">
                            <option value="">Selecione um vendedor</option>
                            @foreach($vendedores as $vendedor)
                                <option value="{{$vendedor->id}}" {{!empty($filtro->vendedor) && $filtro->vendedor == $vendedor->id ? 'selected' : '' }}>{{$vendedor->nome}}</option>
                            @endforeach
                        </select>
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
                $heads = ['Colocação', 'Vendedor','Valor Total', 'Total Vendas'];
            @endphp
    
            <x-adminlte-datatable id="table" :heads="$heads" hoverable bordered with-buttons :config="$configDatatable" head-theme="dark" theme="light">
                
                @foreach ($vendas as $venda)
                                <tr>
                                    <td>{{$loop->iteration}}°</td>
                                    <td>{{$venda->vendedor }}</td>
                                    <td>
                                        {{-- Mostra valor total em formato brasileiro --}}
                                        R${{ number_format($venda->valor_total, 2, ',', '.') }}
                                    </td>
                                    <td>{{ $venda->quantidade_vendas }}</td>
                                   
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