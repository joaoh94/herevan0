<?php

include("../../conexao/conexao.php");

$psg_id = intval($_GET['psg_id']);

$sqlPassageiroId = "SELECT us_id FROM passageiro";
$sqlPassageiroquery = $mysqli->query($sqlPassageiroId) or die ($mysqli->error);
$sqlUs_id = $sqlPassageiroquery->fetch_row();

$sql_code = "DELETE passageiro.* FROM passageiro WHERE passageiro.psg_id = '$psg_id'";
$sql_query = $mysqli->query($sql_code) or die ($mysqli->error);

$sqlUsuario = "DELETE usuario.* FROM usuario WHERE usuario.us_id = '$sqlUs_id[0]'";
$sqlUsuarioquery = $mysqli->query($sqlUsuario) or die ($mysqli->error);

if ($sql_code){

	logMsg( "O administrador exclui o cadastro do passageiro (ID: $psg_id)", 'info', '../../logs/herevanAdmin.log' );

	echo "<script> alert('Passageiro deletado com sucesso.'); location.href='listapassageiro.php'; </script>";

}	

else {

	logMsg( "Ocorreu um erro ao tentar excluir o cadastro do passageiro (ID: $psg_id)", 'error', '../../logs/herevanAdmin.log' );

	echo "<script> alert('Não foi possivel deletar a passageiro.'); location.href='listapassageiro.php'; </script>";
}
	
?>

<script>
	location.href='listapassageiro.php';
</script>