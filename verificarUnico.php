<?php

$valor=$_POST["valor"];
$tabla=$_POST["tabla"];
$campo=$_POST["campo"];

include("controller.php");
$existe=getByColum($tabla,$campo,$valor);
if($existe==0){
    echo 1;
}else{
    echo 0;
}
?>