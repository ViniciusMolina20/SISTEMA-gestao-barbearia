<?php
include '../admin/banco-de-dados.php';


$idCliente =  2; //Vinicius Molina: Essa informação vai precisar vir do Front-End através do SESSION (Após Login)
$idFuncionario = 'NULL';  //Vinicius Molina: Afim de Reaproveitar o Select, esse cara sempre vai ser NULO pra essa page.

$reservas = obterReservas($idCliente, $idFuncionario);

echo '<ul>';
foreach ($reservas as $reserva) {
    echo '<li>' . $reserva['dataReserva'] . ' - ' . $reserva['horaReserva'] . ' - '. $reserva['status'] . '</li>';
}
echo '</ul>';   
?>
    