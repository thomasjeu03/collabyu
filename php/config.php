<?php
/*$hostname = "tj9r5.myd.infomaniak.com";
$username = "tj9r5_collabyu";
$password = "Collabyu2021";
$dbname = "collabyu";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if(!$conn){
    echo "Database connection error".mysqli_connect_error();
}*/

$hostname = "localhost";
$username = "root";
$password = "root";
$dbname = "collabyu";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if(!$conn){
    echo "Database connection error".mysqli_connect_error();
}
