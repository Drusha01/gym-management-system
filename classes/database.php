<?php

class Database{
    private $host = 'localhost';
    private $username = 'u306747909_drusha';
    private $password = '+9m5B!c$I';
    private $database = 'u306747909_drusha';
    protected $connection;

    
    
    function connect(){
        try 
			{
				$this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8, time_zone = "+8:00";'));
                
			} 
			catch (PDOException $e) 
			{
				echo "Connection error " . $e->getMessage();
			}
        return $this->connection;
    }

    
}

?>
