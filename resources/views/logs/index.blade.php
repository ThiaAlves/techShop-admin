@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)
@section('plugins.JqueryValidation', true)
@section('plugins.Inputmask', true)
@section('title', 'Logs')

@section('css')
    <style>
        .boxHover:hover{ 
            cursor: pointer;
            transition: 0.4s;
            filter: brightness(0.8);
        }
    </style>
@endsection

@section('content_header')
    <div class="row">
        <div class="col">
            <h1><i class="fa fa-file"></i> Logs do Sistema</h1>
            <p>Vizualização de Registros do sistema.</p>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <x-adminlte-info-box class="boxHover" title="Total de Registros" text="{{ $count_registros->total ?? 0}}"
                icon="fas fa-file text-olive" theme="dark" onclick="buscaRegistrosEvento('')" />
        </div>
        <div class="col-md-3">
            <x-adminlte-info-box class="boxHover" title="Criação" text="{{ $count_registros->create ?? 0}}"
                icon="fa fa-plus text-light" theme="success" onclick="buscaRegistrosEvento('create')" />
        </div>
        <div class="col-md-3">
            <x-adminlte-info-box class="boxHover" title="Alteração" text="{{ $count_registros->update ?? 0}}"
                icon="fa fa-bolt  text-olive" theme="warning" onclick="buscaRegistrosEvento('update')" />
        </div>
        <div class="col-md-3">
            <x-adminlte-info-box class="boxHover" title="Exclusão" text="{{ $count_registros->destroy ?? 0}}"
                icon="fas fa-times text-olive" theme="danger" onclick="buscaRegistrosEvento('destroy')" />
        </div>
    </div>

    <hr>
    {{-- Div Container --}}
    <div class="pl-4 pr-4">
            <div class="row pt-3">
                <div class="col-3">
                    <button type="button" class="btn form-control {{!empty($filtros->model) && $filtros->model == 'Categoria' ? 'bg-gradient-success' : 'bg-gradient-info' }}" onclick="buscaRegistrosModel('Categoria')">
                        <i class="fa fa-tags"></i> Categoria
                    </button>
                </div>
                <div class="col-3">
                    <button type="button" class="btn form-control {{!empty($filtros->model) && $filtros->model == 'Cliente' ? 'bg-gradient-success' : 'bg-gradient-info' }}" onclick="buscaRegistrosModel('Cliente')">
                        <i class="fa fa-users"></i> Cliente
                    </button>
                </div>
                <div class="col-3">
                    <button type="button" class="btn form-control {{!empty($filtros->model) && $filtros->model == 'Produto' ? 'bg-gradient-success' : 'bg-gradient-info' }}" onclick="buscaRegistrosModel('Produto')">
                        <i class="fa fa-box"></i> Produto
                    </button>
                </div>
                <div class="col-3">
                    <button type="button" class="btn form-control {{!empty($filtros->model) && $filtros->model == 'Usuario' ? 'bg-gradient-success' : 'bg-gradient-info' }}" onclick="buscaRegistrosModel('Usuario')">
                        <i class="fa fa-user"></i> Usuario
                    </button>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-3">
                    <button type="button" class="btn form-control {{!empty($filtros->model) && $filtros->model == 'Venda' ? 'bg-gradient-success' : 'bg-gradient-info' }}" onclick="buscaRegistrosModel('Venda')">
                        <i class="fa fa-money-bill"></i> Venda
                    </button>
                </div>
            </div>
    </div>

    <div class="pt-3 text-center">
        <h5>{{count($logs)}} Registros Encontrados!</h5>
    </div>

    <div class="p-4">
        <div class="accordion" id="accordionExample">
            @foreach ($logs as $log)
                <div class="card">
                    <div class="card-header p-1" id="{{ $log->id }}">
                        <h2 class="mb-0">
                            <button class="btn  btn-block text-left" type="button"
                                data-toggle="collapse" data-target="#collapse{{ $log->id }}"
                                aria-expanded="true" aria-controls="collapse{{ $log->id }}">
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-12">
                                                @php
                                                    echo Str::limit($log->description, '50');
                                                @endphp
                                            </div>
                                            <div class="col">
                                                <span class="badge bg-gradient-dark">
                                                    <i class="fa fa-user"></i>
                                                    {{ $log->usuario_nome != null ? $log->usuario_nome : 'Não Identificado' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5 text-right">
                                        <div class="row">
                                            <div class="col-12">
                                                {{ $log->created_at->format('d/m/Y H:i:s') }}
                                            </div>
                                            <div class="col-12">
                                                <span class="badge bg-gradient-info">
                                                    {{ $log->event }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                            </button>
                        </h2>
                    </div>

                    <div id="collapse{{ $log->id }}" class="collapse"
                        aria-labelledby="{{ $log->id }}" data-parent="#accordionExample">
                        <div class="card-body">
                            @php
                                $properties = json_decode($log->properties);

                                    foreach ($properties as $key => $value) {
                                        $valor = $properties->$key ?? null;
                                        echo $key ." = ".$valor ."<br>";
                                    }
                                
                            @endphp
                    </div>
                </div>
        </div>
        @endforeach
    </div>
    </div>


{{-- Form Model --}}
<form action="{{route('logs.index')}}" method="POST" id="form_model" hidden>
    @csrf
    <input type="hidden" name="model_name" id="model_name"> 
</form>

{{-- Form Event --}}
<form action="{{route('logs.index')}}" method="POST" id="form_event" hidden>
    @csrf
    <input type="hidden" name="event" id="event"> 
</form>


@stop

@extends('components.footer')

@section('js')
    <script>
        function buscaRegistrosModel(model){
            $('#model_name').val(model);
            $('#form_model').submit();
        }

        function buscaRegistrosEvento(evento){
            $('#event').val(evento);
            $('#form_event').submit();
        }
    </script>
@endsection