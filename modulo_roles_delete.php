<?php

$id=$_POST["id"];


include("controller.php");
echo delById("roles",$id);

?>