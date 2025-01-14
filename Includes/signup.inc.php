<?php

//Podlaczenie potrzebnych klas
require_once "../Classes/Dbh.php";
require_once "../Classes/Signup.php";
require_once "../Classes/signupClasses/SignupContr.php";
require_once "../Classes/Login.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {

    //Pobieranie danych od uzytkownika
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];

        if(isset($_POST["newsletter"])) {
            $newsletter = 1;
        }
        else {
            $newsletter = 0;
        }

    try {
        
        //Obsluga bledow w formularzu
        $signup_handler = new SignupContr($email, $pwd, $first_name, $last_name, $newsletter);
        $signup_handler->handleSignup();
 
        //Dodanie uzytkownika do bazy danych (handleSignup() zatrzyma kod w przypadku jakiegos bledu)
        $user = new Signup($email, $pwd, $first_name, $last_name, $newsletter);
        $user->insertUser();
    
        //Zaloguj uzytkownika po rejestracji
        $login_user = new Login($email, $pwd);
        $login_user->userLogin();

        //Wroc na strone glowna i zakoncz dzialanie
        header("Location: /rental_object_system/index.php?signup=succes");
        die();
    } 
    catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else {
    header("Location: ../signup.php");
    die();
}