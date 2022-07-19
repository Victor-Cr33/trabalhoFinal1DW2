@extends('templates/main', ['titulo'=>"Cursos", 'rota'=>"cursos.create"])

@section('conteudo')

<div class="row">
    <div class="col">
               
        <x-datalist
            :title="'Cursos'"
            :crud="'cursos'"
            :header="['ID', 'NOME', 'SIGLA','TEMPO',  'AÇÕES']" 
            :fields="['id', 'nome', 'sigla', 'tempo']"
            :data="$data"
            :hide="[true, false, true, false, true]" 
            :info="['id','nome', 'sigla', 'tempo']"
            :remove="'nome'"
        />
    </div>
</div>
            
@endsection
