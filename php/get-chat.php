<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

session_start();
$hostname = "tj9r5.myd.infomaniak.com";
$username = "tj9r5_collabyu";
$password = "Collabyu2021";
$dbname = "tj9r5_collabyu";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if(isset($_SESSION['user_uniqueid_USERS'])){
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";

    $sql = mysqli_query($conn, "SELECT * FROM message 
            LEFT JOIN users ON users.user_uniqueid_USERS = message.outgoing_id
            WHERE (outgoing_id = {$outgoing_id} AND incoming_id = {$incoming_id})
            OR (outgoing_id = {$incoming_id} AND incoming_id = {$outgoing_id}) ORDER BY message_id_MESSAGE ASC");
    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            if($row['outgoing_id'] === $outgoing_id){
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['message_content_MESSAGE'] .'</p>
                                </div>
                            </div>';
            }else{
                $output .= '<div class="chat incoming">
                                <a href="profil.php?user_uniqueid_USERS='. $row['user_uniqueid_USERS'] .'">
                                    <img src="php/images/'.$row['user_profilPicture_USERS'].'" alt="">
                                </a>
                                <div class="details">
                                    <p>'. $row['message_content_MESSAGE'] .'</p>
                                </div>
                            </div>';
            }
        }
    }else{
        $output .= '<div class="error-text">Aucun message n\'est disponible. Une fois que vous envoyez un message, ils apparaîtront ici.</div>';
    }
    echo $output;

}else{
    header("../login.php");
}