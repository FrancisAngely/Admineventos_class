<?php
include("controller.php");
$tabla="usuarios";


$datos["id_roles"]=$_POST["id_roles"];
$datos["usuario"]=$_POST["usuario"];
$datos["email"]=$_POST["email"];
$datos["updated_at"]=date('Y-m-d h:i:s');

$pass_Ant=conseguirValor($tabla,"password",$_POST["id"]);

if($pass_Ant!=$_POST["password"])
    $datos["password"]=md5($_POST["password"]);

echo updateById($tabla,$datos,$_POST["id"])
?>