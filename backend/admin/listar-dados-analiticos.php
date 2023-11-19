<?php

include 'banco-de-dados.php';

$dadosAnaliticos = obterDadosAnaliticos();

foreach ($dadosAnaliticos as $dadosAnalitico) {
    echo json_encode(array('qtdValor' => $dadosAnalitico['QTD_VALOR'], 
                           'qtdCorte' => $dadosAnalitico['QTD_CORTE'],
                           'qtdReserva' => $dadosAnalitico['QTD_RESERVAS']));
}
?>
