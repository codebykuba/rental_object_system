<?php

require_once "ConfigSession.php";

class Login extends Dbh {
    
    private $email;
    private $pwd;

    public function __construct($email, $pwd) {
        $this->email = $email;
        $this->pwd = $pwd;
    }

    public function checkForUser() {

        //Zapytanie do bazy danych
        $query = "SELECT * FROM users WHERE email = :email;";

        //Polaczenie z baza danych
        $pdo = new Dbh();
        $connection = $pdo->connect();
    
        //Przygotuj zapytanie
        $stmt = $connection->prepare($query);
        
        //Przypisz parametr i wykonaj
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        //Wyczysc statement i rozlacz z baza danych
        $stmt = null;
        $this->disconnect();

        return $result;     //Zwroci tablice z danymi lub wartosc false
    }

    public function userLogin() {
        
        //Rozpoczecie sesji, gdy nie jest aktywna
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        //Wygeneruj nowe id dla zalogowanego uzytkownika
        session_regenerate_id(true);
        
        //Zmien czas ostatniej regeneracji id
        $_SESSION["last_regeneration"] = time();

        $this->dataToSession();
    }

    private function dataToSession() {
        
        $result = $this->checkForUser();

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["email"] = $result["email"];
        $_SESSION["first_name"] = $result["first_name"];
        $_SESSION["last_name"] = $result["last_name"];
        $_SESSION["account_type"] = $result["account_type"];
    }
}