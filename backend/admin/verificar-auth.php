<?php
session_start();

if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    echo json_encode(array('autenticado' => true, 
                           'nomeUsuario' => $_SESSION['nomeUsuario'],
                           'emailFuncionario' => $_SESSION['emailFuncionario'],
                           'imagemPerfil' => $_SESSION['imagemPerfil']));
} else {
    echo json_encode(array('autenticado' => false));
}
?>
