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
        $emailFuncionario = $funcionario['email'];
        $imagemPerfil = $funcionario['img_perfil'];
    }

    $_SESSION['nomeUsuario'] = $nomeFuncionario;
    $_SESSION['emailFuncionario'] = $emailFuncionario;
    $_SESSION['imagemPerfil'] =  $imagemPerfil;

    echo "<script>window.location.href = '../../frontend/admin/index.html';</script>";
}else{
    echo "Login falhou. Verifique seu nome de usuário e senha.";
}

$conn->close();
?>
