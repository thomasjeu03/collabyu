<?php
error_reporting(E_ALL ^ E_WARNING);
while ($row = mysqli_fetch_assoc($sql)){
    $hostname = "tj9r5.myd.infomaniak.com";
    $username = "tj9r5_collabyu";
    $password = "Collabyu2021";
    $dbname = "tj9r5_collabyu";
    $conn = mysqli_connect($hostname, $username, $password, $dbname);
    $outgoing_id = $_SESSION['user_uniqueid_USERS'];

    $sql2 = "SELECT * FROM message 
            WHERE (incoming_id = {$row['user_uniqueid_USERS']} OR outgoing_id = {$row['user_uniqueid_USERS']}) 
            AND (outgoing_id = {$outgoing_id} OR incoming_id = {$outgoing_id}) 
            ORDER BY message_id_MESSAGE DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    if(mysqli_num_rows($query2) > 0){
        $result = $row2['message_content_MESSAGE'];
    }else{
        $result = "";
    }

    (strlen($result) > 85) ? $msg =  substr($result, 0, 85) . '...' : $msg = $result;
    if(isset($row2['outgoing_id'])){
        ($outgoing_id == $row2['outgoing_id']) ? $you = "Vous: " : $you = "";
    }else{
        $you = "";
    }

        $output .= '<a href="message.php?user_uniqueid_USERS='. $row['user_uniqueid_USERS'] .'" class="profil-search">
                   <div class="left">
                    <img src="php/images/'. $row['user_profilPicture_USERS'] .'" alt="pp" height="60"
                                         width="60">
                   </div>
                   <div class="right">
                     <p>'. $row['user_name_USERS'] .'</p>
                    
                     <p>'. $you . $msg .'</p>
                   </div>
                </a>';

}