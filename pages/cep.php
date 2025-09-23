<?php
$mensagem = "";
$cep = filter_input(INPUT_GET, 'cepBuscado', FILTER_VALIDATE_INT);

if (isset($cep) == false || strlen($cep) != 8) {
    $mensagem = "Cep invalido";
} else {
    $url = "https://viacep.com.br/ws/{$cep}/json/";

    $options = [
        "http" => [
            "method" => "GET",
            "header" => "Content-Type: application/json"
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response == false) {
        $mensagem = "Erro ao acessar a API ViaCEP.";
    } else { 
        $dados = json_decode($response, true); //pega json, joga em associativo para transformar em banco

        if (isset($dados["erro"]) == true) {
            $mensagem = "CEP não encontrado.";
        } //else {
           // echo "<h2> Endereço encontrado </h2>";
           // echo "<input type='text' value='{$dados['logradouro']}' disabled> <br>";
           // echo "<input type='text' value='{$dados['complemento']}' disabled> <br>";
           // echo "<input type='text' value='{$dados['bairro']}' disabled> <br>";
           // echo "<input type='text' value='{$dados['localidade']}' disabled> <br>";
           // echo "<input type='text' value='{$dados['estado']}' disabled> <br>";
       // }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>
<body>
    <div id="cep-buscado">
    <span id="error"><? $mensagem ?></span>
        <div>
            <label>logradouro: </label>
            <input type="text" value="<?= isset($dados['logradouro']) ? $dados['logradouro'] : 'CEP não encontrado.' ?>"disabled>
        </div>
        <div>
            <label>Complemento: </label>
            <input type="text" value="<?= isset($dados['complemento']) ? $dados['complemento'] : 'CEP não encontrado.' ?>"disabled>
        </div>
        <div>
            <label>Bairro: </label>
            <input type="text" value="<?= isset($dados['bairro']) ? $dados['bairro'] : 'CEP não encontrado.' ?>"disabled>
        </div>
        <div>
            <label>localidade: </label>
            <input type="text" value="<?= isset($dados['localidade']) ? $dados['localidade'] : 'CEP não encontrado.' ?>"disabled>
        </div>
        <div>
            <label>Estado: </label>
            <input type="text" value="<?= isset($dados['uf']) ? $dados['uf'] : 'CEP não encontrado.'?>"disabled>
        </div>
</div>
</body>
</html>