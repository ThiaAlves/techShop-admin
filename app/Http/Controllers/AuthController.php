<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Cliente;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function login()
    {
        $credentials = request(['email', 'senha']);
        try {
        $cliente = Cliente::where('email', $credentials['email'])->first();
        if($cliente) {
            if(password_verify($credentials['senha'], $cliente->senha)) {
                return $this->respondWithToken($cliente);
            } else {
                return response()->json(['error' => 'Usuário ou senha inválidos'], 401);
            }
        }
        else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        } catch (\Exception $e) {
            return json_encode($e);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return [
            'id' => $token->id,
            'nome' => $token->nome,
            'email' => $token->email,
            'cpf' => $token->cpf,
            'telefone' => $token->telefone,
            'data_nascimento' => $token->data_nascimento,
        ];
    }


}
