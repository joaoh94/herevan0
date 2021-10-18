<?php
require_once($_SERVER['DOCUMENT_ROOT']."/herevan_proj/config/database.php");

class UsuarioModel{

	public function __construct(){

	}

	public function create($email, $senha, $tipo){

		if(empty($email) || empty($senha) || empty($tipo) || !filter_var($email, FILTER_VALIDATE_EMAIL))
			return null;

		$con = new Database();

		try{
			$stmt = $con->prepare("INSERT INTO usuario VALUES (NULL, ?, ?, ?)");
			$stmt->execute([$email, $senha, $tipo]);
			return $con->lastInsertId();

		}catch(PDOException $exception){
			throw $exception;
		}
		
	}
}

?>