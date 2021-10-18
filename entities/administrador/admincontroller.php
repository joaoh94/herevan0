<?php
	include('adminmodel.php');

	class AdminController{

		public function login($email, $pass){
			$admin = new AdminModel();
			return $admin->login($email, $pass); 
		}

		public function getUsuarioFromUsTipo($id){
			$admin = new AdminModel();
			return $admin->getUsuarioFromUsTipo($id); 

		}

	}


?>