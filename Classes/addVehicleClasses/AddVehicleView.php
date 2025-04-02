<?php

require_once __DIR__ . "/../ConfigSession.php";

class AddVehicleView {

    private $error;
    private $selected_type;
    private $add_vehicle_errors;
    private $car_data;
    private $moto_data;
    private $bike_data;

    public function __construct() {

        //Przechwyc dane z sesji jesli istnieja, a nastepnie je usun.
        if(isset($_SESSION["error"])) {
            $this->error = $_SESSION["error"];
            unset($_SESSION["error"]);
        }

        if(isset($_SESSION["view_type"])) {
            $this->selected_type = $_SESSION["view_type"];
            unset($_SESSION["view_type"]);
        }

        if(isset($_SESSION["addVehicle_errors"])) {
            $this->add_vehicle_errors = $_SESSION["addVehicle_errors"];
            unset($_SESSION["addVehicle_errors"]);
        }

        if(isset($_SESSION["car_data"])) {
            $this->car_data = $_SESSION["car_data"];
            unset($_SESSION["car_data"]);
        }

        if(isset($_SESSION["moto_data"])) {
            $this->moto_data = $_SESSION["moto_data"];
            unset($_SESSION["moto_data"]);
        }

        if(isset($_SESSION["bike_data"])) {
            $this->bike_data = $_SESSION["bike_data"];
            unset($_SESSION["bike_data"]);
        }
    }

    public function showError() {
        if(isset($this->error)) {
            echo "<p>{$this->error}</p>";
        }
    }

    public function showErrors() {
        if(isset($this->add_vehicle_errors)) {
            
            foreach($this->add_vehicle_errors as $error) {
                echo "<p>$error</p>";
            }
        }
    }

    public function showVehicleInputs() {
        if(isset($this->selected_type)) {

            switch($this->selected_type) {
                case "car":
                    $this->showCarInputs();
                break;

                default:
                    echo "<p>Something went wrong.</p>";
            }
        }
    }

    public function showCarInputs() {

        echo '<p>Wybrano typ: samochód</p>';
            
        //Pole marki samochodu
        echo '<label for="brand">Marka pojazdu: </label>';

        if(isset($this->car_data['brand']) && !isset($this->add_vehicle_errors["too_long"])) {
            echo '<input type="text" id= "brand" name="brand" placeholder="Marka pojazdu..." value="' . htmlspecialchars($this->car_data['brand']) . '">';
        }
        else {
            echo '<input type="text" id= "brand" name="brand" placeholder="Marka pojazdu...">';
        }

        //Pole modelu samochodu
        echo '<label for="model">Model samochodu: </label>';

        if(isset($this->car_data['model']) && !isset($this->add_vehicle_errors["too_long"])) {
            echo '<input type="text" id="model" name="model" placeholder="Model samochodu..." value="' . htmlspecialchars($this->car_data['model']) . '">';
        }
        else {
            echo '<input type="text" id="model" name="model" placeholder="Model samochodu...">';
        }

        //Pole VINu
        echo '<label for="vin">Numer VIN: </label>';

        if(isset($this->car_data['vin'])) {
            echo '<input type="text" id="vin" name="vin" placeholder="Numer VIN..." value="' . htmlspecialchars($this->car_data['vin']) . '">';
        }
        else {
            echo '<input type="text" id="vin" name="vin" placeholder="Numer VIN...">';
        }
            
        //Pole koloru samochodu
        echo '<label for="color">Kolor nadwozia: </label>';

        if(isset($this->car_data['model'])&& !isset($this->add_vehicle_errors["too_long"])) {
            echo '<input type="text" id="color" name="color" placeholder="Kolor nadwozia..." value="' . htmlspecialchars($this->car_data['color']) . '">';
        }
        else {
            echo '<input type="text" id="color" name="color" placeholder="Kolor nadwozia...">';
        }

        //Pole typu nadwozia
        echo '<label for="body_type">Typ nadwozia: </label>';

        if(isset($this->car_data['body_type']) && !isset($this->add_vehicle_errors["too_long"])) {
            echo '<input type="text" id="body_type" name="body_type" placeholder="Typ nadwozia..." value="' . htmlspecialchars($this->car_data['body_type']) . '">';
        }
        else {
            echo '<input type="text" id="body_type" name="body_type" placeholder="Typ nadwozia...">';
        }

        //Pole ilosci miejsc
        echo '<label for="body_type">Ilosc miejsc w samochodzie: </label>';

        if(isset($this->car_data['seats']) && !isset($this->add_vehicle_errors["incorrect_seats"])) {
            echo '<input type="text" id="seats" name="seats" placeholder="Ilosc miejsc..." value="' . htmlspecialchars($this->car_data['seats']) . '">';
        }
        else {
            echo '<input type="text" id="seats" name="seats" placeholder="Ilość miejsc...">';
        }

        //Pole rocznika
        echo '<label for="body_type">Rok produkcji samochodu: </label>';

        if(isset($this->car_data['year']) && !isset($this->add_vehicle_errors["incorrect_year"])) {
            echo '<input type="text" id="year" name="year" placeholder="Rok produkcji..." value="' . htmlspecialchars($this->car_data['year']) . '">';
        }
        else {
            echo '<input type="text" id="year" name="year" placeholder="Rok produkcji...">';
        }

        //Pole ceny za dzien wynajmu
        echo '<label for="price">Cena za dzień wynajmu (PLN): </label>';

        if(isset($this->car_data['model']) && !isset($this->add_vehicle_errors["incorrect_price"])) {
            echo '<input type="text" id="price" name="price" placeholder="Cena za dzień..." value="' . htmlspecialchars($this->car_data['price']) . '">';
        }
        else {
            echo '<input type="text" id="price" name="price" placeholder="Cena za dzień...">';
        }

        $this->showButtons();
    }

