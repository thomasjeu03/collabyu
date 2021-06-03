<?php
    session_start();

    $hostname = "tj9r5.myd.infomaniak.com";
    $username = "tj9r5_collabyu";
    $password = "Collabyu2021";
    $dbname = "tj9r5_collabyu";

    $conn = mysqli_connect($hostname, $username, $password, $dbname);
    $outgoing_id = $_SESSION['user_uniqueid_USERS'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT user_uniqueid_USERS = {$outgoing_id}");
    $output = "";

    if(mysqli_num_rows($sql) == 1){
        $output .= "Aucun utilisateur n'est possible à chatter";
    }elseif (mysqli_num_rows($sql) > 0){
        include "data-message.php";
    }
    echo $output;
