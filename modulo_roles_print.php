<?php
include("controller.php");
$rol=getById("roles",$_GET["id"]);
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
        <tr><th>Id:</th><td><?php echo $rol["id"];?></td></tr>
        <tr><th>Role:</th><td><?php echo $rol["role"];?></td></tr>
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