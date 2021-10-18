<?php

include("../conexao/conexao.php");

$contrato_id = intval($_GET['contrato_id']);

if ($contrato_id == 0) {
	echo "<script> alert('Não existe mais usuário a serem deletados .'); location.href='listacontrato.php'; </script>";
}

$sql_code = "DELETE contrato.* FROM contrato WHERE Contrato.contrato_id = '$contrato_id'";
$sql_query = $mysqli->query($sql_code) or die ($mysqli->error);

if ($sql_code)
	echo "<script> alert('Foi possivel deletar o usuário.'); location.href='listacontrato.php'; </script>";

else
	echo "<script> alert('Não foi possivel deletar o usuário.'); location.href='listacontrato.php'; </script>";
?>

<script>
	location.href='listacontrato.php';
</script>