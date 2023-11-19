<?php
session_start();

if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    echo json_encode(array('autenticado' => true, 
                           'nomeUsuario' => $_SESSION['nomeUsuario']));
} else {
    echo json_encode(array('autenticado' => false));
}
?>
