<?php

class Database{
    private $host = 'localhost';
    private $username = 'u306747909_gym';
    private $password = '';
    private $database = 'u306747909_gym';
    protected $connection;

    function connect(){
        try 
			{
				$this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", 
											$this->username, $this->password);
			} 
			catch (PDOException $e) 
			{
				echo "Connection error " . $e->getMessage();
			}
        return $this->connection;
    }

}

?>
