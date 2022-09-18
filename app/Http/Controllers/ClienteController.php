<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Validate;
use stdClass;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/v1/cliente",
     *   tags={"Cliente"},
     *   summary="Lista todos os clientes",
     *   description="Retorna todos os clientes",
     *   operationId="indexCliente",
     *   @OA\Response(
     *     response=200,
     *     description="Retorna todos os clientes"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o cliente"
     *   )
     * )
     */
    public function index()
    {
        $clientes = Cliente::readClientes();
        return $clientes;
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
    /** @OA\Post(path="/api/v1/cliente",
     *   tags={"Cliente"},
     *   summary="Cria um novo cliente",
     *   description="Cria um novo cliente",
     *   operationId="storeCliente",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"nome","email","telefone"},
     *       @OA\Property(property="nome", type="string", description="Nome do cliente"),
     *       @OA\Property(property="email", type="string", description="Email do cliente"),
     *       @OA\Property(property="telefone", type="string", description="Telefone do cliente"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o cliente criado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o cliente"
     *   )
     * )
     */
    public function store(Request $request)
    {

        $validate = new Validate();

        if (!$validate->validaEmail($request->email)) {
            return response()->json(['message' => 'Email inválido'], 400);
        }

        if (!$validate->validaCPF($request->cpf)) {
            return response()->json(['message' => 'CPF inválido'], 400);
        }

        if ($validate->emailExiste($request->email)) {
            return response()->json(['message' => 'Email já cadastrado'], 400);
        }

        if ($validate->cpfExiste($request->cpf)) {
            return response()->json(['message' => 'CPF já cadastrado'], 400);
        }

        try {
            $data = [
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'data_nascimento' => $validate->formataDataAmericano($request->data_nascimento),
                'cpf' => $request->cpf,
                'senha' => bcrypt($request->senha),
                'status' => 1,
            ];
            $cliente = Cliente::createCliente($data);

            $cliente = [
                'id' => $cliente->id,
                'nome' => $cliente->nome,
                'email' => $cliente->email,
                'telefone' => $cliente->telefone,
                'data_nascimento' => $validate->formataDataBrasileiro($cliente->data_nascimento),
                'cpf' => $cliente->cpf,
                'status' => $cliente->status,
            ];

            return response()->json(['data' => $cliente], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    /** @OA\Get(path="/api/v1/cliente/{id}",
     *   tags={"Cliente"},
     *   summary="Mostra um cliente",
     *   description="Mostra um cliente",
     *   operationId="showCliente",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do cliente",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o cliente"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o cliente"
     *   )
     * )
     */
    public function show($id)
    {
        $cliente = Cliente::readCliente($id);
        return $cliente;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    /** @OA\Put(path="/api/v1/cliente/{id}",
     *   tags={"Cliente"},
     *   summary="Atualiza um cliente",
     *   description="Atualiza um cliente",
     *   operationId="updateCliente",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do cliente",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"nome","email","telefone"},
     *       @OA\Property(property="nome", type="string", description="Nome do cliente"),
     *       @OA\Property(property="email", type="string", description="Email do cliente"),
     *       @OA\Property(property="telefone", type="string", description="Telefone do cliente"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o cliente atualizado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o cliente"
     *   )
     * )
     */
    public function update(Request $request, $id)
    {
        try{
            $data = [
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'data_nascimento' => $request->data_nascimento,
                'cpf' => $request->cpf,
                'senha' => bcrypt($request->senha),
                'status' => 1,
            ];

            $cliente = Cliente::updateCliente($data, $id);
            return response()->json(['success' => true,
                'message' => 'Cliente atualizado com sucesso!',
                'data' => $cliente], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    /** @OA\Delete(path="/api/v1/cliente/{id}",
     *   tags={"Cliente"},
     *   summary="Deleta um cliente",
     *   description="Deleta um cliente",
     *   operationId="destroyCliente",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID do cliente",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Retorna o cliente deletado"
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Caso não encontre o cliente"
     *   )
     * )
     */
    public function destroy($id)
    {
        try{
            $cliente = Cliente::deleteCliente($id);
            return response()->json(['success' => true,
                'message' => 'Cliente deletado com sucesso!',
                'data' => $cliente], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function logar(Request $request) {
        //Verifica se o cliente existe e está ativo
        $cliente = Cliente::where('email', $request->email)->where('status', 1)->first(); 
        if(!$cliente) {
            return response()->json(['error' => 'Cliente não encontrado'], 404);
        }
        //Verifica se a senha está correta
        if(!Hash::check($request->senha, $cliente->senha)) {
            return response()->json(['error' => 'Senha incorreta'], 404);
        }

        $data = [
            'id' => $cliente->id,
            'nome' => $cliente->nome,
            'email' => $cliente->email,
            'telefone' => $cliente->telefone,
            'data_nascimento' => $cliente->data_nascimento,
            'cpf' => $cliente->cpf,
        ];

        //Retorna o cliente
        return response()->json(['success' => true,
            'message' => 'Cliente logado com sucesso!',
            'data' => $data], 200);
    }

        //Functions para Web Admin

        public function indexAdmin(Request $request)
        {
            $count_clientes = new stdClass;
            $count_clientes->total = Cliente::count();
            $count_clientes->ativos = Cliente::where('status', 1)->count();
            $count_clientes->inativos = Cliente::where('status', 0)->count();
    
            $clientes = Cliente::select('id', 'nome', 'email', 'telefone', 'data_nascimento', 'cpf', 'status')->get();

            $mensagem = $request->session()->get('mensagem');
            return view('clientes/index', compact('clientes', 'mensagem', 'count_clientes'));
        }
    
        public function storeAdmin(Request $request)
        {
            //Se o ID for nulo, então é um novo cliente
            if($request->id == null){
                $cliente = new Cliente();
                $cliente->nome = $request->nome;
                $cliente->email = $request->email;
                $cliente->telefone = $request->telefone;
                $cliente->data_nascimento = $request->data_nascimento;
                $cliente->cpf = $request->cpf;
                $cliente->senha = bcrypt($request->senha);
                $cliente->status = $request->status;
                $cliente->save();
    
                //Mensagem de sucesso
                $request->session()->flash('mensagem', "Cliente cadastrado com sucesso!");
            } else {
                $cliente = Cliente::find($request->id);
                $cliente->nome = $request->nome;
                $cliente->email = $request->email;
                $cliente->telefone = $request->telefone;
                $cliente->data_nascimento = $request->data_nascimento;
                $cliente->cpf = $request->cpf;
                $cliente->senha = bcrypt($request->senha) ?? $cliente->senha;
                $cliente->status = $request->status;
                $cliente->save();
                //Mensagem de sucesso
                $request->session()->flash('mensagem', "Cliente atualizado com sucesso!");
            }
            return redirect()->route('clientes.index');
        }

        public function createAdmin(Request $request)
        {
            $mensagem = $request->session()->get('mensagem');
            return view('clientes.create', compact('mensagem'));
        }
    
        public function editAdmin($id) {
    
            $cliente = Cliente::find($id);
            $enderecos = Endereco::where('cliente_id', $id)->get();
            return view('clientes.create', compact('cliente', 'enderecos'));
        }
    
        public function destroyAdmin($id, Request $request)
        {
            $cliente = Cliente::deleteCliente($id);
            //Mensagem de sucesso
            $request->session()->flash('mensagem', "Cliente deletado com sucesso!");
            return redirect()->route('clientes.index');
        }
}
