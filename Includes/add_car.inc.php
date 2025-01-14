<?php

require_once "../Classes/ConfigSession.php";
require_once "../Classes/addVehicleClasses/AddVehicleContr.php";
require_once "../Classes/AddVehicleClasses/Car.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {

    //Przechwyc typ pojazdu z sesji
    $session = new ConfigSession();
    $vehicle_type = $_SESSION["type"];

        //Gdy typ pojazdu jest wybrany, pobieranie reszty danych
        $brand = $model = $color = $price = $body_type = $seats = $year = $vin = null;

        if(isset($vehicle_type) && $vehicle_type === "car") {
            $brand = $_POST["brand"];
            $model = $_POST["model"];
            $color = $_POST["color"];
            $price = $_POST["price"];

            //Zmienne unikatowe dla samochodu
            $body_type = $_POST["body_type"];
            $seats = $_POST["seats"];
            $year = $_POST["year"];
            $vin = $_POST["vin"];
        }

        //Obsluga formularza do dodawania samochodu
        $handle_form = new AddVehicleContr($vehicle_type, $brand, $model, $color, $price);
        $handle_form->setCarUniqueData($body_type, $seats, $year, $vin);
        $handle_form->chooseVehicle();      //Metoda chooseVehicle(), obsluguje formularz. Jesli wystapi jakis blad zatrzyma program.

        //Jesli metoda chooseVehicle() nie zatrzyma programu, przez wystapienie jakiegos bledu, utworzony zostaje obiekt car.
        //Nastepnie zostaje on dodany do bazy danych
        $car = new Car($vehicle_type, $brand, $model, $color, $price, $body_type, $seats, $year, $vin);
        $car->addVehicleToDatabase();
        
        $_SESSION["succes"] = true;

        //Wroc do strony dodawania pojazdow i zakoncz dzialanie
        header("Location: ../admin_addvehicle.php");
        unset($_SESSION["type"]);
        die();
}
else {
    header("Location: ../addcar.php");
    die();
}