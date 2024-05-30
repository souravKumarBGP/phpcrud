<?php
    /* *********************** Logic of create connection with database ********************* */

    $hostName = "localhost";
    $userRoot = "root";
    $password = "";
    $dboName = "crud";

    $connection = mysqli_connect($hostName, $userRoot, $password, $dboName);
?>