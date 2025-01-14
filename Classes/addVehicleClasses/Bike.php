<?php

require_once "Vehicle.php";

class Bike extends Vehicle {

    private $bike_type; 
    private $frame_size;
    private $is_electric;
    private $wheel_size;

    public function __construct($vehicle_type, $brand, $model, $color, $price, $bike_type, $frame_size, $is_electric, $wheel_size) {
        parent::__construct($vehicle_type, $brand, $model, $color, $price);
        $this->bike_type = $bike_type;
        $this->frame_size = $frame_size;
        $this->is_electric = $is_electric;
        $this->wheel_size = str_replace(',', '.', $wheel_size);
    }

    //Spakowanie unikalnych zmiennych dla roweru do tablicy
    public function getUniqueData() {

        $unique_data = [
            'frame_size' => $this->frame_size,
            'wheel_size' => $this->wheel_size,
            'color' => $this->color
        ];

        //Typ roweru oraz to czy jest elektryczny, chce przechowac w osobnych kolumnach, dlatego
        //nie dodaje tych zmiennych do tablicy.

        return $unique_data;
    }

    //Spakowanie unikalnych zmiennych do pliku JSON
    public function uniqueDatatoJSON() {
    
        $data_to_json = $this->getUniqueData();

        try {
            $jsoned_data = json_encode($data_to_json, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            die($e->getMessage());
        }
    
        return $jsoned_data;
    }

    //Dodawanie nowego roweru do bazy danych
    public function addVehicleToDatabase() {

        $pdo = new Dbh();
        $connection = $pdo->connect();

        //Zapytanie do bazy danych
        $query = "INSERT INTO bikes (brand, model, bike_type, is_electric, price, details) 
                  VALUES (:brand, :model, :bike_type, :is_electric, :price, :details);";
        
        //Przygotowanie zapytania i przypisanie danych do zapytania
        $stmt = $connection->prepare($query);
        $stmt->bindParam(":brand", $this->brand);
        $stmt->bindParam(":model", $this->model);
        $stmt->bindParam(":bike_type", $this->bike_type);
        $stmt->bindParam(":is_electric", $this->is_electric);
        $stmt->bindParam(":price", $this->price);

        $details = $this->uniqueDatatoJSON();
        $stmt->bindParam(":details", $details);

        //Wykonaj
        $stmt->execute();

        //Wyczyszczenie statementa i koniec połączenia z baza danych
        $stmt = null;
        $this->disconnect();
    }
}