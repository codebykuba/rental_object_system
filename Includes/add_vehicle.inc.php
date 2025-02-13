<?php

require_once __DIR__ . "/../Classes/ConfigSession.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {

    //Pobranie typu pojazdu
    $vehicle_type = $_POST["type"];

    //Przekaż wybrany typ pojazdu do sesji, jesli on istnieje
    $session = new ConfigSession();

    //Jesli nie wybrano typu pojazdu, wroc do formularza i zakoncz dzialanie
    if($vehicle_type === "none") {

        //Przekaz do sesji komunikat o bledzie
        $error_message = "Wybierz typ pojazdu.";
        $_SESSION["error"] = $error_message;
        header("Location: ../admin_addvehicle.php");
        die();
    }

    //Dwie zmienne, bo view_type jest usuwany w pliku View i moze zaburzyc dzialanie
    $_SESSION["view_type"] = $vehicle_type;
    $_SESSION["type"] = $vehicle_type;

    //Zaleznie od wybranego typu, przenies na strone dodawania danego pojazdu
    switch($vehicle_type) {
        
        case "car":
            header("Location: ../addcar.php");
        break;
        case "motorcycle":
            header("Location: ../addmotorcycle.php");
        break;
        case "bike":
            header("Location: ../addbike.php");
        break;
    }
    
    die();
}
else {
    header("Location: ../admin_addvehicle.php");
    die();
}