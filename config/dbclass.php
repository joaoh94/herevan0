<?php
class DBClass{
	private $host;
	private $username;
	private $password;
	private $database;

	public static $connection = null;

	public function __construct(){
		$host = "localhost";
		$username = "root";
		$password = "";
		$database = "bdb projeto";
		
		try{
			 $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);

            $this->connection->exec("set names utf8");
		}catch(PDOException $exception){
			echo "Error: ".$exception->getMessage();
		}
	}

	public static function getConnection(){
		if($connection == null){
			try{
				 $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);

	            $this->connection->exec("set names utf8");
			}catch(PDOException $exception){
				echo "Error: ".$exception->getMessage();
			}

		}

		return $this->connection;
	}

}

	

?>