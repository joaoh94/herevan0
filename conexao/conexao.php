<?php

	$host = "localhost";
	$usuario = "root";
	$senha = "";
	$bd = "bdb projeto";

	$mysqli = new mysqli($host, $usuario, $senha, $bd);

	if($mysqli->connect_errno)
		echo "Falha na conexão: (".$mysql->connect_errno.") ".$mysql->connect_error;
?>