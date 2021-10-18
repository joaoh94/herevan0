<?php

    include ("../conexao/conexao_mobile.php");

    $email = $_POST['us_email'];
    $senha = $_POST['us_senha'];

    $sql_login = "SELECT * FROM usuario WHERE us_email = :EMAIL AND us_senha = :SENHA";
    $stmt = $PDO->prepare($sql_login);
    $stmt->bindParam(':EMAIL', $email);
    $stmt->bindParam(':SENHA', $senha);
    $stmt->execute();
    $us_id = $stmt->fetch(PDO::FETCH_ASSOC);
    $teste = $us_id['us_id'];

    $sql_passageiro = "SELECT psg_id FROM passageiro WHERE us_id = $teste";
    $stmtpsg = $PDO->prepare($sql_passageiro);
    $stmtpsg->execute();
    $psg_id = $stmtpsg->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() > 0 && $stmtpsg->rowCount() > 0){
        $retornoMobile = array("LOGIN"=>"Sucesso", "ID"=>$psg_id['psg_id']);
    } else {
        $retornoMobile = array("LOGIN"=>"Erro");
    }

    echo json_encode($retornoMobile); 
?>