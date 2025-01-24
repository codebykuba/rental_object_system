<?php
    require_once __DIR__ . "/Classes/ConfigSession.php";
    require_once __DIR__ . "/Classes/addVehicleClasses/AddVehicleView.php";
    
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
    <title>Dodaj motocykl - KubaWhips Rental.</title>
</head>

    <?php if(isset($_SESSION["account_type"]) && $_SESSION["account_type"] === 1) {?>

        <div class="container">

            <h2>Dodaj pojazd</h2>

            <form action="Includes/add_motorcycle.inc.php" method="POST">

                <?php 
                    $view->showMotocycleInputs();
                    $view->showErrors();
                ?>

            </form>

        </div>

    <?php }?>

    <?php if(isset($_SESSION["account_type"]) && $_SESSION["account_type"] !== 1) {?>

        <h2>Nie jestes administratorem</h2>

    <?php }?>

<body>
    
</body>
</html>
