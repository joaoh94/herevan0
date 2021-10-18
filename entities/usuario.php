<?php
	include("../config/database.php");

	class Usuario{
		private $connection;
		private $table_name = "Empresa";

		//columns
		public $us_id;
		public $us_email;
		public $us_senha;
		public $us_tipo;

		/*public function __construct($connection){
			$this->connection = $connection;
		}*/

		public function __construct(){
			
		}

		public function test(){
			return "testing";
		}

		public function create(){
		}

		public function read(){
			$con = DBClass::getConnection();

			$query = "SELECT * FROM Usuario";

			$stmt = $con->prepare($query);
			$stmt->execute();

			return $stmt;
		}

		public function update(){
			return "updating...";
		}
	}


?>