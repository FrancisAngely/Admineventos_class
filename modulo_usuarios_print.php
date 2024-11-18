<?php
include("controller.php");
$user=getById("usuarios",$_GET["id"]);
$usuarios = getAllVInner("usuarios", "roles", "id_roles", "id");

            if (count($usuarios) > 0) {
              foreach ($usuarios as $u) {
                 echo $u["role"];
             }}

?>
 <?php
include("files_dompdf/config.php");
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("files_dompdf/style.php");?>
        <style>
            .ficha{
                margin-top: 10pt;
                margin-left: 10pt;
                
            }
            .ficha th{
                font-size: 18pt;
                padding: 10pt;
                font-weight: 300;
                background: #d2d2d2;
            }
             .ficha td{
                font-size: 18pt;
                padding: 10pt;
                 border: 1px solid #d2d2d2;
            }
        </style>
    </head>
<body>
<table class="paginaA4" cellspacing=0 cellpadding=0>
<?php include("files_dompdf/cabecera.php");?>
    
<tr class="contenido"><td class="contenedor">
    <!-- ficha -->
    <table class="ficha" cellspacing=0 cellpadding=0>
        <tr><th>Id:</th><td><?php echo $user["id"];?></td></tr>
        <tr><th>Usuario:</th><td><?php echo $user["usuario"];?></td></tr>
        <tr><th>E-mail:</th><td><?php echo $user["email"];?></td></tr>
        <tr><th>Id Role:</th><td><?php echo $user["id_roles"];?></td></tr>
        <tr><th>Role:</th><td><?php echo $u["role"];?></td></tr>
    </table>
    
    
</td></tr>     
<?php include("files_dompdf/pie.php");?>
</table>


</body>
</html>
<?php
$filename="Ejemplo.pdf";
include("files_dompdf/generarPDF.php");
?>