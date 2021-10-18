<?php
require_once($_SERVER['DOCUMENT_ROOT']."/herevan_proj/config/database.php");
require_once($_SERVER['DOCUMENT_ROOT']."/herevan_proj/entities/usuario/usuariomodel.php");

class EmpresaModel{
	private function validar_cnpj($cnpj)
	{
		$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
		// Valida tamanho
		if (strlen($cnpj) != 14)
		  return false;
		// Valida primeiro dígito verificador
		for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++){
		  $soma += $cnpj{$i} * $j;
		  $j = ($j == 2) ? 9 : $j - 1;
		}

		$resto = $soma % 11;
		if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
		  return false;
		// Valida segundo dígito verificador
		for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++){
		  $soma += $cnpj{$i} * $j;
		  $j = ($j == 2) ? 9 : $j - 1;
		}

		$resto = $soma % 11;
		return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
	}


	public function login($email, $pass){

		if(empty($email) || empty($pass))
				return null;

		$con = new Database();
		$stmt = $con->prepare("SELECT us_id FROM usuario WHERE us_email = ? AND us_senha = ? and us_tipo = ?");

		$stmt->execute([$email, $pass, 'E']);

		return $stmt->fetch()[0];
	}

	public function getEmpresaFromUsId($id){
		$con = new Database();
		$stmt = $con->prepare("SELECT * FROM empresa WHERE us_id = ? AND emp_status_solicitacao = 'A'");
		$stmt->execute([$id]);

		return $stmt->fetch();

	}

	public function create($email, $senha, $confirmar, $nome, $cnpj, $razao, $inscricao, $telefone){

		$errors = array();

		if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
			$errors[] = "email";

		if(empty($senha))
			$errors[] = "senha";

		if($senha != $confirmar)
			$errors[] = "confirmar";

		if(empty($nome))
			$errors[] = "nome";

		if(empty($cnpj) || !$this->validar_cnpj($cnpj))
			$errors[] = "cnpj";

		if(empty($razao))
			$errors[] = "razao";

		$inscr = strlen(preg_replace("/[^0-9]/", "", $inscricao));

		if(empty($inscricao) || !is_numeric($inscr))
			$errors[] = "inscricao";

		$tel = strlen(preg_replace("/[^0-9]/", "", $telefone));

		if(empty($telefone) || !is_numeric($tel))
			$errors[] = "telefone";

		if(count($errors) > 0)
			return $errors;

		$con = new Database();

		try{
			$usuario = new UsuarioModel();
			$userId = $usuario->create($email, $senha, 'E');
		}catch(PDOException $exception){
			$errors[] = "user exists";
			return $errors;
		}

		try{
			
			$stmt = $con->prepare("INSERT INTO `empresa` (`emp_inscricao_estadual`, `emp_telefone`, `emp_nome_fantasia`, `emp_id`, `emp_razao_social`, `emp_cnpj`, `us_id`, `emp_status_solicitacao`) VALUES (?, ?, ?, NULL, ?, ?, ?, ?)");

			$stmt->execute([$inscricao, $telefone, $nome, $razao, $cnpj, $userId, 'P']);

			return $con->lastInsertId();

		}catch(PDOException $exception){
			$errors[] = "company exists";
			//TODO: Remove user
			return $errors;
		}


	}
}
?>