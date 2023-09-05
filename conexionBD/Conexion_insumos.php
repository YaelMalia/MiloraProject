<?php
$mysqli = new mysqli('localhost','root','','');
if($mysqli-> connect_errno){
    echo 'Fallo la conexion'.$mysqli->connect_error;
    die();
}
?>