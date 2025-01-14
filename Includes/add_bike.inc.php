<?php

require_once "../Classes/ConfigSession.php";
require_once "../Classes/addVehicleClasses/AddVehicleContr.php";
require_once "../Classes/AddVehicleClasses/Bike.php";

if($_SERVER["REQUEST_METHOD"] === "POST") {

    //Przechwyc typ pojazdu z sesji
    $session = new ConfigSession();
    $vehicle_type = $_SESSION["type"];

        //Gdy typ pojazdu jest wybrany, pobieranie reszty danych
        $brand = $model = $color = $price = $bike_type = $frame_size = $is_electric = $wheel_size = null;

        if(isset($vehicle_type) && $vehicle_type === "bike") {
            $brand = $_POST["brand"];   
            $model = $_POST["model"];
            $color = $_POST["color"];
            $price = $_POST["price"];

            //Zmienne unikatowe dla roweru
            $bike_type = $_POST["bike_type"];
            $frame_size = $_POST["frame_size"];
            $is_electric = $_POST["is_electric"];
            $wheel_size = $_POST["wheel_size"];
        }

        //Obsluga formularza do dodawania roweru
        $handle_form = new AddVehicleContr($vehicle_type, $brand, $model, $color, $price);
        $handle_form->setBikeUniqueData($bike_type, $frame_size, $is_electric, $wheel_size);
        $handle_form->showData();
        $handle_form->chooseVehicle();      //Metoda chooseVehicle(), obsluguje formularz. Jesli wystapi jakis blad zatrzyma program.

        //Jesli metoda chooseVehicle() nie zatrzyma programu, przez wystapienie jakiegos bledu, utworzony zostaje obiekt bike.
        //Nastepnie zostaje on dodany do bazy danych
        $bike = new Bike($vehicle_type, $brand, $model, $color, $price, $bike_type, $frame_size, $is_electric, $wheel_size);
        $bike->addVehicleToDatabase();
        
        $_SESSION["succes"] = true;

        //Wroc do strony dodawania pojazdow i zakoncz dzialanie
        header("Location: ../admin_addvehicle.php");
        unset($_SESSION["type"]);
        die();
}
else {
    header("Location: ../addbike.php");
    die();
}