<?php

namespace App\Http\Controllers;
use App\Models\Veterinario;
use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Curso;

class DisciplinaController extends Controller{
   
    public function index(){
       
        $curso = Curso::all();
        $data = Disciplina::all();

          foreach ($data as $key) {
                foreach($curso as $k){
                    if($key->curso_id == $k->id){
                        $key->curso_id = $k->nome;
                    }
                } 
        } 
        return view('disciplinas.index', compact(['data','curso']));
    }

    public function create(){
       
        $curso = Curso::all();
    
        return view('disciplinas.create', compact('curso'));
    }

    public function store(Request $request){
       /*
        $regras = [
            'nome' => 'required|max:100|min:10',
            'curso_id' =>'required',
            'carga' => 'required|max:12|min:1',   
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe uma disciplina cadastrado com esse [:attribute]!"
        ];
 
        $request->validate($regras, $msgs);
*/
        Disciplina::create([
            'nome' => $request->nome,
            'curso_id' => $request->curso,
            'carga' => $request->carga,
        ]);
        
        return redirect()->route('disciplinas.index');
    }
   
    public function show($id){

        $curso = Curso::all();
        $data = Disciplina::find($id);
        
        foreach ($data as $key) {
            if($key->curso_id == $k->id){
                $key->curso_id = $k->nome;
            }
        } 
        if(!isset($data)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('disciplinas.show', compact(['data','curso'])); 
    }

    public function edit($id){
        $curso = Curso::all();
        $data = Disciplina::find($id);

        if(!isset($data)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('disciplinas.edit', compact(['data','curso'])); 
    }

    public function update(Request $request, $id){
         
        $curso = Curso::all();
        $obj = Disciplina::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->fill([
            'nome' => $request->nome,
            'curso_id' => $request->curso,
            'carga' => $request->carga,
        ]);

        $obj->save();

        return redirect()->route('disciplinas.index');
    }

    public function destroy($id){

        $obj = Disciplina::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('disciplinas.index');
    }


}
