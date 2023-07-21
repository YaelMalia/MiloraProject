<?php
$mysqli = new mysqli('localhost','root','','gestionedificios');
if($mysqli-> connect_errno){
    echo 'Fallo la conexion'.$mysqli->connect_error;
    die();
}
?>