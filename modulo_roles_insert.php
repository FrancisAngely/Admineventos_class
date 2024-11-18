<?php
include("controller.php");
$tabla="roles";


$datos["role"]=$_POST["role"];
$datos["created_at"]=date('Y-m-d h:i:s');
$datos["updated_at"]=date('Y-m-d h:i:s');

echo saveV($tabla,$datos);


?>