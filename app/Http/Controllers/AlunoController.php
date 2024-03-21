<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'Cheguei Aqui - INDEX';

        $aluno = Aluno::all();

        return $aluno;
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
        // return ['Cheguei Aqui' => 'STORE']; formato JSON
        // return 'Cheguei Aqui - STORE'; formato HTML

        // dd($request->all());

        $aluno = Aluno::create($request->all());

        return $aluno;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function show(Aluno $aluno)
    {
        // return 'Cheguei Aqui - SHOW';

        return $aluno;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function edit(Aluno $aluno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aluno $aluno)
    {
        // return 'Cheguei Aqui - UPDATE';

        // print_r($request->all()); // Dados novos
        // echo '<hr>';
        // print_r($aluno->getAttributes()); // Dados antigos

        $aluno->update($request->all());
        return $aluno;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aluno $aluno)
    {
        // return 'Cheguei aqui - DESTROY';
        $aluno->delete();

        return ['msg' => 'O registro foi removido com sucesso'];
    }
}
