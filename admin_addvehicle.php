<?php
    require_once "Classes/ConfigSession.php";
    require_once "Classes/addVehicleClasses/AddVehicleView.php";
    
    $session = new ConfigSession();
    $view = new AddVehicleView();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Strona główna.</title>
</head>

    <?php if(isset($_SESSION["account_type"]) && $_SESSION["account_type"] === 1) {?>

        <div class="container">

            <h2>Dodaj pojazd</h2>

            <form action="Includes/add_vehicle.inc.php" method="POST">

                <label for="type">Wybierz typ pojazdu:</label>
                <select id="type" name="type">
                    <option value="none">Wybierz typ pojazdu...</option>
                    <option value="car">Samochód</option>
                    <option value="motorcycle">Motocykl</option>
                    <option value="bike">Rower</option>
                </select>
                
                <button type="submit">Potwierdź typ</button> 

                <?php 
                    $view->showError();
                    $view->showAddedCarData();
                    $view->showAddedMotorcycleData();
                    $view->showAddedBikeData()
                ?>

        </div>

    <?php }?>

    <?php if(isset($_SESSION["account_type"]) && $_SESSION["account_type"] !== 1) {?>

        <h2>Nie jestes administratorem</h2>

    <?php }?>

<body>
    
</body>
</html>
