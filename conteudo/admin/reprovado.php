<?php

include("../../conexao/conexao.php");
include("../../geraLog.php");

$emp_id = intval($_GET['emp_id']);
$sql_code = "UPDATE empresa SET emp_status_solicitacao = 'R' WHERE emp_id = $emp_id";
$sql_query = $mysqli->query($sql_code) or die ($mysqli->error);

if ($sql_query) {
	
	logMsg( "O administrador reprovou o cadastro empresarial (ID: $emp_id)", 'info', '../../logs/herevanAdmin.log' );
	
	echo "<script> alert('O usuário foi reprovado.'); location.href='solicitacoespendente.php'; </script>";
}

else{

	logMsg( "Ocorreu um erro ao tentar reprovar o cadastro empresarial (ID: $emp_id)", 'error', '../../logs/herevanAdmin.log' );
	
	echo "<script> alert('Não foi possivel reprovar o usuário.'); location.href='solicitacoespendente.php'; </script>";
}
?>

<script>
	location.href='solicitacoespendente.php';
</script>