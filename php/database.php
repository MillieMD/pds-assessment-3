<?php

    require_once "config.php";

    $db = new mysqli($servername, $username, $password, $dbname);

    if($db->connect_error){
        header("Location: /500/"); // If cannot connect to database, redirect to error 500 (internal server error)
        exit;
    }

?>