    public function showMotocycleInputs() {

        echo '<p>Wybrano typ: motocykl</p>';
            
        //Pole marki motocykla
        echo '<label for="brand">Marka pojazdu: </label>';

        if(isset($this->moto_data['brand']) && !isset($this->add_vehicle_errors["too_long"])) {
            echo '<input type="text" id="brand" name="brand" placeholder="Marka pojazdu..." value="' . htmlspecialchars($this->moto_data['brand']) . '">';
        }
        else {
            echo '<input type="text" id="brand" name="brand" placeholder="Marka pojazdu...">';
        }

        //Pole modelu motocykla
        echo '<label for="model">Model motocykla: </label>';

        if(isset($this->moto_data['model']) && !isset($this->add_vehicle_errors["too_long"])) {
            echo '<input type="text" id="model" name="model" placeholder="Model motocykla..." value="' . htmlspecialchars($this->moto_data['model']) . '">';
        }
        else {
            echo '<input type="text" id="model" name="model" placeholder="Model motocykla...">';
        }

        //Pole VINu
        echo '<label for="vin">Numer VIN: </label>';

        if(isset($this->moto_data['vin'])) {
            echo '<input type="text" id="vin" name="vin" placeholder="Numer VIN..." value="' . htmlspecialchars($this->moto_data['vin']) . '">';
        }
        else {
            echo '<input type="text" id="vin" name="vin" placeholder="Numer VIN...">';
        }
           
        //Pole rocznika
        echo '<label for="year">Rok produkcji: </label>';

        if(isset($this->moto_data['year']) && !isset($this->add_vehicle_errors["incorrect_year"])) {
            echo '<input type="text" id="year" name="year" placeholder="Rok produkcji..." value="' . htmlspecialchars($this->moto_data['year']) . '">';
        }
        else {
            echo '<input type="text" id="year" name="year" placeholder="Rok produkcji...">';
        }

        //Pole pojemnosci silnika
        echo '<label for="engine">Pojemność silnika (cc): </label>';

        if(isset($this->moto_data['engine']) && !isset($this->add_vehicle_errors["incorrect_engine"])) {
            echo '<input type="text" id="engine" name="engine" placeholder="Pojemność silnika..." value="' . htmlspecialchars($this->moto_data['engine']) . '">';
        }
        else {
            echo '<input type="text" id="engine" name="engine" placeholder="Pojemność silnika...">';
        }

        //Pole typu motocykla
        echo '<label for="moto_type">Typ motocykla: </label>';

        if(isset($this->moto_data['moto_type']) && !isset($this->add_vehicle_errors["too_long"])) {
            echo '<input type="text" id="moto_type" name="moto_type" placeholder="Typ motocykla..." value="' . htmlspecialchars($this->moto_data['moto_type']) . '">';
        }
        else {
            echo '<input type="text" id="moto_type" name="moto_type" placeholder="Typ motocykla...">';
        }

        //Pole koloru motocykla
        echo '<label for="color">Kolor motocykla: </label>';

        if(isset($this->moto_data['color']) && !isset($this->add_vehicle_errors["too_long"])) {
            echo '<input type="text" id="color" name="color" placeholder="Kolor motocykla..." value="' . htmlspecialchars($this->moto_data['color']) . '">';
        }
        else {
            echo '<input type="text" id="color" name="color" placeholder="Kolor motocykla...">';
        }

        //Pole ceny za dzien wynajmu
        echo '<label for="price">Cena za dzień wynajmu (PLN): </label>';

        if(isset($this->moto_data['model']) && !isset($this->add_vehicle_errors["incorrect_price"])) {
            echo '<input type="text" id="price" name="price" placeholder="Cena za dzień..." value="' . htmlspecialchars($this->moto_data['price']) . '">';
        }
        else {
            echo '<input type="text" id="price" name="price" placeholder="Cena za dzień...">';
        }

        $this->showButtons();
    }

