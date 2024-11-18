<?php
include("controller.php");
$tabla="eventos";



if($_FILES["file_evento"]["name"]!=""){
    //función que me devuelva el valor del campo imagen del producto editado
    // conseguirValor($tabla,$campo,$id)
    $target=conseguirValor($tabla,"file_evento",$_POST["id"]);
   
    //función que borre ese archivo
   borrarArchivo($target);
}

$upload=UploadFile($_FILES["file_evento"],"eventos","evento_".$_POST["id"]);



$datos["evento"]=$_POST["evento"];
$datos["fecha"]=$_POST["fecha"];
$datos["direccion"]=$_POST["direccion"];
$datos["id_localidades"]=$_POST["id_localidades"];
$datos["id_provincias"]=$_POST["id_provincias"];
$datos["cp"]=$_POST["cp"];
$datos["hora_comienzo"]=$_POST["hora_comienzo"];
$datos["updated_at"]=date('Y-m-d h:i:s');
if($upload!="error"){
    $datos["file_evento"]=$upload;
}


echo updateById($tabla,$datos,$_POST["id"])
?>