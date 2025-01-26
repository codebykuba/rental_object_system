<?php
    require_once __DIR__ . "/Classes/ConfigSession.php";
    require_once __DIR__ . "/Classes/loginClasses/LoginView.php";

    $loginView = new LoginView();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Zaloguj się.</title>
</head>
<body>
    <section>

        <h3>Zaloguj się</h3>
        
        <div class="form_div">
            <form action="Includes/login.inc.php" method="POST">

            <input type="text" id="email" name="email" placeholder="Adres e-mail">
            <input type="password" id="pwd" name="pwd" placeholder="Hasło">

                <button>Zaloguj się</button>

                <a href="signup.php">Nie masz jeszcze konta? Załóż je tutaj.</a>
            </form>
        </div>

        <?php
            $loginView->showErrors();
        ?>

    </section>
</body>
</html>
