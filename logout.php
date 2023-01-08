<?php
include('database.php');
session_start();

if(isset($_SESSION['id']))
{
    unset($_SESSION["id"]);
    ?><script>alert('Logout Successfull');</script><?php
}



header("Location:../User Index.php");
?>