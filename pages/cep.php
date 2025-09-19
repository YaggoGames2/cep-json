<?php
$mensagem = "";
$cep = filter_input( INPUT_GET, 'cepBucado', FILTER_VALIDATE_INT);

if (isset($cep)==false || strlen($cep)!= 8) {
    $mensagem = "Cep invalido";
}else {
    $url = "https://viacep.com.br/ws/{$cep}/json/";

    $options = [
        "http" => [
            "method" => "GET",
            "header" => "Content-Type: application/json"
        ]
        ];
        $context =stream_context_create($configuracoes);
        $response = file_get_contents($url, false);
}



?>