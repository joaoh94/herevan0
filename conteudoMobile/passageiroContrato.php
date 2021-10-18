<?php 

    include ("../conexao/conexao_mobile.php");

    $rot_id = $_POST['rot_id'];

    $psg_id = $_POST['psg_id'];

    $emp_id = $_POST['emp_id'];

    $sql_passageiro = "SELECT * FROM contrato WHERE psg_id = :PSG";
    $stmtpsg = $PDO->prepare($sql_passageiro);
    $stmtpsg->bindParam(':PSG', $psg_id);
    $stmtpsg->execute();

    if($stmtpsg->rowCount() > 0){
        //passageiro com contrato
        $dados = array("UPDATE"=>"ALERT");        
    }
    else{

        $sql_rota = "UPDATE rota SET rot_qtdLivre = rot_qtdLivre-1 WHERE rot_id=$rot_id";
    
        $sql_contrato = "INSERT INTO contrato (rot_id, psg_id, emp_id) VALUES ($rot_id, $psg_id, $emp_id)";

        $stmtrota = $PDO->prepare($sql_rota);

        $stmtcontrato = $PDO->prepare($sql_contrato);

        if ($stmtrota->execute() && $stmtcontrato->execute()) {

            $dados = array("UPDATE"=>"OK");

        }
        else {

            $dados = array("UPDATE"=>"ERRO");
        }
    }

    echo json_encode($dados);
?>