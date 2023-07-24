<?php
$mysqli = new mysqli('localhost','root','','milorabd');
if($mysqli-> connect_errno){
    echo 'Fallo la conexion'.$mysqli->connect_error;
    die();
}
?>