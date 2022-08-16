@extends('layouts.user_type.auth')
@extends('imports')
@section('content')
    {{-- Se contém mensagem --}}
    @if (!empty($mensagem))
        <script>
            Swal.fire({
                title: 'Sucesso!',
                text: `{{ $mensagem }}`,
                type: 'success',
                icon: 'success',
                confirmButtonText: 'OK'
            })
        </script>
    @endif


    <div>
        <div class="row text-center m-4" role="alert">
            <div class="col bg-info rounded text-light m-1">
                <strong>Categorias Cadastradas</strong>
                <h4> {{ $categorias->count() }}</h4>
            </div>
            <div class="col bg-info rounded text-light m-1">
                <strong>Categorias Ativas</strong>
                <h4> {{ $categorias->where('status', 1)->count() }}</h4>
            </div>
            <div class="col bg-info rounded text-light m-1">
                <strong>Categorias Inativas</strong>
                <h4> {{ $categorias->where('status', 0)->count() }}</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0"><i class="fa fa-tag"></i> Todas as Categorias</h5>
                            </div>
                            <button onclick="cadastrar()" class="btn bg-gradient-info btn-sm mb-0" type="button"><i
                                    class="fa fa-plus"></i> Nova Categoria</button>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nome
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Ícone
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Criado em
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Ativo
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $categoria)
                                        <tr class="">
                                            <th scope="row">{{ $categoria->id }}</th>
                                            <td>{{ $categoria->nome }}</td>
                                            <td class="text-center"><i class="{{ $categoria->icone }}"></i></td>
                                            <td>{{ date('d/m/Y H:i', strtotime($categoria->created_at)) }}</td>
                                            <td class="text-center">
                                                @if ($categoria->status == 1)
                                                    <i class="fa fa-check text-success"></i>
                                                @else
                                                    <i class="fa fa-times text-danger"></i>
                                                @endif
                                            <td>
                                                <button
                                                    onclick="editar('{{ $categoria->id }}', '{{ $categoria->nome }}', '{{ $categoria->icone }}', '{{ $categoria->status }}')"
                                                    class="btn rounded bg-gradient-info" id="editar"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Editar categoria">
                                                    <i class="fa fa-pencil text-white"></i>
                                                </button>
                                                <form action="categorias/{{ $categoria->id }}" method="POST"
                                                    id="form-{{ $categoria->id }}" style="display: inline">
                                                    <button type="button" class="btn rounded bg-gradient-danger"
                                                        class="mx-3" onclick="excluir('{{ $categoria->id }}')"
                                                        data-bs-toggle="tooltip" data-bs-original-title="Remover categoria">
                                                        <i class="fa fa-trash text-white"></i>
                                                    </button>
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="modal-categoria">
        <div class="modal-dialog">
            <form action="{{ route('categorias.store') }}" method="POST" id="form-categoria">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitulo"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12" hidden>
                                <div class="form-group">
                                    <label for="id" class="form-control-label">ID:</label>
                                    <input type="text" class="form-control" id="id" name="id"
                                        placeholder="ID da categoria">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nome">Nome:</label>
                                    <input type="text" class="form-control" id="nome" name="nome"
                                        placeholder="Nome da categoria, exemplo: Eletrônicos">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="icone">Ícone: <small class="form-text text-muted">
                                            <a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">
                                                <i class="fa fa-info-circle"></i>
                                            </a>
                                        </small></label>
                                    <input type="text" class="form-control" id="icone" name="icone"
                                        placeholder="Ícone da categoria, exemplo: fa fa-tag">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i
                                class="fa fa-times"></i> Fechar</button>
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function cadastrar() {
            $('#modalTitulo').html('Cadastrar categoria');
            $('#id').val('');
            $('#nome').val('');
            $('#icone').val('');
            $('#status').val('');
            $('#modal-categoria').modal('show');
        }

        function editar(id, nome, icone, status) {
            $('#modalTitulo').html('Editar Categoria');
            $('#id').val(id);
            $('#nome').val(nome);
            $('#icone').val(icone);
            $('#status').val(status);
            $('#modal-categoria').modal('show');
        }

        function excluir($id) {
            event.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Não, cancelar!'
            }).then((result) => {
                if (result.value) {
                    $('#form-' + $id).submit();
                } else {
                    Swal.fire(
                        'Cancelado!',
                        'A categoria não foi excluída.',
                        'error'
                    )
                }
            })
        }
    </script>
@endsection
