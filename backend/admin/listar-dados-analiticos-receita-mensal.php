<?php

include 'banco-de-dados.php';

$dadosAnaliticos = obterDadosAnaliticosReceitaMensal();

echo json_encode($dadosAnaliticos);

?>
