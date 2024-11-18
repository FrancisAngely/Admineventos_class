<?php
include("controller.php");
$tabla="usuarios";


$datos["id_roles"]=$_POST["id_roles"];
$datos["usuario"]=$_POST["usuario"];
$datos["password"]=md5($_POST["password"]);
$datos["email"]=$_POST["email"];
$datos["created_at"]=date('Y-m-d h:i:s');
$datos["updated_at"]=date('Y-m-d h:i:s');

echo saveV($tabla,$datos);


?>