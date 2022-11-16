@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)
@section('plugins.JqueryValidation', true)
@section('title', 'Meu Perfil')

@section('content_header')

    <div class="row"></div>
@stop
@section('content')
    <form method="post" action="{{ route('perfil.store') }}" id="formPerfil">
        <x-adminlte-profile-widget name="{{ Auth::user()->nome }}" desc="{{ Auth::user()->perfil }}" theme="olive"
            layout-type="classic" img="{{Auth::user()->adminlte_image()}}">

            @csrf
            <x-adminlte-input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}"
                label-class="text-dark" />

            <x-adminlte-input fgroup-class="col-md-6" name="nome" id="nome" label="Nome:" 
                value="{{ Auth::user()->nome }}" placeholder="Informe o nome de usuário" label-class="text-dark">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-dark"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input fgroup-class="col-md-6" name="email" id="email" label="Email:" 
                value="{{ Auth::user()->email }}" placeholder="Email do usuário" label-class="text-dark">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-envelope text-dark"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input fgroup-class="col-md-12" name="oldPassword" id="oldPassword" label="Senha Atual:" placeholder="Informe sua senha atual" required
            label-class="text-dark" type="password" autocomplete="off">
            <x-slot name="appendSlot">
                <span class="input-group-text"><i class="fa fa-eye" id="verOldSenha" ></i></span>
            </x-slot>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-lock text-dark"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input fgroup-class="col-md-6" name="password" id="password" label="Nova Senha:" placeholder="Informe sua nova senha"
            onkeyup="validarSenhaForca()"
            label-class="text-dark" type="password" autocomplete="off">
            <x-slot name="appendSlot">
                <span class="input-group-text"><i class="fa fa-eye" id="verSenha" ></i></span>
            </x-slot>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-lock text-dark"></i>
                    </div>
                </x-slot>
                <x-slot name="bottomSlot">
                    <div class="" id="erroSenhaForca"></div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input fgroup-class="col-md-6" id="confirmPassword" name="password_confirmation" label="Confirmação de Senha:"
            placeholder="Confirme sua nova senha" label-class="text-dark" type="password" autocomplete="off">
            <x-slot name="appendSlot">
                <span class="input-group-text"><i class="fa fa-eye" id="verConfirmaSenha" ></i></span>
            </x-slot>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-lock text-dark"></i>
                    </div>
                </x-slot>
                <x-slot name="bottomSlot">
                    <div class="p-2" id="erroConfirmaSenhaForca"></div>
                </x-slot>
            </x-adminlte-input>
            <div class="container">
                <div class="float-right">
                    {{-- <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a> --}}
                    <x-adminlte-button type="submit" id="cadastrar" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
                </div>
            </div>
            
        </x-adminlte-profile-widget>
    </form>
@stop

@extends('components.footer')

@section('css')
    <style>
        .error {
            color: #F00;
            background-color: #FFF;
        }
    </style>
@stop

@section('js')
@if(!empty($mensagem))
<script>
    Swal.fire(
        'Pronto!',
        '{{$mensagem}}',
        'success'
    );
</script>
@endif
@if(!empty($error))
<script>
    Swal.fire(
        'Ops!',
        '{{$error}}',
        'error'
    );
</script>
@endif

<script>
verificaCadastroInterrompido();
// Vizualiza senha Antiga
const verSenhaAtual = document.querySelector("#verOldSenha");
     const senhaAtual = document.querySelector("#oldPassword");
     verSenhaAtual.addEventListener("click", function () {
     const tipoSenhaAtual = senhaAtual.getAttribute("type") === "password" ? "text" : "password";
     senhaAtual.setAttribute("type", tipoSenhaAtual);
     this.classList.toggle('fa-eye-slash');
    });
// Vizualiza senha Nova
    const verSenhaNova = document.querySelector("#verSenha");
     const senhaNova = document.querySelector("#password");
     verSenhaNova.addEventListener("click", function () {
     const tipoSenhaNova = senhaNova.getAttribute("type") === "password" ? "text" : "password";
     senhaNova.setAttribute("type", tipoSenhaNova);
     this.classList.toggle('fa-eye-slash');
    });
// Vizualiza Confirmação de senha
    const verConfirmaSenha = document.querySelector("#verConfirmaSenha");
     const confirmaSenha = document.querySelector("#confirmPassword");
     verConfirmaSenha.addEventListener("click", function () {
     const tipoConfirmaSenha = confirmaSenha.getAttribute("type") === "password" ? "text" : "password";
     confirmaSenha.setAttribute("type", tipoConfirmaSenha);
     this.classList.toggle('fa-eye-slash');
    });
    function validarSenhaForca(){
	var senha = document.getElementById('password').value;
	var forca = 1;
    if(senha.length == 0) {
        //Esconde Barra e Habilita botão
		mostrarForca(0);
    } else {
	/*Imprimir a senha*/
	/*document.getElementById("impSenha").innerHTML = "Senha " + senha;*/
	if((senha.length >= 4) && (senha.length <= 7)){
		forca += 10;
	}else if(senha.length > 10){
		forca += 25;
	}
	if((senha.length >= 5) && (senha.match(/[a-z]+/))){
		forca += 10;
	}
	if((senha.length >= 6) && (senha.match(/[A-Z]+/))){
		forca += 30;
	}
	if((senha.length >= 7) && (senha.match(/[@#$%&;*]/))){
		forca += 45;
	}
	if(senha.match(/([1-9]+)\1{1,}/)){
		forca += -25;
	}
	mostrarForca(forca);
    }
}
function mostrarForca(forca){
    if(forca == 0) {
		document.getElementById("erroSenhaForca").innerHTML = '';
        $('#cadastrar').prop("disabled", false);
    }else if(forca >= 1 && forca < 20 ){
		document.getElementById("erroSenhaForca").innerHTML = '<div class="progress" style="height: 15px;"><div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Senha fraca</div></div>';
        $('#cadastrar').prop("disabled", true);
	}else if((forca >= 20) && (forca < 40)){
		document.getElementById("erroSenhaForca").innerHTML = '<div class="progress" style="height: 15px"><div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Senha média</div></div>';
        $('#cadastrar').prop("disabled", false);
    }else if((forca >= 40) && (forca < 60)){
		document.getElementById("erroSenhaForca").innerHTML = '<div class="progress" style="height: 15px"><div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">Senha ótima</div></div>';
        $('#cadastrar').prop("disabled", false);
    }else if((forca >= 60) && (forca < 100)){
		document.getElementById("erroSenhaForca").innerHTML = '<div class="progress" style="height: 15px"><div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Senha exelente</div></div>';
        $('#cadastrar').prop("disabled", false);
    }
}
</script>



@endsection