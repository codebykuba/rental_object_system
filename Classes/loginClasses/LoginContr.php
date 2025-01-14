<?php

require_once "../Login.php";
require_once __DIR__ . "/../ConfigSession.php";

class LoginContr {

    private $email;
    private $pwd;

    public function __construct($email, $pwd) {
        $this->email = $email;
        $this->pwd = $pwd;
    }

    //Obsluga formularza
    public function handleLogin() {

        //1. Puste pola
        if($this->areInputsEmpty()) {
            $errors["empty_inputs"] = "Wypełnij wszystkie pola.";
        }

        //2. Czy podano prawidlowy email
        if($this->isEmailInvalid() && !$this->areInputsEmpty()) {
            $errors["invalid_email"] = "Email i/lub haslo są niepoprawne";
        }

        //3. Uzytkownik nie istnieje
        if(!$this->isEmailInvalid() && !$this->doesUserExist() && !$this->areInputsEmpty()) {
            $errors["user_doesnt_exist"] = "Email i/lub haslo są niepoprawne";
        }

        //4. Podano zle haslo (program sprawdza haslo tylko, gdy pola nie sa puste i uzytkownik istnieje)
        if(!$this->areInputsEmpty() && $this->doesUserExist() && !$this->isPasswordCorrect()) {
            $errors["incorrect_password"] = "Email i/lub haslo są niepoprawne";
        }

            if(!empty($errors)) {

                //Rozpoczecie sesji i pobranie danych do zmiennych sesyjnych
                $session = new ConfigSession();
                $_SESSION["login_errors"] = $errors;
                
                header("Location: /rental_object_system/login.php");
                die();
            }
    }

    //1. Puste pola
    private function areInputsEmpty() {
        
        if(empty($this->email) || empty($this->pwd)) {
            return true;
        }
        else {
            return false;
        }
    }

    //2. Niepoprawny email
    private function isEmailInvalid() {
        
        //Jesli email jest niepoprawny
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else {
            return false;
        }
    }

    //3. Pobierz dane uzytkownika.
    private function getUserData() {

        $checkForUser = new Login($this->email, "");
        $user_data = $checkForUser->checkForUser();
        
        return $user_data;  //Zwroci tablice z danymi lub false
    }
    
    //4. Uzytkownik nie istnieje
    private function doesUserExist() {

        if($this->getUserData()) {
            return true;
        }
        else {
            return false;
        }
    }

    //5. Podano zle haslo
    private function isPasswordCorrect() {

        $data = $this->getUserData();
        $hashed_pwd = $data["pwd"];     //Hash pobrany z bazy danych
        
        if(password_verify($this->pwd, $hashed_pwd)) {
            return true;                //Haslo sie zgadza
        }
        else {
            return false;               //Haslo sie nie zgadza
        }
    }
}