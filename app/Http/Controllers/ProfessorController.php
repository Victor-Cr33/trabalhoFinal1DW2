<?php

namespace App\Http\Controllers;
use App\Models\Veterinario;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Eixo;

class ProfessorController extends Controller{
   
    public function index(){
       
        $eixos = Eixo::all();
        $data = Professor::all();
        return view('professores.index', compact(['data','eixos']));
    }

    public function create(){
       
        $eixos = Eixo::all();
        $professores = Professor::all();
        if(!isset($professores)){return"<h1>ID: Não há professores cadastradas!</h1>";}
        return view('professores.create', compact(['professores','eixos']));
    }

    public function store(Request $request){
        
        $regras = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:250|min:15',
            'siape' => 'required|max:10|min:8',
            'eixo_id' =>'required',
            'ativo' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "unique" => "Já existe um professor cadastrado com esse [:attribute]!"
        ];
 
        $request->validate($regras, $msgs);

        Professor::create([
            'nome' => $request->nome,
            'email' => $request->sigla,
            'siape' => $request->tempo,
            'eixo_id' => $required,
            'ativo' => $required,
        ]);
        
        return redirect()->route('professores.index');
    }
   
    public function show($id){

        $eixos = Eixo::all();
        $data = Professor::find($id);

        if(!isset($data)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('professores.show', compact(['data','eixos'])); 
    }

    public function edit($id){
        $eixos = Eixo::all();
        $data = Professor::find($id);

        if(!isset($data)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('professores.edit', compact(['data','eixos'])); 
    }

    public function update(Request $request, $id){
         
        $eixos = Eixo::all();
        $obj = Professor::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->fill([
            'nome' => $required,
            'email' => $required,
            'siape' => $required,
            'eixo_id' => $required,
            'ativo' => $required,
        ]);

        $obj->save();

        return redirect()->route('professores.index');
    }

    public function destroy($id){

        $obj = Professor::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('professores.index');
    }


}
