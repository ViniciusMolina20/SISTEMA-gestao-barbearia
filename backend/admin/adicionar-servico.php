<?php

include 'banco-de-dados.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajax'])) {
    $idEmpresa = $_POST["idEmpresa"];
    $nomeServico = $_POST["nomeServico"];
    $descricaoServico = $_POST["descricaoServico"];
    $valor = $_POST["valor"];
    $imgServico = $_POST["imgServico"];

    adicionarServico($idEmpresa, 
                     $nomeServico,
                     $descricaoServico,
                     $valor,
                     $imgServico);
    exit();
}

function adicionarServico($idEmpresa, $nomeServico, $descricaoServico, $valor, $imgServico) {
    global $conn;

    $sql = "INSERT INTO tb_servico (idEmpresa, nomeServico, descricaoServico, valor, imgServico) VALUES ('$idEmpresa', '$nomeServico', '$descricaoServico', '$valor', '$imgServico')";

    if ($conn->query($sql) === TRUE) {
        echo "Serviço adicionado com sucesso.";
    } else {
        echo "Erro ao adicionar Serviço: " . $conn->error;
    }
}

?>