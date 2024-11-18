<?php
include("controller.php");
$tabla="entradas";


$datos["entrada"]=$_POST["entrada"];
$datos["id_eventos"]=$_POST["id_eventos"];
$datos["precio"]=$_POST["precio"];

$datos["updated_at"]=date('Y-m-d h:i:s');



echo updateById($tabla,$datos,$_POST["id"]);
?>