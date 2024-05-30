<?php
class DbConnect {
    private $host = 'localhost';
    private $dbName = 'DevoirPhp'; 
    private $username = 'root'; 
    private $password = ''; 

   
    public function connect() {
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
            return null;
        }
    }
}
?>
