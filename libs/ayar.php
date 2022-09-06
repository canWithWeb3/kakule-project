<?php

    $serverDB ="localhost";
    $usernameDB = "root";
    $passwordDB = "";
    $databaseDB = "kakule";

    $connection = mysqli_connect($serverDB, $usernameDB, $passwordDB, $databaseDB);
    mysqli_set_charset($connection, "UTF8");
    if(mysqli_connect_errno() > 0) {
        die("error: ".mysqli_connect_errno());
    }

?>