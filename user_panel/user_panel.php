<?php
    require_once __DIR__ . "/../Classes/ConfigSession.php";
    require_once __DIR__ . "/../Classes/addVehicleClasses/AddVehicleView.php";
    
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

    <?php if(isset($_SESSION["account_type"]) && ($_SESSION["account_type"] === 1 || $_SESSION["account_type"] === 0)) {?>

        <div class="container">

            <h2>Panel użytkownika</h2>

            <a href="user_data.php">Twoje dane</p>


        </div>

    <?php }?>

    <?php if(!isset($_SESSION["account_type"])) {?>

        <h2>Zaloguj się, żeby mieć dostęp do tej strony.</h2>

    <?php }?>

<body>
    
</body>
</html>
