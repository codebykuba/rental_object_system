<?php

require_once "Vehicle.php";

class Car extends Vehicle {

    private $body_type;
    private $seats;
    private $year;
    private $vin;

    public function __construct($vehicle_type, $brand, $model, $color, $price, $body_type, $seats, $year, $vin) {
        parent::__construct($vehicle_type, $brand, $model, $color, $price);
        $this->body_type = $body_type;
        $this->seats = $seats;
        $this->year = $year;
        $this->vin = strtoupper($vin);
    }
    
    //Spakowanie unikalnych zmiennych dla samochodu do tablicy
    public function getUniqueData() {
        $unique_data = [
            'body_type' => $this->body_type,
            'seats' => $this->seats,
        ];

        //VINu i rocznika nie przekazuje do tablicy pomimo tego, ze sa to zmienne unikalne dla samochodu
        //ze wzgledu na to, ze sa to bardziej istotne informacje i bedzia miec osobna kolumne w tabeli w bazie danych

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

    //Dodawanie samochodu do bazy danych
    public function addVehicleToDatabase() {

        $pdo = new Dbh();
        $connection = $pdo->connect();

        //Zapytanie do bazy danych
        $query = "INSERT INTO cars (vin, brand, model, year_of_production, price, details) 
                  VALUES (:vin, :brand, :model, :year_of_production, :price, :details);";

        //Przygotowanie zapytania i przypisanie danych do zapytania
        $stmt = $connection->prepare($query);
        $stmt->bindParam(":vin", $this->vin);
        $stmt->bindParam(":brand", $this->brand);
        $stmt->bindParam(":model", $this->model);
        $stmt->bindParam(":year_of_production", $this->year);
        $stmt->bindParam(":price", $this->price);
        
        $details = $this->uniqueDatatoJSON();
        $stmt->bindParam(":details", $details);

        //Wykonaj
        $stmt->execute();

        //Wyczyszczenie statementa i koniec połączenia z baza danych
        $stmt = NULL;
        $this->disconnect();
    } 
}