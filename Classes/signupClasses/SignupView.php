<?php

require_once __DIR__ . "/../ConfigSession.php";

class SignupView {

    private $errors;
    private $signup_data;

    public function __construct() {

        $session = new ConfigSession();

        //Przypisz zmienne sesyjne, tylko gdy istnieja
        if (isset($_SESSION["signup_errors"])) {
            $this->errors = $_SESSION["signup_errors"];
        }
        if (isset($_SESSION["signup_data"])) {    
            $this->signup_data = $_SESSION["signup_data"];
        }

        //Usuniecie danych sesyjnych po ich przechwyceniu
        unset($_SESSION["signup_errors"]);
        unset($_SESSION["signup_data"]);
    }

    public function showErrors() {

        //Wyswietl bledy jesli wystapily
        if(isset($this->errors)) {
        
            echo "<br>";

            foreach($this->errors as $error) {
                echo "<p>$error</p>";
            }
        }
        else if(isset($_GET["signup"]) && $_GET["signup"] === "succes") {
            echo "<br>";
            echo "Rejestracja powiodła się!";
        }
    }

    //Metoda zachowuje pola w przypadku wystapienia bledow (wyjatkiem jest haslo)
    public function saveInputs() {

        //Pole emaila
        if(isset($this->signup_data["email"])) {
            echo '<input type="text" id="email" name="email" placeholder="Adres e-mail" value="' . htmlspecialchars($this->signup_data["email"]) . '">';
        }
        else {
            echo '<input type="text" id="email" name="email" placeholder="Adres e-mail">';
        }

        //Pole hasla
        echo '<input type="password" id="pwd" name="pwd" placeholder="Hasło">';

        //Pole imienia
        if(isset($this->signup_data["first_name"])) {
            echo '<input type="text" id="first_name" name="first_name" placeholder="Imię" value="' . htmlspecialchars($this->signup_data["first_name"]) . '">';
        }
        else {
            echo '<input type="text" id="first_name" name="first_name" placeholder="Imię">';
        }

        //Pole nazwiska
        if(isset($this->signup_data["last_name"])) {
            echo '<input type="text" id="last_name" name="last_name" placeholder="Nazwisko" value="' . htmlspecialchars($this->signup_data["last_name"]) . '">';
        }
        else {
            echo '<input type="text" id="last_name" name="last_name" placeholder="Nazwisko">';
        }

        //Checkbox newslettera
        if(isset($this->signup_data["newsletter"]) && $this->signup_data["newsletter"] == 1) {
            echo '<input type="checkbox" id="newsletter" name="newsletter" checked>';
        }
        else {
            echo '<input type="checkbox" id="newsletter" name="newsletter">';
        }
    }
}