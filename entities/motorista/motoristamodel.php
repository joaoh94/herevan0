<?php
require_once($_SERVER['DOCUMENT_ROOT']."/herevan_proj/config/database.php");


class MotoristaModel{

	private function validar_cpf($cpf)
	{
		$cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
		// Valida tamanho
		if (strlen($cpf) != 11)
			return false;
		// Calcula e confere primeiro dígito verificador
		for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
			$soma += $cpf{$i} * $j;
		$resto = $soma % 11;
		if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
			return false;
		// Calcula e confere segundo dígito verificador
		for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
			$soma += $cpf{$i} * $j;
		$resto = $soma % 11;
		return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
	}

	private function inverteData($data)
	{
		if(count(explode("/",$data)) > 1){
			return implode("-",array_reverse(explode("/",$data)));
		}elseif(count(explode("-",$data)) > 1){
			return implode("/",array_reverse(explode("-",$data)));
		}
	}

	private function validar_cnh( $cnh ) {
		$ret = false;
		
		if ( is_string( $cnh ) ) {
			if ( ( strlen( $cnh = preg_replace( '/[^\d]/' , '' , $cnh ) ) == 11 ) && ( str_repeat( $cnh{ 1 } , 11 ) != $cnh ) ) {
				$dsc = 0;
		
				for ( $i = 0 , $j = 9 , $v = 0 ; $i < 9 ; ++$i , --$j )
					$v += (int) $cnh{ $i } * $j;
		
				if ( ( $vl1 = $v % 11 ) >= 10 ) {
					$vl1 = 0;
					$dsc = 2;
				}
		
				for ( $i = 0 , $j = 1 , $v = 0 ; $i < 9 ; ++$i , ++$j )
					$v += (int) $cnh{ $i } * $j;
		
				$vl2 = ( $x = ( $v % 11 ) ) >= 10 ? 0 : $x - $dsc;
				$ret = sprintf( '%d%d' , $vl1 , $vl2 ) == substr( $cnh , -2 );
			}
		}
		
		return $ret;
	}

	private function validate($nome, $sobrenome, $nascimento, $cpf, $reg, $tipo_carteira, $validade, $sexo, $telefone, $email){

		$errors = array();

		if(empty($nome))
			$errors[] = "nome";
		
		if(empty($sobrenome))
			$errors[] = "sobrenome";

		if(empty($nascimento))
			$errors[] = "nascimento";

		if(empty($cpf) || !$this->validar_cpf($cpf))
			$errors[] = "cpf";

		if(empty($reg) || !$this->validar_cnh($reg))
			$errors[] = "reg";

		if(empty($tipo_carteira))
			$errors[] = "tipo_carteira";

		if(empty($validade))
			$errors[] = "validade";

		if(empty($sexo))
			$errors[] = "sexo";

		$tel = strlen(preg_replace("/[^0-9]/", "", $telefone));

		if(empty($telefone) || !is_numeric($tel))
			$errors[] = "telefone";

		if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
			$errors[] = "email";

		if(empty($_SESSION['emp_id']))
			$errors[] = "empresa";

		return $errors;
	}

	public function create($nome, $sobrenome, $nascimento, $cpf, $reg, $tipo_carteira, $validade, $sexo, $telefone, $email){
		
		$errors = [];
		$errors = $this->validate($nome, $sobrenome, $nascimento, $cpf, $reg, $tipo_carteira, $validade, $sexo, $telefone, $email);


		if(count($errors) > 0)
			return $errors;

		$con = new Database();		

		try{
			$stmt = $con->prepare("INSERT INTO `motorista` (`mot_id`, `mot_nome`, `mot_sobrenome`, `mot_nasc`, `mot_cpf`, `mot_reg`, `mot_cartipo`, `mot_validade`, `mot_sexo`, `mot_telefone`, `mot_email`, `emp_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

			$nascimento = $this->inverteData($nascimento);
			$validade = $this->inverteData($validade);

			$stmt->execute([$nome, $sobrenome, $nascimento, $cpf, $reg, $tipo_carteira, $validade, $sexo, $telefone, $email, $_SESSION['emp_id']]);

		}catch(PDOException $exception){
			$errors[] = "driver exists";
			return $errors;
		}

	}

	public function update($id, $nome, $sobrenome, $nascimento, $cpf, $reg, $tipo_carteira, $validade, $sexo, $telefone, $email){

		$errors = [];
		$errors = $this->validate($nome, $sobrenome, $nascimento, $cpf, $reg, $tipo_carteira, $validade, $sexo, $telefone, $email);

		if(count($errors) > 0)
			return $errors;

		$con = new Database();

		try{
			$stmt = $con->prepare("UPDATE `motorista` SET `mot_nome` = ?, `mot_sobrenome` = ?, `mot_nasc` = ?, `mot_cpf` = ?, `mot_reg` = ?, `mot_cartipo` = ?, `mot_validade` = ?, `mot_sexo` = ?, `mot_telefone` = ?, `mot_email` = ? WHERE `motorista`.`mot_id` = ?;");

			$stmt->execute([$nome, $sobrenome, $nascimento, $cpf, $reg, $tipo_carteira, $validade, $sexo, $telefone, $email, $id]);




		}catch(PDOException $exception){
			$errors[] = "driver exists";
			return $errors;
		}
	}

	public function getMotoristaById($id){
		$con = new Database();

		$stmt = $con->prepare("SELECT * FROM Motorista WHERE mot_id = ?");
		
		$stmt->execute([$id]);

		return $stmt->fetch();
	}

}
?>