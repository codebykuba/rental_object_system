<?php

class Dbh {

    private $db_host;
    private $db_name;
    private $db_username;
    private $db_password;
    private $connection;

    //Przypisanie danych ze srodowiska
    public function __construct() {

        //Zaladowanie composera
        require_once __DIR__ . '/../vendor/autoload.php';

        //Zaladowanie danych z pliku .env
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');     
        $dotenv->load();  

        $this->db_host = $_ENV["DATABASE_HOSTNAME"];
        $this->db_name = $_ENV["DATABASE_NAME"];
        $this->db_username = $_ENV["DATABASE_USERNAME"];
        $this->db_password = $_ENV["DATABASE_PASSWORD"];
    }

    //Polaczenie z baza danych
    protected function connect() {
    
        $dsn = "mysql:host=" . $this->db_host . ";dbname=" . $this->db_name;    //DSN

        try {
            $this->connection = new PDO($dsn, $this->db_username, $this->db_password);       //Polaczenie z baza danych
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);      //Atrybuty do obslugi bledow
            return $this->connection;                                                        //Zwraca PDO
        } 
        catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    //Koniec polaczenia z baza danych
    protected function disconnect() {
        $this->connection = null;
    }
}