
<?php
 if(isset($_POST["numero_orden"])){
    $diseno = $_POST["disenoEntrada"];
    $nOrden = $_POST["numero_orden"];
    $ordenE = $_POST["ordenEntrada"];
    $fechaE = $_POST["fechaEntrada"];
    $cantidadEnt = $_POST["cantidadEntrada"];


    try {
        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->Insertar_Entrada($diseno, $nOrden, $ordenE, $fechaE, $cantidadEnt);
        echo "OK";
    } catch (\Throwable $th) {
        echo "no";
    }
 }
?>