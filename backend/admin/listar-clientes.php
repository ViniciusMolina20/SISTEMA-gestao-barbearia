<?php

include 'banco-de-dados.php';

$email = NULL;

$clientes = obterClientes($email);

echo json_encode($clientes);

?>
