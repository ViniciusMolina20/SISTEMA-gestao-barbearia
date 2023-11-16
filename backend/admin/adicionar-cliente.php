<?php

include 'banco-de-dados.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajax'])) {
    $idEmpresa = $_POST["idEmpresa"];
    $nomeCliente = $_POST["nomeCliente"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmarSenha = $_POST["confirmarSenha"];

    $verificarExistencia = "SELECT idCliente FROM tb_cliente WHERE email = '$email'";
    $resultExistencia = $conn->query($verificarExistencia);

    if ($resultExistencia->num_rows > 0) {
        echo "Cliente já existe";
        return "Cliente já existe.";
    }

    if ($senha != $confirmarSenha){
        echo "As senhas estão diferentes";
        return "As senhas estão diferentes";
    }

    adicionarCliente($idEmpresa, 
                     $nomeCliente,
                     $telefone,
                     $email,
                     md5($senha)
                    );
    
    exit();
}

function adicionarCliente($idEmpresa, $nomeCliente, $telefone, $email, $senha) {
    global $conn;

    $sql = "INSERT INTO tb_cliente (idEmpresa, nomeCliente, telefone, email, senha) VALUES ('$idEmpresa', '$nomeCliente', '$telefone', '$email', '$senha')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Cliente adicionado com sucesso.";
    } else {
        echo "Erro ao adicionar cliente: " . $conn->error;
    }
}

?>