<?php

include 'banco-de-dados.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$validacao = validarLoginFuncionario($email, md5($senha));

if ($validacao){
    session_start();

    $funcionarios = obterFuncionarios($email);
    $_SESSION['logado'] = true;

    foreach ($funcionarios as $funcionario) {
        $nomeFuncionario = $funcionario['nomeFuncionario'];
    }

    $_SESSION['nomeUsuario'] = $nomeFuncionario;

    echo "<script>window.location.href = '../../frontend/admin/index.html';</script>";
}else{
    echo "Login falhou. Verifique seu nome de usuário e senha.";
}

$conn->close();
?>
