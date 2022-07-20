@extends('templates/main', ['titulo'=>"Professores", 'rota'=>"professores.create"])

@section('conteudo')

<div class="row">
    <div class="col">
               
        <x-datalist
            :title="'Professores'"
            :crud="'professores'"
            :header="['ID', 'NOME', 'EIXO','STATUS',  'AÇÕES']" 
            :fields="['id', 'nome', 'eixo', 'status']"
            :data="$data"
            :hide="[true, false, true, false, true]" 
            :info="['id','nome', 'eixo', 'status']"
            :remove="'nome'"
        />
    </div>
</div>
            
@endsection
