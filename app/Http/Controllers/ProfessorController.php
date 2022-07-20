<?php

namespace App\Http\Controllers;
use App\Models\Veterinario;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Eixo;

class ProfessorController extends Controller{
   
    public function index(){
       
        $eixo = Eixo::all();
        $data = Professor::all();

        foreach ($data as $key) {
            if ($key->ativo == 1) {
                $key->ativo = "Ativo";
            }else if ($key->ativo == 0){
                $key->ativo = "Inativo";}
            if ($eixo!= null){
                foreach($eixo as $k){
                    if($key->eixo_id == $k->id){
                        $key->eixo_id = $k->nome;
                    }elseif($key->curso_id == $k->id){
                        $key->curso_id = $k->nome;
                    }
                }
            }
        } 
        return view('professores.index', compact(['data','eixo']));
    }

    public function create(){
       
        $eixos = Eixo::all();
        $data = Professor::all();
        if(!isset($data)){return"<h1>ID: Não há professores cadastradas!</h1>";}
        return view('professores.create', compact(['data','eixos']));
    }

    public function store(Request $request){
       /* 
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
*/
        Professor::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'siape' => $request->siape,
            'eixo_id' => $request->eixos,
            'ativo' => true
        ]);
        
        return redirect()->route('professores.index');
    }
   
    public function show($id){

        $eixo = Eixo::all();
        $data = Professor::find($id);
        
        foreach ($data as $key) {
            if ($key->ativo == 1) {
                $key->ativo = "Ativo";
            }else if ($key->ativo == 0){
                $key->ativo = "Inativo";}
            if ($eixo!= null){
                foreach($eixo as $k){
                    if($key->eixo_id == $k->id){
                        $key->eixo_id = $k->nome;
                    }elseif($key->curso_id == $k->id){
                        $key->curso_id = $k->nome;
                    }
                }
            }
        } 

        if(!isset($data)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('professores.show', compact(['data','eixo'])); 
    }

    public function edit($id){
        $eixo = Eixo::all();
        $data = Professor::find($id);

        if(!isset($data)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('professores.edit', compact(['data','eixo'])); 
    }

    public function update(Request $request, $id){
         
        $eixo = Eixo::all();
        $obj = Professor::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->fill([
            'nome' => $request->nome,
            'email' => $request->email,
            'siape' => $request->siape,
            'eixo_id' => $request->eixos,
            'ativo' => $request->ativo,
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
