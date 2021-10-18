<?php
	include('motoristamodel.php');

	class MotoristaController{

		public function create($nome, $sobrenome, $nascimento, $cpf, $reg, $tipo_carteira, $validade, $sexo, $telefone, $email){

			$motorista = new MotoristaModel();
			return $motorista->create($nome, $sobrenome, $nascimento, $cpf, $reg, $tipo_carteira, $validade, $sexo, $telefone, $email);
		}

		public function update($id, $nome, $sobrenome, $nascimento, $cpf, $reg, $tipo_carteira, $validade, $sexo, $telefone, $email){

			$motorista = new MotoristaModel();
			return $motorista->update($id, $nome, $sobrenome, $nascimento, $cpf, $reg, $tipo_carteira, $validade, $sexo, $telefone, $email);

		}

		public function getMotoristaById($id){
			$motorista = new MotoristaModel();
			return $motorista->getMotoristaById($id);
		}

	}


?>