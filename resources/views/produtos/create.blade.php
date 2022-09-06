@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)
@section('plugins.JqueryValidation', true)
@section('plugins.Inputmask', true)
@section('plugins.Summernote', true)
@section('title', 'Produtos')

@section('content_header')

    <div class="row">
        <div class="col">
            <h1><i class="fa fa-box"></i> Produtos</h1>
            <p>Criação de Novos Produtos.</p>
        </div>
        <div class="col text-right">
            <a href="{{ route('produtos.index') }}" class="btn bg-none text-end btn-lg">
                <i class="fa fa-list"></i>
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row container pb-5">
        <div class="col-md-12">
            <div class="card card-olive card-outline">
                <div class="card-body">
                    <form action="{{ route('produtos') }}" method="POST" enctype="multipart/form-data" id="formProduto">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="hidden" name="id" id="id" class="form-control" value="{{$produto->id ?? null}}">
                                    <label for="nome">Nome do Produto: </label>
                                    <input type="text" name="nome" id="nome" class="form-control"
                                        placeholder="Informe o nome do produto" value="{{ $produto->nome ?? null }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="categoria">Categoria</label>
                                    <select name="id_categoria" id="categoria" class="form-control">
                                        <option value="">Selecione uma Categoria</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{$produto->categoria_id == $categoria->id ? "selected" : null}}>{{ $categoria->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="imagem">Imagem</label>
                                    <input id="imagem" name="imagem[]" type="file" class="file" multiple
                                        data-show-upload="false" data-show-caption="true"
                                        data-msg-placeholder="Selecionado {files} para salvar...">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descricao">Descrição</label>
                                    <textarea name="descricao" id="descricao" class="form-control" rows="5"
                                        placeholder="Informe a descrição do produto">{{ $produto->descricao ?? null }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="preco">Preço</label>
                                    <input type="text" name="preco" id="preco" class="form-control"
                                        placeholder="Preço do Produto" value="{{$produto->preco ?? null}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="preco_promocional">Preço Promocional</label>
                                    <input type="text" name="preco_promocional" id="preco_promocional"
                                        class="form-control" placeholder="Preço Promocional do Produto"
                                        value="{{ $produto->preco_promocional ?? null }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estoque">Estoque</label>
                                    <input type="text" name="estoque" id="estoque" class="form-control"
                                        placeholder="Estoque do Produto" value="{{ old('estoque') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Selecione um Status</option>
                                        <option value="1" {{$produto->status == 1 ? "selected" : null}}>Ativo</option>
                                        <option value="0" {{$produto->status == 0 ? "selected" : null}}>Inativo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-md-12 text-right">
                                <a href="{{ route('produtos.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('components.footer')



@section('js')
    <script>
  const summernote = {
            height: 300,
            lang: 'pt-BR',
            placeholder: 'Informe a descrição do produto',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'help']],
            ],
        }
        const inputmask = {
            alias: 'currency',
            prefix: 'R$ ',
            digits: 2,
            digitsOptional: false,
            clearMaskOnLostFocus: false,
            autoUnmask: true,
            removeMaskOnSubmit: true,
        };

    var imagens = [];
    imagens = [@if(!empty($produto->imagem1))  "{{asset('produtos/'.$produto->imagem1)}}", @endif 
                @if(!empty($produto->imagem2))  "{{asset('produtos/'.$produto->imagem2)}}", @endif
                @if(!empty($produto->imagem3))  "{{asset('produtos/'.$produto->imagem3)}}", @endif
                @if(!empty($produto->imagem4))  "{{asset('produtos/'.$produto->imagem4)}}", @endif
                @if(!empty($produto->imagem5))  "{{asset('produtos/'.$produto->imagem5)}}", @endif
            ];


        const fileinput = {
            'initialPreview': imagens,
            'initialPreviewAsData': true,
            'initialPreviewConfig': [
                {caption: "imagem1.jpg", downloadUrl: imagens[0], size: 930321, width: "20px", key: '{{$produto->imagem1}}', url: "{{ route('produtos.imagem', [$produto->id, 'imagem1']) }}"},
                {caption: "imagem2.jpg", downloadUrl: imagens[1], size: 1218822, width: "120px", key: '{{$produto->imagem2}}', url: "{{ route('produtos.imagem', [$produto->id, 'imagem2']) }}"},
                {caption: "imagem3.jpg", downloadUrl: imagens[2], size: 1218822, width: "120px", key: '{{$produto->imagem3}}', url: "{{ route('produtos.imagem', [$produto->id, 'imagem3']) }}"},
                {caption: "imagem4.jpg", downloadUrl: imagens[3], size: 1218822, width: "120px", key: '{{$produto->imagem4}}', url: "{{ route('produtos.imagem', [$produto->id, 'imagem4']) }}"},
                {caption: "imagem5.jpg", downloadUrl: imagens[4], size: 1218822, width: "120px", key: '{{$produto->imagem5}}', url: "{{ route('produtos.imagem', [$produto->id, 'imagem5']) }}"},
            ],
            'deleteExtraData': {
                '_token': "{{ csrf_token() }}",
                '_method': "DELETE",
            },
            'previewFileType': 'any',
            'language': 'pt-BR',
            'theme': 'fa5',
            'maxFileCount': 5,
            'allowedFileExtensions': ['jpg', 'png', 'gif', 'jpeg', 'webp'],
            'removeFromPreviewOnError': true,
            'selectOnClose': true,
        };     
        
        $("#imagem").fileinput(fileinput);

        $('#imagem').on('fileselect', function(event, numFiles, label) {
    console.log("fileselect");
});

        $(document).ready(function() {

            $('#descricao').summernote(summernote);
            $('#preco').inputmask(inputmask);
            $('#preco_promocional').inputmask(inputmask);
            
            $('#formProduto').validate({
                rules: {
                    nome: {
                        required: true,
                        minlength: 3,
                        maxlength: 100,
                    },
                    categoria: {
                        required: true,
                    },
                    descricao: {
                        required: true,
                        minlength: 10,
                        maxlength: 1000,
                    },
                    preco: {
                        required: true,
                    },
                    estoque: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                },
                messages: {
                    nome: {
                        required: 'Informe o nome do produto',
                        minlength: 'O nome do produto deve ter no mínimo 3 caracteres',
                        maxlength: 'O nome do produto deve ter no máximo 100 caracteres',
                    },
                    categoria: {
                        required: 'Informe a categoria do produto',
                    },
                    descricao: {
                        required: 'Informe a descrição do produto',
                        minlength: 'A descrição do produto deve ter no mínimo 10 caracteres',
                        maxlength: 'A descrição do produto deve ter no máximo 1000 caracteres',
                    },
                    preco: {
                        required: 'Informe o preço do produto',
                    },
                    estoque: {
                        required: 'Informe o estoque do produto',
                    },
                    status: {
                        required: 'Informe o status do produto',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
