<?php

class Signup extends Dbh {

    //Informacje pobrane od uzytkownika
    private $email;
    private $pwd;
    private $first_name;
    private $last_name;
    private $newsletter;

    public function __construct($email, $pwd, $first_name, $last_name, $newsletter) {
        $this->email = $email;
        $this->pwd = $pwd;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->newsletter = $newsletter;
    }

    //Dodawanie uzytkownika do bazy danych
    public function insertUser() {

        //Zapytanie do bazy danych
        $query = "INSERT INTO users (email, pwd, first_name, last_name, newsletter) VALUES (:email, :pwd, :first_name, :last_name, :newsletter);";
        
        //Polacz sie z baza danych
        $pdo = new Dbh();
        $connection = $pdo->connect();
        
        //Przygotuj zapytanie
        $stmt = $connection->prepare($query);
        
        //Hashownie hasla
        $options = [
            'cost' => 12
        ];

        $hashed_pwd = password_hash($this->pwd, PASSWORD_BCRYPT, $options);

        //Przypisanie parametrow do zapytania
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":pwd", $hashed_pwd);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":newsletter", $this->newsletter);

        //Wykonaj
        $stmt->execute();

        //Wyczyszczenie statementa
        $stmt = null;

        //Zakoncz polaczenie z baza danych
        $this->disconnect();
    }

    public function checkForEmail() {

        //Zapytanie do bazy danych
        $query = "SELECT * FROM users WHERE email = :email;";

        //Polacz sie z baza danych
        $pdo = new Dbh();
        $connection = $pdo->connect();

        //Przygotuj i wykonaj zapytanie
        $stmt = $connection->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //Wyczyszczenie statementa
        $stmt = null;

        //Zakoncz polaczenie z baza danych
        $this->disconnect();

        return $result;
    }
}