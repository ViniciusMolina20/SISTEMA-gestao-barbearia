<?php

include 'banco-de-dados.php';

$email = NULL;

$funcionarios = obterFuncionarios($email);

echo json_encode($funcionarios);

?>
