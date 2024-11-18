<?php
include("controller.php");
$id_provincias=$_POST["id_provincias"];


echo SelectOptionsByColumn("localidades","id","localidad","id_provincias",$id_provincias);
?>