    public function showBikeInputs() {

        echo '<p>Wybrano typ: rower</p>';
            
        //Pole marki roweru
        echo '<label for="brand">Marka pojazdu: </label>';

        if(isset($this->bike_data['brand']) && !isset($this->add_vehicle_errors["too_long"])) {
            echo '<input type="text" id= "brand" name="brand" placeholder="Marka pojazdu..." value="' . htmlspecialchars($this->bike_data['brand']) . '">';
        }
        else {
            echo '<input type="text" id= "brand" name="brand" placeholder="Marka pojazdu...">';
        }

        //Pole modelu roweru
        echo '<label for="model">Model roweru: </label>';

        if(isset($this->bike_data['model']) && !isset($this->add_vehicle_errors["too_long"])) {
            echo '<input type="text" id="model" name="model" placeholder="Model roweru..." value="' . htmlspecialchars($this->bike_data['model']) . '">';
        }
        else {
            echo '<input type="text" id="model" name="model" placeholder="Model roweru...">';
        }

        //Pole typu roweru
        echo '<label for="bike_type">Typ roweru: </label>';

        if(isset($this->bike_data['bike_type']) && !isset($this->add_vehicle_errors["too_long"])) {
            echo '<input type="text" id="bike_type" name="bike_type" placeholder="Typ roweru..." value="' . htmlspecialchars($this->bike_data['bike_type']) . '">';
        }
        else {
            echo '<input type="text" id="bike_type" name="bike_type" placeholder="Typ roweru...">';
        }

        //Pole rozmiaru ramy
        echo '<label for="frame_size">Rozmiar ramy: </label>';

        if(isset($this->bike_data['frame_size'])) {
            echo '<input type="text" id="frame_size" name="frame_size" placeholder="Rozmiar ramy..." value="' . htmlspecialchars($this->bike_data['frame_size']) . '">';
        }
        else {
            echo '<input type="text" id="frame_size" name="frame_size" placeholder="Rozmiar ramy...">';
        }
            
        //Czy rower jest elektryczny
        echo '<label for="is_electric">Rower jest elektryczny? </label>';

        if(isset($this->bike_data['is_electric']) && $this->bike_data['is_electric'] != 'none') {
            
            //Zapis wybranej opcji
            switch($this->bike_data['is_electric']) {
                case "yes":
                        echo '<select id="is_electric" name="is_electric">
                                <option value="none">Wybierz opcję...</option>
                                <option value="yes" selected>TAK</option>
                                <option value="no">NIE</option>
                              </select>';
                break;
                case "no":
                        echo '<select id="is_electric" name="is_electric">
                                <option value="none">Wybierz opcję...</option>
                                <option value="yes">TAK</option>
                                <option value="no" selected>NIE</option>
                              </select>';
                break;
            }
        }
        else {
            echo '<select id="is_electric" name="is_electric">
                    <option value="none">Wybierz opcję...</option>
                    <option value="yes">TAK</option>
                    <option value="no">NIE</option>
                  </select>';
        }

        //Pole rozmiaru kola
        echo '<label for="wheel_size">Rozmiar koła (w calach): </label>';

        if(isset($this->bike_data['wheel_size']) && !isset($this->add_vehicle_errors["incorrect_wheel_size"])) {
            echo '<input type="text" id="wheel_size" name="wheel_size" placeholder="Rozmiar koła..." value="' . htmlspecialchars($this->bike_data['wheel_size']) . '">';
        }
        else {
            echo '<input type="text" id="wheel_size" name="wheel_size" placeholder="Rozmiar koła...">';
        }

        //Pole koloru
        echo '<label for="color">Kolor roweru: </label>';

        if(isset($this->bike_data['model'])&& !isset($this->add_vehicle_errors["too_long"])) {
            echo '<input type="text" id="color" name="color" placeholder="Kolor roweru..." value="' . htmlspecialchars($this->bike_data['color']) . '">';
        }
        else {
            echo '<input type="text" id="color" name="color" placeholder="Kolor roweru...">';
        }

        //Pole ceny za dzien wynajmu
        echo '<label for="price">Cena za dzień wynajmu (PLN): </label>';

        if(isset($this->bike_data['model']) && !isset($this->add_vehicle_errors["incorrect_price"])) {
            echo '<input type="text" id="price" name="price" placeholder="Cena za dzień..." value="' . htmlspecialchars($this->bike_data['price']) . '">';
        }
        else {
            echo '<input type="text" id="price" name="price" placeholder="Cena za dzień...">';
        }

        $this->showButtons();
    }

