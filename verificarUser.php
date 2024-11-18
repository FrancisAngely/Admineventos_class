<?php
//SELECT `id`, `username`, `pass`, `nombre`, `apellidos`, `email`, `created_at`, `updated_at` FROM `usuarios` WHERE 1
$username=$_POST["username"];


$sql="SELECT `id`, `username`, `pass`, `nombre`, `apellidos`, `email`, `created_at`, `updated_at` FROM `usuarios` WHERE 1 ";
$sql.=" and `username`='".$username."'";
    

include("db.php");
$query=$mysqli->query($sql);
if($query->num_rows>0){
    
    echo 1;
}else{
    //usuario o contraseña no son correctos
    //header("location:login.php");
    echo 0;
}
?>