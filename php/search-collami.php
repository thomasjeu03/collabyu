<?php
    session_start();

    $hostname = "tj9r5.myd.infomaniak.com";
    $username = "tj9r5_collabyu";
    $password = "Collabyu2021";
    $dbname = "tj9r5_collabyu";

    $conn = mysqli_connect($hostname, $username, $password, $dbname);
    $outgoing_id = $_SESSION['user_uniqueid_USERS'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $output = "";

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT user_uniqueid_USERS = {$outgoing_id} AND(user_name_USERS LIKE '%{$searchTerm}%' OR user_username_USERS LIKE '%{$searchTerm}%')");
    if(mysqli_num_rows($sql) > 0){
        include "data-collami.php";
    }else{
        $output .= "Aucun utilisateur trouvé selon votre recherche";
    }
    echo $output;