<?php

namespace App\Http\Controllers;

use App\Models\VendaProduto;
use Illuminate\Http\Request;

class VendaProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendaProdutos = VendaProduto::readVendaProdutos();
        return $vendaProdutos;
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
        $vendaProduto = VendaProduto::createVendaProduto($data);
        return $vendaProduto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendaProduto  $vendaProduto
     * @return \Illuminate\Http\Response
     */
    public function show(VendaProduto $vendaProduto)
    {
        $vendaProduto = VendaProduto::readVendaProduto($vendaProduto->id);
        return $vendaProduto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendaProduto  $vendaProduto
     * @return \Illuminate\Http\Response
     */
    public function edit(VendaProduto $vendaProduto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendaProduto  $vendaProduto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendaProduto $vendaProduto)
    {
        $data = $request->all();
        $vendaProduto = VendaProduto::updateVendaProduto($data, $vendaProduto->id);
        return $vendaProduto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendaProduto  $vendaProduto
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendaProduto $vendaProduto)
    {
        $vendaProduto = VendaProduto::deleteVendaProduto($vendaProduto->id);
        return $vendaProduto;
    }
}
