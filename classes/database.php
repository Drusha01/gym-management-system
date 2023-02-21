<?php

class Database{
    private $host = 'localhost';
    private $username = 'u306747909_drusha';
    private $password = 'Uwat09hanz';
    private $database = 'u306747909_drusha';
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
