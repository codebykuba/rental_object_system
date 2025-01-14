<?php

require_once __DIR__ . "/../ConfigSession.php";
require_once "ShowVehicle.php";

class ShowCars extends ShowVehicle {

    public function __construct($table_name) {
        parent::__construct($table_name);
    }

    protected function getVehicles() {

        //Polaczenie z baza danych
        $dbh = new Dbh();
        $connection = $dbh->connect();

        //Zapytanie do bazy danych
        $query = "SELECT brand, model, year_of_production, price, details FROM {$this->table_name} WHERE is_taken = 0;";

        //Przygotowanie zapytania i wykonanie go
        $stmt = $connection->prepare($query);
        $stmt->execute();

        //Zwroc wartosci pobrane z bazy danych
        $vehicles_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $vehicles_data;
    }

    //Zdekodowanie danych z kolumny 'details', ktora jest typem JSON
    protected function decodeJsonData() {

        $cars = $this->getVehicles();

        foreach($cars as $key => $car) {
            try {
                $cars[$key]['details'] = json_decode($car['details'], true, JSON_THROW_ON_ERROR);
            } catch (JsonException $e) {
                die($e->getMessage());
            }       
        }
        return $cars;
    }

    //Przeniesienie wszystkich danych o samochodach do sesji
    public function storeInSession() {

        $cars = $this->decodeJsonData();
        $_SESSION['cars'] = $cars;
    }
}