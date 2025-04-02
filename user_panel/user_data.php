<?php
    require_once __DIR__ . "/../Classes/ConfigSession.php";
    require_once __DIR__ . "/../Classes/userClasses/UserView.php";
    
    $session = new ConfigSession();
    $view = new UserView();
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

            <p>Twoje dane:</p>

            <?php
                $view->showUserData();
                $view->showUserFunctions();
            ?>

        </div>

    <?php }?>

    <?php if(!isset($_SESSION["account_type"])) {?>

        <h2>Zaloguj się, żeby mieć dostęp do tej strony.</h2>

    <?php }?>

<body>
    
</body>
</html>
