<?php
// Obtem requisição
$request = json_decode(file_get_contents('php://input'), true);

if (!empty($request)) {

    // verificando se existe uma ação
    if (!isset($request['action'])) {
        echo json_encode([
            "success" => false,
            "message" => "Erro " . __LINE__ . ": Ação não identificada"
        ]);
        return;
    }

    require "DataRequest.php";
    $DataRequest = new DataRequest();

    $data = [
        "clientes" => $DataRequest->dadosClientes(),
        "fornecedores" => $DataRequest->dadosFornecedores(),
        "usuarios" => $DataRequest->dadosUsuarios()
    ];

    if (empty($data[$request['action']])) {
        echo json_encode([
            "success" => false,
            "message" => "Erro " . __LINE__ . ": Dados não encontrado"
        ]);
        return;
    }

    // retornando dados ao client
    echo json_encode([
        "success" => true,
        "data" => $data[$request['action']]
    ]);
    return;
}
