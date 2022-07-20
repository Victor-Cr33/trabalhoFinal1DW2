<?php

namespace App\Http\Controllers;
use App\Models\Veterinario;
use Illuminate\Http\Request;
use App\Models\Docencia;
use App\Models\Disciplina;
use App\Models\Professor;

class DocenciaController extends Controller{
   
    public function index(){
       
        $data = Docencia::all();
        $disciplinas = Disciplina::all();
        $professores = Professor::all();

        foreach ($data as $key) {
                foreach($disciplinas as $k){
                    if($key->disciplinas_id == $k->id){
                        $key->disciplinas_id = $k->nome;
                    }
                }
                foreach($professores as $p){
                    if($key->professor_id == $p->id){
                        $key->professor_id = $p->nome;
                    }
                }
            
        } 
        return view('docencias.index', compact(['data','disciplinas','professores']));
    }

    public function create(){
            
    }

    public function store(Request $request){


        $profes = $request->professor;
        $discip= $request->disciplina;

        
        $docencias = new Docencia();
         
        for ($i = 0; $i < count($profes); $i++) {
            $docencias->professor_id = $profes[$i];
            $docencias->disciplina_id = $discip[$i];
            $docencias->save();
        }
 
         return redirect()->route('disciplinas.index');
     }
    

}
