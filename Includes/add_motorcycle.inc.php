<?php

require_once "../Classes/ConfigSession.php";
require_once "../Classes/addVehicleClasses/AddVehicleContr.php";
require_once "../Classes/AddVehicleClasses/Motorcycle.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {

    //Przechwyc typ pojazdu z sesji
    $session = new ConfigSession();
    $vehicle_type = $_SESSION["type"];

        //Gdy typ pojazdu jest wybrany, pobieranie reszty danych
        $brand = $model = $color = $price = $year = $vin = $engine = $moto_type = null;

        if(isset($vehicle_type) && $vehicle_type === "motorcycle") {
            $brand = $_POST["brand"];   
            $model = $_POST["model"];
            $color = $_POST["color"];
            $price = $_POST["price"];

            //Zmienne unikatowe dla motocykla
            $year = $_POST["year"];
            $vin = $_POST["vin"];
            $engine = $_POST["engine"];
            $moto_type = $_POST["moto_type"];
        }

        //Obsluga formularza do dodawania motocykla
        $handle_form = new AddVehicleContr($vehicle_type, $brand, $model, $color, $price);
        $handle_form->setMotorcycleUniqueData($moto_type, $engine, $year, $vin);
        $handle_form->chooseVehicle();      //Metoda chooseVehicle(), obsluguje formularz. Jesli wystapi jakis blad zatrzyma program.

        //Jesli metoda chooseVehicle() nie zatrzyma programu, przez wystapienie jakiegos bledu, utworzony zostaje obiekt motorcycle.
        //Nastepnie zostaje on dodany do bazy danych
        $motorcycle = new Motorcycle($vehicle_type, $brand, $model, $color, $price, $year, $vin, $engine, $moto_type);
        $motorcycle->addVehicleToDatabase();
        
        $_SESSION["succes"] = true;

        //Wroc do strony dodawania pojazdow i zakoncz dzialanie
        header("Location: ../admin_addvehicle.php");
        unset($_SESSION["type"]);
        die();
}
else {
    header("Location: ../addmotorcycle.php");
    die();
}