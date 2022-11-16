@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)
@section('plugins.JqueryValidation', true)
@section('plugins.Inputmask', true)
@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col">
                    <x-adminlte-info-box title="Clientes Cadastrados" text="{{$dashboard->total_clientes}}" icon="fas fa-lg fa-users text-light" theme="gradient-info"/>
                </div>
                <div class="col">
                    <x-adminlte-info-box title="Produto Mais Vendido" text="{{
                        Str::limit($dashboard->mais_vendido, 13)
                        }}" icon="fas fa-lg fa-box-open text-light" theme="gradient-info"/>
                </div>
                <div class="col">
                    <x-adminlte-info-box title="Vendas no Mês" text="{{$dashboard->vendas_mes}}" icon="fas fa-lg fa-calendar text-light" theme="gradient-info"/>
                </div>
                <div class="col">
                    <x-adminlte-info-box title="Ganhos no Mês" text="{{$dashboard->renda_mes}}" icon="fas fa-lg fa-money-bill text-light" theme="gradient-success"/>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <x-adminlte-card title="Vendas Por Dia" theme="info" icon="fas fa-lg fa-chart-line">
                        <iframe src="http://187.87.223.235:3000/d-solo/a3-oG6vVk/dashboard-techshop?from=1665966335792&to=1668561935792&orgId=1&theme=light&panelId=2" width="100%" height="400" frameborder="0"></iframe>
                    </x-adminlte-card>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    {{-- Tabela --}}
    @php
        $heads = ['Código', 'Cliente', 'Horário' ,'Status', ['label' => 'Ações', 'no-export' => true, 'width' => 5]];
    @endphp

    <x-adminlte-datatable id="table" :heads="$heads" hoverable bordered with-buttons :config="$configDatatable" head-theme="dark" theme="light">
        @foreach ($ultimas_vendas as $venda)
                        <tr>
                            <td width="5%" class="text-center">{{ $venda->id }}</td>
                            {{-- Mostrar nome do produto até 50 caracteres --}}
                            <td>{{ $venda->nome }}</td>
                            <td  width="20%" class="text-center">{{  date('d/m/Y H:i:s', strtotime($venda->created_at)) }}</td> 

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
@endsection

@extends('components.footer')

@section('css')
@stop

@section('js')
@stop
