<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use stdClass;

class UsuarioController extends Controller
{

    protected $user;

    public function __construct(Usuario $usuario)
    {
        $this->middleware('auth');
        $this->usuario = $usuario;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::readUsuarios();
        return $usuarios;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $usuario = Usuario::createUsuario($request);
            return response()->json($usuario, 201);
        } catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $usuario = Usuario::readUsuario($id);
            return response()->json($usuario, 200);
        } catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        try{
            $usuario = Usuario::updateUsuario($request, $usuario->id);
            return response()->json($usuario, 200);
        } catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $usuario = Usuario::deleteUsuario($id);
            return response()->json($usuario, 200);
        } catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function indexAdmin(Request $request)
    {
        $count_usuarios = new stdClass;
        $count_usuarios->total = Usuario::count();
        $count_usuarios->ativos = Usuario::where('status', 1)->count();
        $count_usuarios->inativos = Usuario::where('status', 0)->count();

        $usuarios = Usuario::select('id', 'nome', 'email', 'tipo', 'foto', 'cpf', 'status')->get();
        $mensagem = $request->session()->get('mensagem');
        return view('usuarios/index', compact('usuarios', 'mensagem', 'count_usuarios'));
    }

    public function storeAdmin(Request $request)
    {
        //Se o ID for nulo, então é um novo usuario
        if($request->id == null){
            $usuario = new Usuario();
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password);
            $usuario->tipo = $request->tipo;
            $usuario->foto = $request->foto ?? 'default.png';
            $usuario->cpf = $request->cpf;
            $usuario->status = $request->status;
            $usuario->save();
            activity()->on($usuario)->event('create')->withProperties($usuario)->log("Usuário {$usuario->nome} criado");


            //Mensagem de sucesso
            $request->session()->flash('mensagem', "Usuario cadastrado com sucesso!");
        } else {
            $usuario = Usuario::find($request->id);
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password) ?? $usuario->password;
            $usuario->tipo = $request->tipo;
            $usuario->foto = $request->foto ?? 'default.png';
            $usuario->cpf = $request->cpf;
            $usuario->status = $request->status;
            $usuario->save();
            activity()->on($usuario)->event('update')->withProperties($usuario)->log("Usuário {$request->nome} atualizado");

            //Mensagem de sucesso
            $request->session()->flash('mensagem', "Usuario atualizado com sucesso!");
        }
        return redirect()->route('usuario.index');
    }

    public function destroyAdmin($id, Request $request)
    {
        $usuario = Usuario::find($id);
        $usuario_destroy = Usuario::deleteUsuario($id);
        activity()->on($usuario)->event('destroy')->withProperties($usuario)->log("Usuário {$usuario->nome} excluído");

        //Mensagem de sucesso
        $request->session()->flash('mensagem', "Usuario deletado com sucesso!");
        return redirect()->route('usuario.index');
    }
}
