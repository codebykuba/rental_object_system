<?php

class AddVehicleContr {

    //Tablica na bledy
    private $errors;

    //Parametry wspolne pojazdow
    private $vehicle_type;
    private $brand;
    private $model;
    private $color;
    private $price;

    //Unikalne parametry samochodu
    private $body_type = null;
    private $seats = null;
    
    //Dodatkowe wspolne parametry dla motocykla i samochodu
    private $year = null;
    private $vin = null;

    //Unikalne parametry motocykla
    private $engine = null;
    private $moto_type = null;

    //Unikalne parametry dla roweru
    private $bike_type = null;
    private $frame_size = null;
    private $is_electric = null;
    private $wheel_size = null;

    public function __construct($vehicle_type, $brand, $model, $color, $price) {
        $this->vehicle_type = $vehicle_type;
        $this->brand = $brand;
        $this->model = $model;
        $this->color = $color;
        $this->price = $price;
    }

    public function setCarUniqueData($body_type, $seats, $year, $vin){
        $this->body_type = $body_type;
        $this->seats = $seats;
        $this->year = $year;
        $this->vin = strtoupper($vin);
    }

    public function setMotorcycleUniqueData($moto_type, $engine, $year, $vin) {
        $this->moto_type = $moto_type;
        $this->engine = $engine;
        $this->year = $year;
        $this->vin = strtoupper($vin);
    }

    public function setBikeUniqueData($bike_type, $frame_size, $is_electric, $wheel_size) {
        $this->bike_type = $bike_type;
        $this->frame_size = $frame_size;
        $this->is_electric = $is_electric;
        $this->wheel_size = str_replace(',', '.', $wheel_size);
    } 

    //Metoda pomocnicza, potem mozna usunac
    public function showData() {
        echo $this->vehicle_type;
        echo $this->brand;
        echo $this->model;
        echo $this->color;
        echo $this->price;
        echo $this->bike_type;
        echo $this->frame_size;
        echo $this->is_electric;
        echo $this->wheel_size;
    }

    public function chooseVehicle() {

        //W zaleznosci od typu pojazdu wybierz obsluge formularza
        switch($this->vehicle_type) {
            case "car":
                $this->handleCar();
            break;
            case "motorcycle":
                $this->handleMotorcycle();
            break;
            case "bike":
                $this->handleBike();
            break;
        }
    }

    //Obsluga formularza samochodu
    private function handleCar() {

        //1. Puste pola
        if($this->areCarInputsEmpty()) {
            $this->errors["empty_inputs"] = "Wypełnij wszystkie pola.";
        }

        //2. Niepoprawna cena
        if($this->isPriceInorrect() && !empty($this->price)) {
            $this->errors["incorrect_price"] = "Podaj poprawną cenę.";
        }

        //3. Wpisano za długie teksty
        if($this->stringsTooLong()) {
            $this->errors["too_long"] = "Podaj wartości krótsze niż 50 znaków.";
        }

        //4. Niepoprawny rocznik
        if($this->isYearIncorrect() && !empty($this->year)) {
            $this->errors["incorrect_year"] = "Podaj poprawny rok produkcji.";
        }

        //5. Niepoprawna ilosc miejsc
        if($this->isSeatsIncorrect() && !empty($this->seats)) {
            $this->errors["incorrect_seats"] = "Podaj poprawną ilość miejsc.";
        }

        //6. Weryfikacja VINu pojazdu
        $this->verifyVinNumber();

            //Pobranie komunikatow o bledach do tablicy sesyjnej
            $_SESSION["addVehicle_errors"] = $this->errors;

            //Przeslanie danych o pojezdzie do sesji, w celu zachowania pol w przypadku bledu
            //oraz do wyswietlenia komunikatu, gdy wszystko przebiegnie pomyslnie
            $car_data = [
                'vehicle_type' => $this->vehicle_type,
                'brand' => $this->brand,
                'model' => $this->model,
                'color' => $this->color,
                'price' => $this->price,
                'body_type'=> $this->body_type,
                'seats'=> $this->seats,
                'year'=> $this->year,
                'vin' => $this->vin,
            ];

            $_SESSION["car_data"] = $car_data;

            if(!empty($this->errors)) {
                
                header("Location: ../addcar.php");
                die();
            }
    }

