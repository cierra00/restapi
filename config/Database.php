<?php
class Database{
    private $host;
    private $db_name;
    private $port;
    private $user;
    private $password;
    private $conn;

 public function __construct(){
    $this->user = getenv('USERNAME');
    $this->password = getenv('PASSWORD');
    $this->db_name = getenv('DBNAME');
    $this->host = getenv('HOST');
    $this->port = getenv('PORT');
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