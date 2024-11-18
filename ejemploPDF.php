<?php
include("files_dompdf/config.php");
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("files_dompdf/style.php");?>
    </head>
<body>
<table class="paginaA4" cellspacing=0 cellpadding=0>
<?php include("files_dompdf/cabecera.php");?>
    
<tr class="contenido"><td class="contenedor">&nbsp;
    
    
</td></tr>     
<?php include("files_dompdf/pie.php");?>
</table>


</body>
</html>
<?php
$filename="Ejemplo.pdf";
include("files_dompdf/generarPDF.php");
?>