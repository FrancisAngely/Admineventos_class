<?php
include("controller.php");
$id_eventos=$_POST["id_eventos"];


echo SelectOptionsByColumn("entradas","id","entrada","id_eventos",$id_eventos);
?>