    //Obsluga formularza Motocykla
    private function handleMotorcycle() {

        //7. Puste pola
        if($this->areMotorcycleInputsEmpty()) {
            $this->errors["empty_inputs"] = "Wypełnij wszystkie pola.";
        }

        //2. Niepoprawna cena
        if($this->isPriceInorrect() && !empty($this->price)) {
            $this->errors["incorrect_price"] = "Podaj poprawną cenę.";
        }

        //3. Wpisano za długie teksty
        if($this->stringsTooLong()) {
            $this->errors["too_long"] = "Podaj wartości krótsze niż 50 znaków.";
        }

        //4. Niepoprawny rocznik
        if($this->isYearIncorrect() && !empty($this->year)) {
            $this->errors["incorrect_year"] = "Podaj poprawny rok produkcji.";
        }

        //8. Niepoprawna pojemnosc silnika
        if($this->isCcIncorrect() && !empty($this->engine)) {
            $this->errors["incorrect_engine"] = "Podaj poprawną pojemność silnika.";
        }

        //6. Weryfikacja VINu pojazdu
        $this->verifyVinNumber();

            //Pobranie komunikatow o bledach do tablicy sesyjnej
            $_SESSION["addVehicle_errors"] = $this->errors;

            //Przeslanie danych o pojezdzie do sesji, w celu zachowania pol w przypadku bledu
            //oraz do wyswietlenia komunikatu, gdy wszystko przebiegnie pomyslnie
            $moto_data = [
                'vehicle_type' => $this->vehicle_type,
                'brand' => $this->brand,
                'model' => $this->model,
                'color' => $this->color,
                'price' => $this->price,
                'moto_type'=> $this->moto_type,
                'engine'=> $this->engine,
                'year'=> $this->year,
                'vin' => $this->vin,
            ];

            $_SESSION["moto_data"] = $moto_data;

            if(!empty($this->errors)) {
                
                header("Location: ../addmotorcycle.php");
                die();
            }
    }

    //Obsluga formularza Roweru
    private function handleBike() {

        //9. Puste pola 
        if($this->areBikeInputsEmpty()) {
            $this->errors["empty_inputs"] = "Wypełnij wszystkie pola.";
        }

        //10. Nie wybrano opcji
        if($this->isElectricNotSelected()) {
            $this->errors["is_electric_not_selected"] = "Nie wybrano opcji, czy rower jest elektryczny.";
        }

        //2. Niepoprawna cena
        if($this->isPriceInorrect() && !empty($this->price)) {
            $this->errors["incorrect_price"] = "Podaj poprawną cenę.";
        }

        //3. Wpisano za długie teksty
        if($this->stringsTooLong()) {
            $this->errors["too_long"] = "Podaj wartości krótsze niż 50 znaków.";
        }

        //11. Niepoprawny rozmiar kola
        if($this->isWheelSizeIncorrect() && !empty($this->wheel_size)) {
            $this->errors["incorrect_wheel_size"] = "Podaj poprawny rozmiar koła (sama liczba).";
        }

            //Pobranie komunikatow o bledach do tablicy sesyjnej
            $_SESSION["addVehicle_errors"] = $this->errors;

            //Przeslanie danych o pojezdzie do sesji, w celu zachowania pol w przypadku bledu
            //oraz do wyswietlenia komunikatu, gdy wszystko przebiegnie pomyslnie
            $bike_data = [
                'vehicle_type' => $this->vehicle_type,
                'brand' => $this->brand,
                'model' => $this->model,
                'color' => $this->color,
                'price' => $this->price,
                'bike_type'=> $this->bike_type,
                'frame_size'=> $this->frame_size,
                'is_electric'=> $this->is_electric,
                'wheel_size' => $this->wheel_size,
            ];

            $_SESSION["bike_data"] = $bike_data;

            if(!empty($this->errors)) {
                
                header("Location: ../addbike.php");
                die();
            }
    }

