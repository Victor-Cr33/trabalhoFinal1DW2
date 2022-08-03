<?php

namespace App\Http\Controllers;
use App\Models\Veterinario;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Eixo;

class CursoController extends Controller{
   
    public function index(){
       
        $eixos = Eixo::all();
        $data = Curso::all();
        return view('cursos.index', compact(['data','eixos']));
    }

    public function create(){
       
        $eixos = Eixo::all();
        return view('cursos.create', compact('eixos'));
    }

    public function store(Request $request){
      /*  
        $regras = [
            'nome' => 'required|max:50|min:10',
            'sigla' => 'required|max:8|min:2',
            'tempo' => 'required|max:2|min:1'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um curso cadastrado com esse [:attribute]!"
        ];
 
        $request->validate($regras, $msgs);

      */
            $obj_curso = new Curso();
            $eixo = Eixo::find($request->eixo_id);

            if(isset($eixo)){
                $obj_curso->nome = $request->nome;
                $obj_curso->sigla = $request->sigla;
                $obj_curso->tempo = $request->tempo;
                $obj_curso->eixo()->associate($eixo);
                $obj_curso->save();
            }
  
        
        return redirect()->route('cursos.index');
    }

    public function show($id){

        $eixos = Eixo::all();
        $data = Curso::find($id);

        if(!isset($data)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('cursos.show', compact(['data','eixos'])); 
    }

    public function edit($id){
        $eixos = Eixo::all();
        $data = Curso::find($id);

        if(isset($data)) { 

            return view('cursos.edit', compact(['data','eixos'])); 
        }else{
            return view('cursos.index');
        }
    
    }

    public function update(Request $request, $id){
         
        $obj_eixo = Eixo::find($request->eixo_id);
        $obj_curso = Curso::find($id);

        if(isset($obj_curso) && isset($obj_eixo)){
   
            $obj_curso->nome = $request->nome;
            $obj_curso->sigla = $request->sigla;
            $obj_curso->tempo = $request->tempo;
            $obj_curso->eixo()->associate($obj_eixo);
            $obj_curso->save();

            return redirect()->route('cursos.index');
        }
        else{
            return "<h1>ID: $id não encontrado!"; 
            return redirect()->route('cursos.index');
        }

    }

    public function destroy($id){

        $obj = Curso::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('cursos.index');
    }

}
