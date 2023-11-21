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

function obterFuncionarios($email) {
    global $conn; 

    if (is_null($email)){
        $sql = "SELECT funcionario.idFuncionario,
                   funcionario.idEmpresa,
                   funcionario.nomeFuncionario,
                   cargo.nomeCargo,
                   funcionario.email,
                   funcionario.senha,
                   funcionario.img_perfil
            FROM tb_funcionario as funcionario
            INNER JOIN tb_cargo as cargo
            ON funcionario.cargo = cargo.idCargo";
    }else {
        $sql = "SELECT funcionario.idFuncionario,
                    funcionario.idEmpresa,
                    funcionario.nomeFuncionario,
                    cargo.nomeCargo,
                    funcionario.email,
                    funcionario.senha,
                    funcionario.img_perfil
                FROM tb_funcionario as funcionario
                INNER JOIN tb_cargo as cargo
                ON funcionario.cargo = cargo.idCargo
                WHERE funcionario.email = '$email'";

    }

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
                   cliente.nomeCliente,
                   reserva.dataReserva,
                   reserva.horaReserva,
                   reserva.status,
                   status.nomeStatusReserva,
                   reserva.prioridade,
                   funcionario.nomeFuncionario
            FROM tb_reserva reserva
            INNER JOIN tb_status_reserva status
            ON reserva.status = status.idStatusReserva
            INNER JOIN tb_cliente cliente
            ON reserva.idCliente = cliente.idCliente
            INNER JOIN tb_funcionario funcionario
            ON reserva.idFuncionario = funcionario.idFuncionario
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

function obterAtendimentos ($idCliente, $idFuncionario){
    global $conn;

    $sql = "SELECT  atendimento.idAtendimento,
                    atendimento.idEmpresa,
                    atendimento.idCliente,
                    cliente.nomeCliente,
                    atendimento.idFuncionario,
                    funcionario.nomeFuncionario,
                    atendimento.dataAtendimento,
                    atendimento.servico,
                    servico.nomeServico,
                    atendimento.valor
            FROM tb_atendimento atendimento
            INNER JOIN tb_cliente cliente
            ON cliente.idCliente = atendimento.idCliente
            INNER JOIN tb_funcionario funcionario
            ON atendimento.idFuncionario = funcionario.idFuncionario
            INNER JOIN tb_servico servico
            ON atendimento.servico = servico.idServico
            WHERE atendimento.idCliente = IFNULL(".$idCliente.", atendimento.idCliente)
            AND   atendimento.idFuncionario = IFNULL(".$idFuncionario.", atendimento.idFuncionario)";
    
    $result = $conn->query($sql);

    $cargos = array();

    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cargos[] = $row;
        }
    }

    return $cargos;
}

function validarLoginCliente($email, $senha) {
    global $conn;

    $sql = "SELECT COUNT(1) AS QTD_REGISTRO
            FROM tb_cliente cliente
            WHERE cliente.email = $email
            and   cliente.senha = $senha";
    
    $result = $conn->query($sql);

    if ($result -> num_rows > 0){
        return true;
    }else{
        return false;
    }

}

function validarLoginFuncionario($email, $senha) {
    global $conn;

    $sql = "SELECT 1
            FROM tb_funcionario funcionario
            WHERE funcionario.email = '$email'
            and   funcionario.senha = '$senha'";
    
    $result = $conn->query($sql);

    if ($result -> num_rows > 0){
        return true;
    }else{
        return false;
    }

}

function obterDadosAnaliticos() {
    global $conn;

    $sql = "SELECT  (SELECT IFNULL(SUM(VALOR), 0) FROM TB_ATENDIMENTO) AS QTD_VALOR,
                    (SELECT IFNULL(COUNT(1), 0)   FROM TB_ATENDIMENTO) AS QTD_CORTE,
                    (SELECT IFNULL(COUNT(1), 0)   FROM TB_RESERVA)     AS QTD_RESERVAS
            FROM DUAL";
    
    $result = $conn->query($sql);
    $dados = array();

    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dados[] = $row;
        }
    }

    return $dados;

}

function obterDadosAnaliticosReceitaMensal() {
    global $conn;

    $sql = "SELECT MONTH(atendimento.dataAtendimento) as mes,
                   YEAR(atendimento.dataAtendimento) as ano,
                   funcionario.nomeFuncionario,
                   sum(atendimento.valor) as valor,
                   COUNT(1) as qtd_atendimento
            FROM tb_atendimento atendimento
            INNER JOIN tb_funcionario funcionario
            on atendimento.idFuncionario = funcionario.idFuncionario
            GROUP BY MONTH(atendimento.dataAtendimento), 
                     YEAR(atendimento.dataAtendimento), 
                     funcionario.nomeFuncionario";
    
    $result = $conn->query($sql);
    $dados = array();

    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dados[] = $row;
        }
    }

    return $dados;
}

function obterDadosFinanceiros() {
    global $conn;

    $sql = "SELECT  idFinanceiro,
                    idEmpresa,
                    dataTransacao,
                    descricao,
                    tipoTransacao,
                    transacao.nomeTransacao,
                    valor,
                    MONTH(dataTransacao) as mes,
                    YEAR(dataTransacao) as ano
            FROM tb_financeiro financeiro
            INNER JOIN tb_tipo_transacao transacao
            ON financeiro.tipoTransacao = transacao.idTipoTransacao";
    
    $result = $conn->query($sql);
    $dados = array();

    if ($result -> num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dados[] = $row;
        }
    }

    return $dados;
}

?>

