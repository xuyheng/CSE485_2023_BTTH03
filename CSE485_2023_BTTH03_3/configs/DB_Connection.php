<?php

class DB_Connection
{
    private $conn=null;

    public function __construct()
    {
         // B1. Kết nối DB Server
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=csebtth03;port=3306', 'root', '');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
    
}
