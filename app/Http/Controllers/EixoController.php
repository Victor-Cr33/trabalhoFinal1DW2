<?php

namespace App\Http\Controllers;
use App\Models\Eixo;
use Illuminate\Http\Request;

class EixoController extends Controller {
    

    public function index() {
        
        $data = Eixo::all();
        return view('eixos.index', compact('data'));
    }

    public function create() {

        return view('eixos.create');
    }
    
    
   public function store(Request $request) {
        
    $regras = [
        'nome' => 'required|max:50|min:10'
       
    ];

    $msgs = [
        "required" => "O preenchimento do campo [:attribute] é obrigatório!",
        "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
        "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        "unique" => "Já existe um eixo cadastrado com esse [:attribute]!"
    ];

    $request->validate($regras, $msgs);

    Eixo::create([
        'nome' => $request->nome
    ]);
    
    return redirect()->route('eixos.index');
    }

    public function show($id){

        $data = Eixo::find($id);

        if(!isset($data)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('eixos.edit', compact('data')); 
    }

    public function edit($id) {

        $data = Eixo::find($id);
        
        if(!isset($data)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('eixos.edit', compact('data'));     
    }

    public function update(Request $request, $id) {
        
        $obj = Eixo::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->fill([
            'nome' => $request->nome
        ]);

        $obj->save();

        return redirect()->route('eixos.index');
    }

    public function destroy($id) {
           
        $obj = Eixo::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy($id);

        return redirect()->route('eixos.index');
    }
}
