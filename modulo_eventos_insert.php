<?php
include("controller.php");
$tabla="eventos";

$datos["evento"]=$_POST["evento"];
$datos["fecha"]=$_POST["fecha"];
$datos["file_evento"]="";
$datos["direccion"]=$_POST["direccion"];
$datos["id_localidades"]=$_POST["id_localidades"];
$datos["id_provincias"]=$_POST["id_provincias"];
$datos["cp"]=$_POST["cp"];
$datos["hora_comienzo"]=$_POST["hora_comienzo"];
$datos["descripcion"]=$_POST["descripcion"];
$datos["created_at"]=date('Y-m-d h:i:s');
$datos["updated_at"]=date('Y-m-d h:i:s');

$eventoId=saveV($tabla,$datos);


$upload=UploadFile($_FILES["file_evento"],"eventos","evento_".$eventoId);


if($upload!="error"){
        $datos["file_evento"]=$upload;
        echo updateById($tabla,$datos,$eventoId);    
    }else{
    echo 0;
}

?>