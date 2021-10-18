<?php

include("../conexao/conexao.php");

$mensagem_id = intval($_GET['msg_id']);

if ($mensagem_id == 0) {
	echo "<script> alert('Não existe mais mensagens a serem deletadas .'); location.href='listacontato.php'; </script>";
}

$sql_code = "DELETE mensagem.* FROM mensagem WHERE mensagem.msg_id = '$mensagem_id'";

$sql_query = $mysqli->query($sql_code) or die ($mysqli->error);

if ($sql_code)
	echo "<script> alert('Mensagem deletada com sucesso.'); location.href='listacontato.php'; </script>";

else
	echo "<script> alert('Não foi possivel deletar a mensagem.'); location.href='listacontato.php'; </script>";
?>

<script>
	location.href='listacontato.php';
</script>