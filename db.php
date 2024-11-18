<?php
$host="localhost:3306";
$user="root";
$password="";
$database="bd_eventos";

$mysqli=new mysqli($host,$user,$password,$database);

if(mysqli_connect_errno()){
    printf("Falló la conexión: %s\n",$mysqli->connect_error);
    exit();
}
$mysqli->set_charset("utf8");


try {
    $dbh = new PDO('mysql:host=localhost;dbname=ifc303', $user, $password       );
} catch (PDOException $e) {
    // attempt to retry the connection after some timeout for example
}
?>