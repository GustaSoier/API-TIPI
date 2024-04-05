<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlunoController extends Controller
{

    public $aluno;

    public function __construct(Aluno $aluno) {
        $this -> aluno = $aluno;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'Cheguei Aqui - INDEX';

        // $aluno = Aluno::all();

        $alunos = $this -> aluno -> all();

        return response()->json($alunos, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

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

        // $aluno = Aluno::create($request->all());

        $request -> validate($this->aluno->Regras(), $this->aluno->Feedback());

        $imagem = $request -> file('foto');

        $imagem_url = $imagem -> store('imagem', 'public');

        // dd($imagem_url);

        $alunos = $this->aluno->create([
            'nome' => $request-> nome,
            'foto' => $imagem_url
        ]);

        return response()->json($alunos, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alunos = $this->aluno->find($id);

        if($alunos === null) {
            return response()->json(['error' => 'Não existe dados para esse aluno'], 404); // a URL é válida, mas o recurso que uqer acessar não existe no banco
        }

        // return 'Cheguei Aqui - SHOW';
        return response()->json($alunos, 200) ;
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
    public function update(Request $request, $id)
    {
       //return 'Cheguei aqui - UPDATE';

       /*
        print_r($request->all()); // Novos dados
        echo '<hr>';
        print_r($aluno->getAttributes()); // Dados antigos
        */
       $alunos = $this->aluno->find($id);

    //    dd($request->nome);
    //    dd($request->file('foto'));

        if($alunos === null){
            return response()->json(['erro' => 'Impossível realizar a atualização. O aluno não existe!'], 404);
        }

        if($request->method() === 'PATCH') {
            // return ['teste' => 'PATCH'];

            $dadosDinamico = [];

            foreach ($alunos->Regras() as $input => $regra) {
                if(array_key_exists($input, $request->all())) {
                    $dadosDinamico[$input] = $regra;
                }
            }

            // dd($dadosDinamico);

            $request->validate($dadosDinamico, $this->aluno->Feedback());
        }
        else{
            $request->validate($this->aluno->Regras(), $this->aluno->Feedback());
        }

        if($request->file('foto') == true) {
            Storage::disk('public')->delete($alunos->foto);
        }

        $imagem = $request -> file('foto');

        $imagem_url = $imagem -> store('imagem', 'public');

       $alunos -> update([
            'nome' => $request->nome,
            'foto' => $imagem_url
       ]); // update dos novos dados

       return response()->json($alunos, 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $alunos = $this -> aluno -> find($id);

        if($alunos === null){
            return response()->json(['erro' => 'Impossível deleter este registro. O aluno não existe!'], 404);
        }

        Storage::disk('public')->delete($alunos->foto);

        // return 'Cheguei aqui - DESTROY';
        $alunos->delete();

        return response()->json(['msg' => 'O registro foi removido com sucesso'], 200);
    }
}
