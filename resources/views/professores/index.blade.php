@extends('templates/main', ['titulo'=>"Professores", 'rota'=>"professores.create"])

@section('conteudo')

<div class="row">
    <div class="col">
               
        <x-datalist
            :title="'Professores'"
            :crud="'professores'"
            :header="['ID', 'NOME', 'EIXO','STATUS','AÇÕES']" 
            :fields="['id', 'nome', 'eixo_id', 'ativo']"
            :data="$data"
            :eixo="$eixo"
            :hide="[true, false, true, false, true]" 
            :info="['id','nome', 'eixo', 'status']"
            :remove="'nome'"
        />
    </div>
</div>
            
@endsection
