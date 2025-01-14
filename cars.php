<?php
    require_once "Classes/ConfigSession.php";
    require_once "Classes/showVehiclesClasses/ShowCars.php";
    require_once "Classes/showVehiclesClasses/ShowVehicleView.php";
    
    $session = new ConfigSession();
    $show_cars = new ShowCars("cars");
    $show_cars->storeInSession();

    $view = new ShowVehicleView();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Dostępne samochody - KubaWhips Rental</title>
</head>

    <?php if(isset($_SESSION["user_id"])) {?>

        <h3>
            Zalogowano jako: <?php echo htmlspecialchars($_SESSION["first_name"]) . " " . htmlspecialchars($_SESSION["last_name"]);?>
        </h3>

    <?php }?>
    
    <h2>Dostepne samochody</h2>

        <?php 

            $view->showCarCards();

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
