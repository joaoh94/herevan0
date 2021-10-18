<?php

include("../conexao/conexao.php");
include("../geraLog.php");

$GLOBALS['veiculo_id'] = intval($_GET['vei_id']);

if ($veiculo_id == 0) {
	echo "<script> alert('Não existe mais usuário a serem deletados .'); location.href='listaveiculo.php'; </script>";
}

$sql_code = "DELETE veiculo.* FROM veiculo WHERE veiculo.vei_id = '$veiculo_id' ";
$sql_query = $mysqli->query($sql_code) or die ($mysqli->error);

if ($sql_code){
	logMsg( "Listar Veiculos: O veiculo (ID: $veiculo_id) foi deletado", 'info', '../logs/herevan.log' );
	echo "<script> alert('Veiculo deletado com sucesso.'); location.href='listaveiculo.php'; </script>";
}
	

else {
	logMsg( "Listar Veiculos: Ocorreu um erro ao tentar excluir o veiculos (ID: $veiculo_id)", 'error', '../logs/herevan.log' );
	echo "<script> alert('Não foi possivel deletar o Veiculo.'); location.href='listaveiculo.php'; </script>";
}
	
?>

<script>
	location.href='listaveiculo.php';
</script>