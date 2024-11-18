<?php
session_start();
if((!isset($_SESSION["valido"]))and($_SESSION["valido"]!="1")){
    header("location:login.php");
}
?>