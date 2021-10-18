<?php

include("../conexao/conexao.php");
include("../geraLog.php");

$motorista_id = intval($_GET['mot_id']);

if ($motorista_id == 0) {
	echo "<script> alert('Não existe mais usuário a serem deletados .'); location.href='listamotorista.php'; </script>";
}

$sql_code = "DELETE motorista.* FROM motorista WHERE Motorista.mot_id = '$motorista_id'";

// 

$sql_query = $mysqli->query($sql_code) or die ($mysqli->error);

if ($sql_code){
	logMsg( "Listar Motoristas: O motorista (ID: $motorista_id) foi deletado", 'info', '../logs/herevan.log' );
	echo "<script> alert('Motorista deletado com sucesso.'); location.href='listamotorista.php'; </script>";
}
	

else{
	logMsg( "Listar Motoristas: Ocorreu um erro ao tentar excluir o motorista (ID: $motorista_id)", 'error', '../logs/herevan.log' );
	echo "<script> alert('Não foi possivel deletar o motorista.'); location.href='listamotorista.php'; </script>";
}
	
?>

<script>
	location.href='listamotorista.php';
</script>