    private function showButtons() {

        echo '<button class="submit">Dodaj pojazd</button>';
        echo '<button class="reset">Wróć</button>';         //RESET DZIALA ZLE
    }

    public function showAddedCarData() {

        if(isset($_SESSION["succes"]) && $_SESSION["succes"] === true && isset($this->car_data)) {
            echo "<br>";
            echo "<p>Pomyślnie dodano samochód do bazy danych.</p>";
            echo "<p>Szczegóły dotyczące pojazdu:</p>";
            echo "<p>Marka: " . htmlspecialchars($this->car_data['brand']) . "</p>";
            echo "<p>Model: " . htmlspecialchars($this->car_data['model']) . "</p>";
            echo "<p>Numer VIN: " . htmlspecialchars($this->car_data['vin']) . "</p>";
            echo "<p>Rocznik pojazdu: " . htmlspecialchars($this->car_data['year']) . "</p>";
            echo "<p>Typ nadwozia " . htmlspecialchars($this->car_data['body_type']) . "</p>";
            echo "<p>Kolor nadwozia: " . htmlspecialchars($this->car_data['color']) . "</p>";
            echo "<p>Ilość miejsc: " . htmlspecialchars($this->car_data['seats']) . "</p>";
            echo "<p>Cena wynajmu (zł/dzień): " . htmlspecialchars($this->car_data['price']) . "</p>";   
        
            unset($_SESSION["succes"]);
        }
    }

    public function showAddedMotorcycleData() {

        if(isset($_SESSION["succes"]) && $_SESSION["succes"] === true && isset($this->moto_data)) {
            echo "<br>";
            echo "<p>Pomyślnie dodano motocykl do bazy danych.</p>";
            echo "<p>Szczegóły dotyczące pojazdu:</p>";
            echo "<p>Marka: " . htmlspecialchars($this->moto_data['brand']) . "</p>";
            echo "<p>Model: " . htmlspecialchars($this->moto_data['model']) . "</p>";
            echo "<p>Numer VIN: " . htmlspecialchars($this->moto_data['vin']) . "</p>";
            echo "<p>Rocznik pojazdu: " . htmlspecialchars($this->moto_data['year']) . "</p>";
            echo "<p>Typ motocykla: " . htmlspecialchars($this->moto_data['moto_type']) . "</p>";
            echo "<p>Pojemność silnika: " . htmlspecialchars($this->moto_data['engine']) . "</p>";
            echo "<p>Kolor motocykla: " . htmlspecialchars($this->moto_data['color']) . "</p>";
            echo "<p>Cena wynajmu (zł/dzień): " . htmlspecialchars($this->moto_data['price']) . "</p>";   
        
            unset($_SESSION["succes"]);
        }
    }

    public function showAddedBikeData() {

        if(isset($_SESSION["succes"]) && $_SESSION["succes"] === true && isset($this->bike_data)) {
            echo "<br>";
            echo "<p>Pomyślnie dodano rower do bazy danych.</p>";
            echo "<p>Szczegóły dotyczące pojazdu:</p>";
            echo "<p>Marka: " . htmlspecialchars($this->bike_data['brand']) . "</p>";
            echo "<p>Model: " . htmlspecialchars($this->bike_data['model']) . "</p>";
            echo "<p>Typ roweru: " . htmlspecialchars($this->bike_data['bike_type']) . "</p>";
            echo "<p>Rozmiar ramy: " . htmlspecialchars($this->bike_data['frame_size']) . "</p>";
            
            if(isset($this->bike_data['is_electric']) && $this->bike_data['is_electric'] != 'none') {

                switch($this->bike_data['is_electric']) {
                    case "yes":
                        echo "<p>Rower jest elektryczny? TAK</p>";
                    break;
                    case "no":
                        echo "<p>Rower jest elektryczny? NIE</p>";
                    break;
                }
            }
            
            echo "<p>Rozmiar koła: " . htmlspecialchars($this->bike_data['wheel_size']) . '"</p>';
            echo "<p>Kolor roweru: " . htmlspecialchars($this->bike_data['color']) . "</p>";
            echo "<p>Cena wynajmu (zł/dzień): " . htmlspecialchars($this->bike_data['price']) . "</p>";   
        
            unset($_SESSION["succes"]);
        }
    }
}