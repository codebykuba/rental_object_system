<?php

session_start();
session_unset();
session_destroy();
header("Location: /rental_object_system/index.php");
die();