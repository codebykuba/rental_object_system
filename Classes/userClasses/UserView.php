<?php

require_once __DIR__ . "/../ConfigSession.php";

class UserView {

    private $first_name;
    private $last_name;
    private $email;
    private $account_type;

    public function __construct() {

        $this->first_name = $_SESSION["first_name"];
        $this->last_name = $_SESSION["last_name"];
        $this->email = $_SESSION["email"];
        $this->account_type = $_SESSION["account_type"];
    }

    public function showUserData() {

        echo "<strong>Imię i nazwisko:</strong> " . htmlspecialchars($this->first_name) . " " . htmlspecialchars($this->last_name);
            echo "<br>";
        echo "<strong>Twój email: </strong>" . htmlspecialchars($this->email);
            echo "<br>";
        echo "<strong>Hasło</strong>: ********";
            echo "<br>";
        
        if($this->account_type === 1) {
            echo "<strong>Status konta:</strong> administrator";
        }
        else {
            echo "<strong>Status konta:</strong> użytkownik";
        }
    }

    public function showUserFunctions() {

            echo "<br>";
        echo "<button>Edytuj dane używkotnika</button>";
        echo "<button>Zmień hasło</button>";

    }

    public function getInfo() {
        echo $this->first_name;
        echo "<br>";
        echo $this->last_name;
        echo "<br>";
        echo $this->email;
        echo "<br>";
        echo $this->account_type;
    }
}