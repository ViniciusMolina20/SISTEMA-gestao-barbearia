<?php

include 'banco-de-dados.php';

$idCliente =  'NULL'; //Vinicius Molina: Afim de Reaproveitar o Select, esse cara sempre vai ser NULO pra essa page.
$idFuncionario = 'NULL';  //Vinicius Molina: Essa informação vai precisar vir do Front-End através do SESSION (Após Login)

$reservas = obterReservas($idCliente, $idFuncionario);

echo json_encode($reservas);

?>
