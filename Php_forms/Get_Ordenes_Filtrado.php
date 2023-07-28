<?php
    if(isset($_POST["tipoVista"])){
        $vista = $_POST["tipoVista"];
        $fechaI = $_POST["fechaInf"];
        $fechaS = $_POST["fechaSup"];
        $ordenC = $_POST["ordenC"];
        $noDiseno = $_POST["noDiseno"];
        $cliente = $_POST["cliente"];

        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->GetOrdenesFilter($fechaI, $fechaS, $ordenC, $noDiseno, $cliente);
        echo $data;
    }
?>