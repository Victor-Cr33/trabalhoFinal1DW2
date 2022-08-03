<?php

namespace App\Http\Controllers;
use App\Models\Veterinario;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Eixo;

class ProfessorController extends Controller{
   
    public function index(){
       
        $eixo = Eixo::all();
        $data = Professor::where('ativo', '=', 1)->get();

        
        return view('professores.index', compact(['data','eixo']));
    }

    public function create(){
       
        $eixos = Eixo::all();
       

        return view('professores.create', compact('eixos'));
    }

    public function store(Request $request){
    
        $regras = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:250|min:15',
            'siape' => 'required|max:10|min:8',
            'ativo' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um professor cadastrado com esse [:attribute]!"
        ];

        $request->validate($regras, $msgs);
 
        $obj_professor = new Professor();
        $obj_eixo = Eixo::find($request->eixo_id);


        if(isset($obj_eixo)){
            $obj_professor->nome = $request->nome;
            $obj_professor->email = $request->email;
            $obj_professor->siape = $request->siape;
            $obj_professor->eixo()->associate($obj_eixo);
            $ojb_professor->ativo = $request->ativo;
            $obj_professor->save();

        }
       
        return redirect()->route('professores.index');
    }
   
    public function show($id){
    }

    public function edit($id){
        $eixo = Eixo::all();
        $data = Professor::withTrashed()->find($id);

        if(!isset($data)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('professores.edit', compact(['data','eixo'])); 
    }

    public function update(Request $request, $id){
         
        $obj_eixo = Eixo::all();
        $obj_professor = Professor::withTrashed()->find($id);

        if(!isset($obj_professor)) { return "<h1>ID: $id não encontrado!"; }

        if(isset($obj_eixo)){
            $obj_professor->nome = $request->nome;
            $obj_professor->email = $request->email;
            $obj_professor->siape = $request->siape;
            $obj_professor->eixo()->associate($obj_eixo);
            $obj_professor->save();
          if($obb_professor->ativo = false && $request-> ativo == true){
            $obj_professor->ativo = $request->ativo;
            $obj_professor->save();
            $obj_professor->restore();
          }
          elseif($obj_professor->ativo = true && $request-> ativo == false){
            $obj_professor->ativo = $request->ativo;
            $obj_professor->save();
            $obj_professor->delete();
          }
          
           
            return redirect()->route('professores.index');
        }

   
    }

    public function destroy($id){

        $obj = Professor::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }
        else{
            $obj->ativo=false;
            $obj->save();
            $obj->delete();
            return redirect()->route('professores.index');
        }
      
    }


}
