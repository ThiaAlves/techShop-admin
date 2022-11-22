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
            <h1><i class="fa fa-tags"></i> Vendas</h1>
            <p>Informações sobre vendas realizadas</p>
        </div>
        <div class="col text-right">
            <a href="{{route('vendas.create', 'novo')}}" class="btn bg-none text-end btn-lg">
                <i class="fa fa-plus"></i>
            </a>
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
                                        {{-- R${{ number_format($venda->valor_total, 2, ',', '.') }} --}}
                                        R${{$venda->valor_total}}
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