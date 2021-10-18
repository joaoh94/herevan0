<?php
	include('empresamodel.php');

	class EmpresaController{

		public function login($email, $pass){
			$empresa = new EmpresaModel();
			return $empresa->login($email, $pass); 
		}

		public function getEmpresaFromUsId($id){
			$empresa = new EmpresaModel();
			return $empresa->getEmpresaFromUsId($id); 

		}

		public function create($email, $senha, $confirmar, $nome, $cnpj, $razao, $inscricao, $telefone){
			$empresa = new EmpresaModel();
			return $empresa->create($email, $senha, $confirmar, $nome, $cnpj, $razao, $inscricao, $telefone);
		}

	}


?>