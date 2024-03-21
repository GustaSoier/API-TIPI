<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CEP</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

    <h1>CEP</h1>

<label for="cep"></label>
<input type="text" id="cep" name="cep">
<button onclick="buscarCep()">Buscar CEP</button>

<div id="endereco">


    <h2>Cep: </h2>
    <h3>Logadouro: </h3>
    <h3>Complemento: </h3>
    <h3>Bairro: </h3>
    <h3>Localidade: </h3>
    <h3>UF: </h3>
    <h3>DDD: </h3>

</div>

<script>

    function buscarCep() {
        var cep = $('#cep').val();

        $.get('https://viacep.com.br/ws/'+ cep +'/json/', function(data) {
            $('#endereco').html('');
            $('#endereco').append('<h2>Dados do endereço</h2>')
            $('#endereco').append('<h2>CEP: '+ data.cep +'</h2>')
        });
    }

</script>

</body>
</html>
