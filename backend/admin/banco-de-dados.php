<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestao_barbearia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão com o banco de dados falhou: " . $conn->connect_error);
}

function obterClientes() {
    global $conn; 

    $sql = "SELECT idCliente,
                   idEmpresa,
                   nomeCliente,
                   telefone,
                   email
            FROM tb_cliente";

    $result = $conn->query($sql);

    $clientes = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $clientes[] = $row;
        }
    }

    return $clientes;
}

function obterFuncionarios() {
    global $conn; 

    $sql = "SELECT funcionario.idFuncionario,
                   funcionario.idEmpresa,
                   funcionario.nomeFuncionario,
                   cargo.nomeCargo,
                   funcionario.email,
                   funcionario.senha
            FROM tb_funcionario as funcionario
            INNER JOIN tb_cargo as cargo
            ON funcionario.cargo = cargo.idCargo";
            
    $result = $conn->query($sql);

    $funcionarios = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $funcionarios[] = $row;
        }
    }

    return $funcionarios;
}

function obterPermissaoModulo($idFuncionario, $idModulo) {
    global $conn; 

    $sql = "SELECT controle.idFuncionario,
                   controle.modulo,
                   controle.permissao
            FROM tb_controle_acesso as controle
            WHERE controle.idFuncionario = $idFuncionario
            AND   controle.modulo = $idModulo";
            
    $result = $conn->query($sql);

    $permissao = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $permissao[] = $row;
        }
    }

    return $permissao;
}

function obterEmpresas() {
    global $conn; 

    $sql = "SELECT empresa.idEmpresa,
                   empresa.nomeEmpresa,
                   empresa.endereco,
                   empresa.telefone,
                   empresa.email,
                   empresa.img_logo,
                   empresa.descricaoEmpresa
            FROM  tb_empresa as empresa";
            
    $result = $conn->query($sql);

    $empresas = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $empresas[] = $row;
        }
    }

    return $empresas;
}

function obterCargos(){
    global $conn;

    $sql = "SELECT idCargo,
                   nomeCargo,
                   descricaoCargo
            FROM tb_cargo";
    
    $result = $conn->query($sql);

    $cargos = array();

    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cargos[] = $row;
        }
    }

    return $cargos;
}

function obterReservas ($idCliente, $idFuncionario){
    global $conn;

    $sql = "SELECT reserva.idReserva,
                   reserva.idEmpresa,
                   reserva.idCliente,
                   reserva.dataReserva,
                   reserva.horaReserva,
                   status.nomeStatusReserva as status,
                   reserva.prioridade
            FROM tb_reserva reserva
            INNER JOIN tb_status_reserva status
            WHERE reserva.idCliente = IFNULL(".$idCliente.", reserva.idCliente)
            AND   reserva.idFuncionario = IFNULL(".$idFuncionario.", reserva.idFuncionario)";
    
    $result = $conn->query($sql);

    $cargos = array();

    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cargos[] = $row;
        }
    }

    return $cargos;
}

?>

