<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{

    protected $user;

    public function __construct(Usuario $usuario)
    {
        $this->middleware('auth');
        $this->usuario = $usuario;
    }


    public function index(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        $error = $request->session()->get('error');
        return view('perfil.index', compact('mensagem', 'error'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(empty($request->oldPassword)) {
            $request->session()->flash('error', "Por Favor Informe a senha Atual!");
            return redirect('/perfil');
        }

        // Verifica se senha atual está correta
        $usuario = Usuario::find($request->id);
        $senhaUsuario = $usuario->password;

        if(!password_verify($request->oldPassword, $senhaUsuario) ) {
            $request->session()->flash('error', "Senha atual Incorreta!");

            return redirect('/perfil');
        } 

        // Veririca se a senha e a confirmação de senha são iguais
        if(strcmp($request->password, $request->password_confirmation) !== 0) {
            $request->session()->flash('error', "Senhas não coincidem!");
            return redirect('/perfil');
        }

        // Se senha vem da requisição ela é criptografada se não deixa a senha que está
        empty($request->password) ? $password = $usuario->password : $password = Hash::make($request->password);

        try {
        //Verifica se e-mail já foi cadastrado por outro usuário
            $buscaUsuario = Usuario::buscaUsuarioMesmoEmailUpdate($request->id, $request->email);
            $usuario = Usuario::find($request->id);

            if(count($buscaUsuario) == 0) {

            $data = array(
                'nome' => $request->nome,
                'email' => $request->email,
                'password' => $password,
                'status' => 1,
                'tipo' => Auth::user()->tipo,
            );
            $usuario = Usuario::updateUsuario($data, $request->id);

            $usuario = Usuario::find($request->id);

            activity()->on($usuario)->event('update')->withProperties($usuario)->log('Perfil Atualizado!');

            $request->session()->flash('mensagem', "Usuário '{$request->nome}' salvo com sucesso!");

        } else {
            $request->session()->flash('error', "Email '{$request->email}' já cadastrado por outro usuário!");
        } 
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            // $request->session()->flash('error', "Erro ao atualizar perfil, contacte o administrador do sistema!");
        }

        return redirect('/perfil');
    }

}