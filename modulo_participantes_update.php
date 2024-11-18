<?php
include("controller.php");
$tabla="participantes";


$datos["id_eventos"]=$_POST["id_eventos"];
$datos["id_entradas"]=$_POST["id_entradas"];
$datos["nombre"]=$_POST["nombre"];
$datos["apellidos"]=$_POST["apellidos"];
$datos["email"]=$_POST["email"];
$datos["nif_nie"]=$_POST["nif_nie"];
$datos["telefono"]=$_POST["telefono"];

$datos["updated_at"]=date('Y-m-d h:i:s');



echo updateById($tabla,$datos,$_POST["id"]);
?>