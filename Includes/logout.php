<?php

session_start();

$main_directory = $_SESSION["main_dir"];

session_unset();
session_destroy();
header("Location: $main_directory/index.php");
die();