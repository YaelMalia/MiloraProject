<?php

    if(isset($_POST["diseno"])){
        $diseno = $_POST["diseno"];
        $orden = $_POST["orden_compra"];
        
        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->GetOrden_P($diseno, $orden);
        if(count($data)>0){
            $resultado = "";
            $procesos = "";
            $NoOrden;
            foreach($data as $fila){
                $NoOrden = $fila["Numero_orden"];
                if($fila["Corte"] == "Si"){
                    $procesos = $procesos.''.'Corte';
                }
                if($fila["Dobles"] == "Si"){
                    $procesos = $procesos.''.',Doblez';
                }
                if($fila["Rolado"] == "Si"){
                    $procesos = $procesos.''.',Rolado';
                }
                if($fila["Bisel"] == "Si"){
                    $procesos = $procesos.''.',Bisel';
                }
                if($fila["Taladro"] == "Si"){
                    $procesos = $procesos.''.',Taladro';
                }
                if($fila["Prensa"] == "Si"){
                    $procesos = $procesos.''.',Prensa';
                }
            }
            $resultado = $resultado.''.$NoOrden.':'.$procesos;
            echo $resultado;
        }else{
            echo "Nada";
        }
    }

?>