    //1. Puste pola (samochod)
    private function areCarInputsEmpty() {
        
        if(empty($this->brand) || empty($this->model) || empty($this->color) || empty($this->price)
        || empty($this->body_type) || empty($this->seats) || empty($this->year) || empty($this->vin)) {
            
            return true;
        }
        else {
            return false;
        }
    }

    //2. Niepoprawna cena
    private function isPriceInorrect() {

        if(!is_numeric($this->price) || ($this->price)< 0 || $this->price > 100000) {
            return true;
        }        
        else {
            return false;
        }
    }

    //3. Wpisano za długie teksty
    private function stringsTooLong() {

        if(strlen($this->brand) > 50 || strlen($this->model) > 50 || strlen($this->color) > 50 || strlen($this->body_type) > 50 
        || strlen($this->moto_type) > 50 || strlen($this->bike_type) > 50 || strlen($this->frame_size) > 50) {
            return true;
        }
        else {
            return false;
        }
    }

    //4. Niepoprawny rocznik samochodu 
    private function isYearIncorrect() {

        if(!is_numeric($this->year) || $this->year == 0 || $this->year < 0) {
            return true;
        }
        else {
            return false;
        }
    }

    //5. Niepoprawna ilosc miejsc
    private function isSeatsIncorrect() {
        
        if(!is_numeric($this->seats) || $this->seats <= 0 || $this->seats > 100) {
            return true;
        }
        else {
            return false;
        }
    }

    //6. Weryfikacja numery VIN
    private function verifyVinNumber() {
        
        //1. Dlugosc numeru vin
        if(strlen($this->vin) !== 17 && strlen($this->vin) !== 0) {
            $this->errors["wrong_vin_length"] = "Numer VIN musi mieć dokładnie 17 znaków.";
            $this->errors["vin_length"] = "Liczba znaków w podanym VINie: " . strlen($this->vin);
        }

        //2. Sprawdzenie czy w VINie sa tylko litery i cyfry
        if(!ctype_alnum($this->vin) && strlen($this->vin) !== 0) {
            $this->errors["vin_not_alphanumeric"] = "Numer VIN musi składać się tylko z liter i cyfr.";
        }

        //3. Sprawdzenie czy w VINie są niedozwolone litery (I, O, Q)
        $invalid_letters = ['I', 'O', 'Q'];

        for($i=0; $i<strlen($this->vin); $i++) {

            if(in_array($this->vin[$i], $invalid_letters)) {

                $this->errors["invalid_vin_char"] = "Numer VIN nie może zawierać liter 'I', 'O' oraz 'Q'";
                break;
            }
        }
    }

    //7. Puste pola (motocykl)
    private function areMotorcycleInputsEmpty() {
        
        if(empty($this->brand) || empty($this->model) || empty($this->color) || empty($this->price)
        || empty($this->moto_type) || empty($this->engine) || empty($this->year) || empty($this->vin)) {
            
            return true;
        }
        else {
            return false;
        }
    }

    //8. Niepoprawna pojemnosc silnika
    private function isCcIncorrect() {

        if(!is_numeric($this->engine) || $this->engine <= 0 || $this->engine > 8000) {
            return true;
        }
        else {
            return false;
        }
    }

    //9. Puste pola (rower)
    private function areBikeInputsEmpty() {

        if(empty($this->brand) || empty($this->model) || empty($this->color) || empty($this->price)
        || empty($this->bike_type) || empty($this->frame_size) || empty($this->is_electric) || empty($this->wheel_size)) {

            return true;
        }
        else {
            return false;
        }
    }

    //10. Nie wybrano opcji
    private function isElectricNotSelected() {

        if($this->is_electric == "none") {
            return true;
        }
        else {
            return false;
        }
    }

    //11. Niepoprawny rozmiar kola
    private function isWheelSizeIncorrect() {

        if(!is_numeric($this->wheel_size) || $this->wheel_size <= 0 || $this->wheel_size > 50) {
            return true;
        }
        else {
            return false;
        }
    }
}