<?php

include 'banco-de-dados.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajax'])) {
    $idEmpresa = $_POST["idEmpresa"];
    $nomeCargo = $_POST["nomeCargo"];
    $descricaoCargo = $_POST["descricaoCargo"];

    adicionarCargo($idEmpresa, 
                   $nomeCargo,
                   $descricaoCargo);
    exit();
}

function adicionarCargo($idEmpresa, $nomeCargo, $descricaoCargo) {
    global $conn;
    
    $sql = "INSERT INTO tb_cargo (idEmpresa, nomeCargo, descricaoCargo) VALUES ('$idEmpresa', '$nomeCargo', '$descricaoCargo')";

    if ($conn->query($sql) === TRUE) {
        echo "Cargo adicionado com sucesso.";
    } else {
        echo "Erro ao adicionar Cargo: " . $conn->error;
    }
}

?>