<?php

require_once __DIR__ . "/../ConfigSession.php";

class ShowVehicleView {

    private $cars_data;
    private $motorcycles_data;
    private $bikes_data;

    public function __construct() {
        
        //Przechwyc dane o dostepnych samochodach do sesji i wyczysc zmienna sesyjna
        if(isset($_SESSION['cars'])) {
            $this->cars_data = $_SESSION['cars'];
            unset($_SESSION['cars']);
        }

        if(isset($_SESSION['motorcycles'])) {
            $this->motorcycles_data = $_SESSION['motorcycles'];
            unset($_SESSION['motorcycles']);
        }

        if(isset($_SESSION['bikes'])) {
            $this->bikes_data = $_SESSION['bikes'];
            unset($_SESSION['bikes']);
        }
    }

    public function showCarCards() {

        if(isset($this->cars_data)) {
            foreach($this->cars_data as $car) {

                echo '<div class="vehicle_card">';
                    echo '<h3>' . htmlspecialchars($car["brand"]) . ' ' . htmlspecialchars($car["model"]) . '</h3>';
                    echo '<p>' . htmlspecialchars($car["year_of_production"]) . ', ' . htmlspecialchars($car["details"]["body_type"])
                    . ', liczba miejsc: ' . htmlspecialchars($car["details"]["seats"]) .  '</p>';
                    echo '<p>Cena za dzień wynajmu: ' . htmlspecialchars($car["price"]) . ' zł </p>';
                    echo '<a href="#">
                            <button class="reserve">Rezerwuj</button>
                          </a> ';
                echo '</div>';
            }
        }
    }

    public function showMotorcycleCards() {

        if(isset($this->motorcycles_data)) {
            foreach($this->motorcycles_data as $motorcycle) {

                echo '<div class="vehicle_card">';
                    echo '<h3>' . htmlspecialchars($motorcycle["brand"]) . ' ' . htmlspecialchars($motorcycle["model"]) . '</h3>';
                    echo '<p>' . htmlspecialchars($motorcycle["year_of_production"]) . ', ' . htmlspecialchars($motorcycle["details"]["moto_type"])
                    . ', ' . htmlspecialchars($motorcycle["details"]["engine"]) . 'cc</p>';
                    echo '<p>Cena za dzień wynajmu: ' . htmlspecialchars($motorcycle["price"]) . ' zł </p>';
                    echo '<a href="#">
                            <button class="reserve">Rezerwuj</button>
                          </a> ';
                echo '</div>';
            }
        }
    }

    public function showBikeCards() {

        if(isset($this->bikes_data)) {
            foreach($this->bikes_data as $bike) {

                if(isset($bike["is_electric"]) && $bike["is_electric"] == "yes") {
                    $statement = "Rower elektryczny";
                }                 

                echo '<div class="vehicle_card">';
                    echo '<h3>' . htmlspecialchars($bike["brand"]) . ' ' . htmlspecialchars($bike["model"]) . '</h3>';
                    echo '<p><strong>' . htmlspecialchars($bike["bike_type"]) . '</strong>, rama: <strong>' . htmlspecialchars($bike["details"]["frame_size"])
                    . '</strong>, rozmiar koła: <strong>' . htmlspecialchars($bike["details"]["wheel_size"]) . '"</strong>' .  '</p>';
                    
                    if(isset($statement)) {
                        echo '<p><strong>' . $statement . '</strong></p>';
                    }

                    echo '<a href="#">
                        <button class="reserve">Rezerwuj</button>
                    </a> ';
                echo '</div>';
            }
        }
    }
}
