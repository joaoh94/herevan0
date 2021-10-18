<?php 

    include ("../conexao/conexao_mobile.php");

    $psg_id = $_POST['psg_id'];

    $sql_contrato = "SELECT rot_id FROM contrato WHERE psg_id = $psg_id";
    $stmtcto = $PDO->query($sql_contrato);
    $contrato = $stmtcto->fetch(PDO::FETCH_OBJ);
    //echo $contrato->rot_id;

    $sql_rota = "UPDATE rota SET rot_qtdLivre = rot_qtdLivre+1 WHERE rot_id=$contrato->rot_id";

    $stmtrota = $PDO->prepare($sql_rota);

    $sql_passageiro = "DELETE FROM contrato WHERE psg_id = $psg_id";    

    $stmtpsg = $PDO->prepare($sql_passageiro);    

    if ($stmtpsg->execute() && $stmtrota->execute()) {

        $dados = array("CANCELAMENTO"=>"OK");

    }
    else {

        $dados = array("CANCELAMENTO"=>"ERRO");
    }

    echo json_encode($dados);
?>