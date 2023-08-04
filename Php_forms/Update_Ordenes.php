<?php
    if(isset($_POST["RazonCambio"])){
        
        $filterOrden = $_POST["filterOrden"];
        $filterDiseno = $_POST["filterDiseno"];

        $fechaLim = $_POST["FechaLimite"];
        $orden = $_POST["ordenC"];
        $diseno = $_POST["noDiseno"];
        $cantidadP = $_POST["cantidadP"];
        $estatusOrden = $_POST["RazonCambio"];
        $cliente = $_POST["cliente"];

        try {
            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            $data = $miloraObj->Update_Orden($fechaLim, $orden, $diseno, $cantidadP,
            $estatusOrden, $cliente, $filterOrden, $filterDiseno);
    
            echo "si";
        } catch (\Throwable $th) {
            echo "no";
        }
    }
?>