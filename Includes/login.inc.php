<?php

//Podlaczenie potrzebnych klas
require_once "../Classes/Dbh.php";
require_once "../Classes/Login.php";
require_once "../Classes/LoginClasses/LoginContr.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {

    //Pobieranie danych od uzytkownika
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    try {
        //Obsluga bledow w formularzu
        $login_handler = new LoginContr($email, $pwd);
        $login_handler->handleLogin();

        //Zalogowanie uzytkownika jesli nie wystapily bledy (obsluga formularza zatrzyma dzialanie w przypadku bledow)
        $login_user = new Login($email, $pwd);
        $login_user->userLogin();

        //Wroc na strone glowna i zakoncz dzialanie
        header("Location: /rental_object_system/index.php");
        die();
    } 
    catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else {
    header("Location: ../login.php");
    die();
}