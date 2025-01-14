<?php

require_once __DIR__ . "/../ConfigSession.php";

class LoginView {

    private $errors;

    public function __construct() {
        
        $session = new ConfigSession();
        
        //Przechwyc komunikaty o bledach z sesji, jesli istnieja
        if(isset($_SESSION["login_errors"])) {
            $this->errors = $_SESSION["login_errors"];
        }

        //Usuniecie danych sesyjnych po ich przechwyceniu
        unset($_SESSION["login_errors"]);
    }

    public function showErrors() {

        //Wyswietl bledy jesli wystapily
        if(isset($this->errors)) {

            echo "<br>";

            foreach($this->errors as $error) {
                echo "<p>$error</p>";
            }
        }
    }
}