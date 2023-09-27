<?php
$mysqli = new mysqli('localhost','root','','almaceninsumos');
if($mysqli-> connect_errno){
    echo 'Fallo la conexion'.$mysqli->connect_error;
    die();
}
?>