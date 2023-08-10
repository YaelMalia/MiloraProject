<?php
 if(isset($_POST["cve_stock"])){
    $diseno = $_POST["disenoSalida"];
    $cve_stock = $_POST["cve_stock"];
    $ordenS = $_POST["ordenSalida"];
    $fechaS = $_POST["fechaSalida"];
    $cantidadSal = $_POST["cantidadSalida"];


    try {
        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->Insertar_Salida($diseno, $cve_stock, $ordenS, $fechaS, $cantidadSal);
        echo "OK";
    } catch (\Throwable $th) {
        echo "no";
    }
 }
?>