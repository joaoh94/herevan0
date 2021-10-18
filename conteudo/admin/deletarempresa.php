<?php

include("../../conexao/conexao.php");
include("../../geraLog.php");

$emp_id = intval($_GET['emp_id']);

$sqlEmpresaId = "SELECT us_id FROM empresa";
$sqlEmpresaquery = $mysqli->query($sqlEmpresaId) or die ($mysqli->error);
$sqlUs_id = $sqlEmpresaquery->fetch_row();

$sqlRota = "DELETE rota.* FROM rota WHERE rota.emp_id = '$emp_id'";
$sqlRotataquery = $mysqli->query($sqlRota) or die ($mysqli->error);

$sqlVeiculo = "DELETE veiculo.* FROM veiculo WHERE veiculo.emp_id = '$emp_id'";
$sqlViculoquery = $mysqli->query($sqlVeiculo) or die ($mysqli->error);

$sqlMotorista = "DELETE motorista.* FROM motorista WHERE motorista.emp_id = '$emp_id'";
$sqlMotoristaquery = $mysqli->query($sqlMotorista) or die ($mysqli->error);

$sqlMensagem = "DELETE mensagem.* FROM mensagem WHERE mensagem.emp_id = '$emp_id'";
$sqlMensagemquery = $mysqli->query($sqlMensagem) or die ($mysqli->error);

$sql_code = "DELETE empresa.* FROM empresa WHERE empresa.emp_id = '$emp_id'";
$sql_query = $mysqli->query($sql_code) or die ($mysqli->error);

$sqlUsuario = "DELETE usuario.* FROM usuario WHERE usuario.us_id = '$sqlUs_id[0]'";
$sqlUsuarioquery = $mysqli->query($sqlUsuario) or die ($mysqli->error);

if ($sql_code){

	logMsg( "O administrador exclui o cadastro empresarial (ID: $emp_id)", 'info', '../../logs/herevanAdmin.log' );

	echo "<script> alert('Empresa deletada com sucesso.'); location.href='listaempresa.php'; </script>";
}

else {

	logMsg( "Ocorreu um erro ao tentar excluir o cadastro empresarial (ID: $emp_id)", 'error', '../../logs/herevanAdmin.log' );

	echo "<script> alert('Não foi possivel deletar a empresa.'); location.href='listaempresa.php'; </script>";
}
?>

<script>
	location.href='listaempresa.php';
</script>