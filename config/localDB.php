<?php
class Database{
    private $host;
    private $db_name;
    private $port;
    private $user;
    private $password;
    private $conn;

 public function __construct(){
    $this->user = 'postgres';
    $this->password ='root';
    $this->db_name = 'quotesdb';
    $this->host = 'localhost';
    $this->port = '5432';
 }
    public function connect(){
        $this->conn = null;
       try{
         
        $this->conn = new PDO('pgsql:host='. $this->host .';port='.$this->port .';dbname=' . $this->db_name, $this->user, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);      
        
       } catch(PDOException $e){
        echo 'Connection Failed!' . $e->GetMessage();
       }

       return $this->conn;
    }
}


?>