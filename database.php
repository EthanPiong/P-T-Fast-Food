<?php

$servername = "localhost";
$database = "PTfastfood";
$username = "root";
$password = "";

//create coonection
$connect = mysqli_connect($servername,$username,$password,$database);

//check connection
if($connect->connect_error)
{
    die("Connection failed: ".$connect->connect_error());
}


?>