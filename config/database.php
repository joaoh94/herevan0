<?php
	class Database{
		private static $dbh = null;

		private $host;
		private $username;
		private $password;
		private $database;

	    function __construct() {
	        if ( is_null(self::$dbh) ) {
	        	$this->host = "localhost";
				$this->username = "root";
				$this->password = "";
				$this->database = "bdb projeto";

				$conString = "mysql:host=" . $this->host . ";dbname=" . $this->database;
				
				self::$dbh = new PDO($conString, $this->username, $this->password);	

				self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	        }
	    }

	    public function query($string){
	    	return self::$dbh->query($string);
	    }

	    public function errorInfo(){
	    	return self::$dbh->errorInfo();
	    }

	    public function prepare($string){
	    	return self::$dbh->prepare($string);
	    }

	    public function lastInsertId(){
	    	return self::$dbh->lastInsertId();
	    }

	}


?>