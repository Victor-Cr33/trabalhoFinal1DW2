<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Professores</title>
</head>
<body>
    <a href="{{route('professores.index')}}">Voltar</a>
    <br>
    <label>ID: </label>{{$data['id']}}
    <br>
    <label>Nome: </label>{{$data['nome']}}
    <br>
    <label>Email: </label>{{$data['email']}}
    <br>
    <label>Siape: </label>{{$data['siape']}}
    <br>
    <label>Eixo: </label>{{$data['eixo']}}
</body>
</html>