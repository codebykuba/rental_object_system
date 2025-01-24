<?php

require_once __DIR__ . "/../Signup.php";
require_once __DIR__ . "/../ConfigSession.php";

class SignupContr {

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

    //Obsluga formularza rejestracji
    public function handleSignup() {
        //Obsluga bledow
        
        //1. Puste pola
        if($this->areInputsEmpty()) {
            $errors["empty_inputs"] = "Wypełnij wszystkie pola.";
        }
        
        //2. Wpisano niepoprawny email
        if($this->isEmailInvalid() && !$this->areInputsEmpty()) {
            $errors["invalid_email"] = "Podany email jest niepoprawny.";
        }
        
        //3. Email jest juz zajety
        if($this->isEmailTaken()) {
            $errors["email_taken"] = "Wygląda na to, że masz już konto.";
        }
        
        //4. Haslo nie spelnia wymagan (min. 8 znakow i min. 1 cyfra)
        if($this->isPasswordIncorrect() && !$this->areInputsEmpty()) {
            $errors["incorrect_password"] = "Hasło nie spełnia wymagań.";
        }

            //Gdy bledy wystapily
            if(!empty($errors)) {

                //Rozpoczecie sesji i pobranie danych do zmiennych sesyjnych
                $session = new ConfigSession();
                $_SESSION["signup_errors"] = $errors;

                $_SESSION["signup_data"] = [

                    "email" => $this->email,
                    "first_name" => $this->first_name,
                    "last_name" => $this->last_name,
                    "newsletter" => $this->newsletter
                ];

                header("Location: /rental_object_system/signup.php");
                die();
            }
    }

    //1. Puste pola
    private function areInputsEmpty() {

        if(empty($this->email) || empty($this->pwd) || empty($this->first_name) || empty($this->last_name)) {
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

    //3. Email jest juz zajety
    private function isEmailTaken() {

        $signup = new Signup($this->email, "", "", "", 0);

        if($signup->checkForEmail()) {
            return true;
        }
        else {
            return false;
        }
    }

    //4. Haslo nie spelnia wymagan
    private function isPasswordIncorrect() {

        //Warunek dlugosci hasla
        if(strlen($this->pwd) < 8) {
            return true;
        }

        //Warunek min. jednej cyfry
        for($i=0; $i<strlen($this->pwd); $i++) {

            if(is_numeric($this->pwd[$i])) {
                return false;
            }
        }
        return true;
    }
}