<?php

function moneda($num){
    return number_format($num,2,",",".")."€";
}

function cambiaf_a_espanol($fecha){
if($fecha!=""){
preg_match( '/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/', $fecha, $mifecha);
$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
return $lafecha;
}else return "";
}


function cambiarFormatoAMysql($fecha){
preg_match( '/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{2,4})/', $fecha, $mifecha);
$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
return $lafecha;
}
?>