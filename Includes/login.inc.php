<?php

//Podlaczenie potrzebnych klas
require_once __DIR__ . "/../Classes/Dbh.php";
require_once __DIR__ . "/../Classes/ConfigSession.php";
require_once __DIR__ . "/../Classes/Login.php";
require_once __DIR__ . "/../Classes/loginClasses/LoginContr.php";

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
        $session = new ConfigSession();
        $main_directory = $_SESSION["main_dir"];

        header("Location: $main_directory/index.php");
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