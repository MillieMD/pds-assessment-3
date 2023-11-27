<?php

    require_once "config.php";

    $db = new mysqli($servername, $username, $password, $dbname);

    if($db->connect_error){
        
    }


?>