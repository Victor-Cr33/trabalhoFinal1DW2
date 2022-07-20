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

        Curso::create([
            'nome' => $request->nome,
            'sigla' => $request->sigla,
            'tempo' => $request->tempo,
            'eixo_id' => $request->eixo
        ]);
        
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

        if(!isset($data)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('cursos.edit', compact(['data','eixos'])); 
    }

    public function update(Request $request, $id){
         
        $eixos = Eixo::all();
        $obj = Curso::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->fill([
            'nome' => $request->nome,
            'sigla' => $request->sigla,
            'tempo' => $request->tempo,
            'eixo_id' => $request -> eixo,
        ]);

        $obj->save();

        return redirect()->route('cursos.index');
    }

    public function destroy($id){

        $obj = Curso::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('cursos.index');
    }

}
