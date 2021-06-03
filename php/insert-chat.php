<?php
session_start();

if(isset($_SESSION['user_uniqueid_USERS'])){
    $hostname = "tj9r5.myd.infomaniak.com";
    $username = "tj9r5_collabyu";
    $password = "Collabyu2021";
    $dbname = "tj9r5_collabyu";

    $conn = mysqli_connect($hostname, $username, $password, $dbname);
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if(!empty($message)){
        $sql = mysqli_query($conn, "INSERT INTO message (incoming_id, outgoing_id, message_content_MESSAGE)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
    }
}else{
    header("location: ../login.php");
}
