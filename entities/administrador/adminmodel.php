<?php
require_once($_SERVER['DOCUMENT_ROOT']."/herevan_proj/config/database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/herevan_proj/entities/usuario/usuariomodel.php");

class AdminModel{

	public function login($email, $pass){

		if(empty($email) || empty($pass))
				return null;

		$con = new Database();
		$stmt = $con->prepare("SELECT us_id FROM usuario WHERE us_email = ? AND us_senha = ? and us_tipo = ?");

		$stmt->execute([$email, $pass, 'A']);

		return $stmt->fetch()[0];
	}

	public function getUsuarioFromUsTipo($id){
		$con = new Database();
		$stmt = $con->prepare("SELECT us_tipo FROM usuario WHERE us_id = ?");
		$stmt->execute([$id]);

		return $stmt->fetch()[0];

	}
}
?>