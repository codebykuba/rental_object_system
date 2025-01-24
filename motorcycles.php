<?php
    require_once __DIR__ . "/Classes/ConfigSession.php";
    require_once __DIR__ . "/Classes/showVehiclesClasses/ShowMotorcycles.php";
    require_once __DIR__ . "/Classes/showVehiclesClasses/ShowVehicleView.php";
    
    $session = new ConfigSession();
    $show_motorcycles = new ShowMotorcycles("motorcycles");
    $show_motorcycles->storeInSession();

    $view = new ShowVehicleView();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Dostępne motocykle - KubaWhips Rental</title>
</head>

    <?php if(isset($_SESSION["user_id"])) {?>

        <h3>
            Zalogowano jako: <?php echo htmlspecialchars($_SESSION["first_name"]) . " " . htmlspecialchars($_SESSION["last_name"]);?>
        </h3>

    <?php }?>
    
    <h2>Dostepne motocykle</h2>

        <?php 

            $view->showMotorcycleCards();

        ?>

    <br>

    <?php if(!isset($_SESSION["account_type"])) {?>
        
        <a href="login.php">Zaloguj się tutaj.<a>
    
    <?php }?>

    <?php if(isset($_SESSION["user_id"])) {?>

        <h3>
            <form action="Includes/logout.php">
                <button>Wyloguj się</button>
            </form>
        </h3>

    <?php }?>

<body>
    
</body>
</html>
