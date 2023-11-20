<?php

include 'banco-de-dados.php';

$dadosFinanceiros = obterDadosFinanceiros();

echo json_encode($dadosFinanceiros);

?>
