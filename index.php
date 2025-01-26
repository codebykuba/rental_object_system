<?php
    require_once __DIR__ . "/Classes/ConfigSession.php";

    $session = new ConfigSession();

    //Umieszczenie glownej sciezki do projektu w zmiennej sesyjnej
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $protocol = "https://";
    }
    else {
        $protocol = "http://";
    }

    $host = $_SERVER["HTTP_HOST"];
    $path = dirname($_SERVER["SCRIPT_NAME"]);
    $main_directory = rtrim($protocol . $host . $path, '/');
    $_SESSION["main_dir"] = $main_directory;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Strona główna - KubaWhips Rental</title>
</head>

    <?php if(isset($_SESSION["user_id"])) {?>

        <h3>
            Zalogowano jako: <?php echo htmlspecialchars($_SESSION["first_name"]) . " " . htmlspecialchars($_SESSION["last_name"]);?>
        </h3>

    <?php }?>

    <?php if(isset($_SESSION["account_type"]) && $_SESSION["account_type"] === 1) {?>

        <h4>Zalogowano jako Administrator</h4>

        <a href="admin.php">Panel administratora</a>

    <?php }?>
    
    <a href="vehicles.php">Nasza oferta<a>

    <?php if(!isset($_SESSION["account_type"])) {?>
        
        <a href="login.php">Zaloguj się tutaj.<a>
    
    <?php }?>

        <?php /*
            session_start();
            $_SESSION['test'] = 'Test Session Value';
            echo $_SESSION['test']; */
        ?>

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
