<?php

class ConfigSession {

    //Parametry pliku cookie
    private $lifetime = 1800;
    private $domain = 'rental.local';  //Domain musi sie zgadzac z hostem 
    private $path = '/';
    private $secure = false;    //False ze wzgledu na http a nie https (Jesli to jest zle, sesje nie dzialja prawidlowo)
    private $httponly = true;

    public function __construct() {

        //Wymuszenie użycia cookie dla sesji i strict mode
        ini_set('session.use_only_cookies', 1);
        ini_set('session.use_strict_mode', 1);

        session_set_cookie_params([
            'lifetime' => $this->lifetime,
            'domain' => $this->domain,
            'path' => $this->path,
            'secure' => $this->secure,
            'httponly' => $this->httponly
        ]);

        //Wlaczenie sesji, jesli nie jest aktywna
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->regenerateSessionId();
    }

    private function regenerateSessionId() {

        //Jesli id nie bylo regenerowane
        if(!isset($_SESSION["last_regeneration"])) {

            session_regenerate_id(true);
            $_SESSION["last_regeneration"] = time();
        }
        else {
            $timestamp = (30) * (60);

            //Jesli od ostatniej regeneracji minelo wiecej lub rowno czasu co timestamp
            if((time() - $_SESSION["last_regeneration"]) >= $timestamp) {

                session_regenerate_id(true);
                $_SESSION["last_regeneration"] = time();
            }
        }
    }
}