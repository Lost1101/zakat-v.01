<?php
class database{
    private $host;
    private $user;
    private $pass;
    private $database;
    public $conn;

    function __construct($host, $user, $pass, $database) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;

        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->database) or die ("could not connect to mysql");
        if(!$this->conn){
            return false;
        } else {
            return true;
        }
    }
}

class connect{
    private $mysqli;

    function __construct($conn){
        $this->mysqli = $conn;
    }

    public function connect(){
        $db = $this->mysqli->conn;
        return $db;
    }
}
?>