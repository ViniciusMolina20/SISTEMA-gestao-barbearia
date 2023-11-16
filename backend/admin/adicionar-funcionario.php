<?php

include 'banco-de-dados.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajax'])) {
    $idEmpresa = $_POST["idEmpresa"];
    $nomeFuncionario = $_POST["nomeFuncionario"];
    $cargo = $_POST["cargo"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmarSenha = $_POST["confirmarSenha"];

    $verificarExistencia = "SELECT idFuncionario FROM tb_funcionario WHERE email = '$email'";
    $resultExistencia = $conn->query($verificarExistencia);

    if ($resultExistencia->num_rows > 0) {
        echo "Funcionário já existe";
        return "Funcionário já existe.";
    }

    if ($senha != $confirmarSenha){
        echo "As senhas estão diferentes";
        return "As senhas estão diferentes";
    }

    adicionarFuncionario($idEmpresa, 
                        $nomeFuncionario,
                        $cargo,
                        $email,
                        md5($senha)
                        );
    exit();
}

function adicionarFuncionario($idEmpresa, $nomeFuncionario, $cargo, $email, $senha) {
    global $conn;


    $sql = "INSERT INTO tb_funcionario (idEmpresa, nomeFuncionario, cargo, email, senha) VALUES ('$idEmpresa', '$nomeFuncionario', '$cargo', '$email', '$senha')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Funcionário adicionado com sucesso.";
    } else {
        echo "Erro ao adicionar Funcionário: " . $conn->error;
    }
}

?>