<?php 

    include ("../conexao/conexao_mobile.php");

    $psg_id = $_POST['psg_id'];

    $sql_contrato = "SELECT * FROM contrato WHERE psg_id = $psg_id";
    $stmtcto = $PDO->query($sql_contrato);
    $contrato = $stmtcto->fetch(PDO::FETCH_OBJ);
    //echo $contrato->psg_id;

    $sql_emp = "SELECT * from empresa where emp_id = $contrato->emp_id";
	$dadosEmp = $PDO->query($sql_emp);
	$empresa = $dadosEmp->fetch(PDO::FETCH_OBJ);
    //echo $nomeFantasia = $empresa->emp_nome_fantasia;
    //echo $cnpj = $empresa->emp_cnpj;
    //echo $telefone = $empresa->emp_telefone;

    $sql_rot = "SELECT * from rota where rot_id = $contrato->rot_id";
	$dadosRot = $PDO->query($sql_rot);
	$rota = $dadosRot->fetch(PDO::FETCH_OBJ);
    //echo $lugares = $rota->rot_qtdLivre;
    //echo $cnpj = $rota->rot_preco;

    $resultado[] = array("nome"=>$empresa->emp_nome_fantasia, "cnpj"=>$empresa->emp_cnpj, "telefone"=>$empresa->emp_telefone, "lugares"=>$rota->rot_qtdLivre, "preco"=>$rota->rot_preco );

    echo json_encode($resultado);
?>