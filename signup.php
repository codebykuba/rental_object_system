<?php
    require_once __DIR__ . "/Classes/ConfigSession.php";
    require_once __DIR__ . "/Classes/signupClasses/SignupView.php";

    $signupView = new SignupView();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Zarejestuj się.</title>
</head>
<body>
    <section>

        <h3>Zarejestruj się</h3>
        
        <div class="form_div">
            <form action="Includes/signup.inc.php" method="POST">

                <?php
                    $signupView->saveInputs();
                ?>

                <p class="disclaimer">
                    Zakładając konto, akceptujesz nasze Warunki użytkowania.
                </p>

                <button>Zarejestruj się</button>

                <a href="login.php">Masz już konto? Zaloguj się tutaj.</a>
            </form>
        </div>

        <?php
            $signupView->showErrors();
        ?>

    </section>
</body>
</html>
