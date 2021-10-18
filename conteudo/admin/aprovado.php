<?php

include("../../conexao/conexao.php");
include("../../geraLog.php");

$emp_id = intval($_GET['emp_id']);
$sql_code = "UPDATE empresa SET emp_status_solicitacao = 'A' WHERE emp_id = $emp_id";
$sql_query = $mysqli->query($sql_code) or die ($mysqli->error);

if ($sql_query){

	logMsg( "O administrador aprovou o cadastro empresarial (ID: $emp_id)", 'info', '../../logs/herevanAdmin.log');
	
	echo "<script> alert('O usuário foi aprovado.'); location.href='solicitacoespendente.php'; </script>";
}

else{

	logMsg( "Ocorreu um erro ao tentar aprovar o cadastro empresarial (ID: $emp_id)", 'error', '../../logs/herevanAdmin.log' );

	echo "<script> alert('Não foi possivel aprovar o usuário.'); location.href='solicitacoespendente.php'; </script>";
}
?>

<script>
	location.href='solicitacoespendente.php';
</script>