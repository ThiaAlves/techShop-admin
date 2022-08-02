<?php

namespace App\Http\Controllers;

use App\Models\Acesso;
use Illuminate\Http\Request;

class AcessoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acessos = Acesso::readAcessos();
        return $acessos;
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
        $data = $request->all();
        $acesso = Acesso::createAcesso($data);
        return $acesso;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acesso  $acesso
     * @return \Illuminate\Http\Response
     */
    public function show(Acesso $acesso)
    {
        $acesso = Acesso::readAcesso($acesso->id);
        return $acesso;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acesso  $acesso
     * @return \Illuminate\Http\Response
     */
    public function edit(Acesso $acesso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acesso  $acesso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acesso $acesso)
    {
        $data = $request->all();
        $acesso = Acesso::updateAcesso($data, $acesso->id);
        return $acesso;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acesso  $acesso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acesso $acesso)
    {
        $acesso = Acesso::deleteAcesso($acesso->id);
        return $acesso;
    }
}
