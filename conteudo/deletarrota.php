<?php
 include("../conexao/conexao.php");
 $rot_id = intval($_GET['rot_id']);
 if ($rot_id == 0) {
	echo "<script> alert('Não existe mais usuário a serem deletados .'); location.href='listarota.php'; </script>";
}
 $sql_code = "DELETE rota.* FROM rota WHERE rota.rot_id = '$rot_id'";
 $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);
 if ($sql_code)
	echo "<script> alert('Rota deletada com sucesso.'); location.href='listarota.php'; </script>";
 else
	echo "<script> alert('Não foi possivel deletar o rota.'); location.href='listarota.php'; </script>";
?>
 <script>
	location.href='listarota.php';
</script>