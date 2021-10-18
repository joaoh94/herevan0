<?php 

    include ("../conexao/conexao_mobile.php");

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $numeroEnd = $_POST['numeroEnd'];
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $sexo = $_POST['sexo'];
    $telefone = $_POST['telefone'];

    $sql_update = "UPDATE passageiro SET nome=:NOME, cpf=:CPF, endereco=:ENDERECO, cidade=:CIDADE, numeroEnd=:NUMEROEND, cep=:CEP, estado=:ESTADO, sexo=:SEXO, telefone=:TELEFONE WHERE cpf=:CPF";

    $stmt = $PDO->prepare($sql_update);

    $stmt->bindParam(':NOME', $nome);
    $stmt->bindParam(':CPF', $cpf);
    $stmt->bindParam(':ENDERECO', $endereco);
    $stmt->bindParam(':CIDADE', $cidade);
    $stmt->bindParam(':NUMEROEND', $numeroEnd);
    $stmt->bindParam(':CEP', $cep);
    $stmt->bindParam(':ESTADO', $estado);
    $stmt->bindParam(':SEXO', $sexo);
    $stmt->bindParam(':TELEFONE', $telefone);

    if ($stmt->execute()) {

        $dados = array("UPDATE"=>"OK");

    }
    else {

        $dados = array("UPDATE"=>"ERRO");

    }

    echo json_encode($dados);
?>