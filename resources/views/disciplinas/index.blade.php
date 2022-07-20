@extends('templates/main', ['titulo'=>"Disciplinas", 'rota'=>"disciplinas.create"])

@section('conteudo')

<div class="row">
    <div class="col">
               
        <x-datalist
            :title="'Disciplinas'"
            :crud="'disciplinas'"
            :header="['ID', 'NOME', 'CURSO','AÇÕES']" 
            :fields="['id', 'nome', 'curso_id']"
            :data="$data"
            :curso="$curso"
            :hide="[true, false, true, false]" 
            :info="['id','nome', 'curso']"
            :remove="'nome'"
        />
    </div>
</div>
            
@endsection
