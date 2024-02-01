<?php

class Database{
    private $host = 'localhost';
    // private $username = 'u904603351_drusha';
    // private $password = 'Uwat09hanz@2';
    // private $database = 'u904603351_drusha';
    private $username = 'root';
    private $password = '';
    private $database = 'gms';
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
