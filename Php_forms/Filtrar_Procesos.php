<?php

    if(isset($_POST["where"])){
        
        $DisenoBuscar = $_POST["DisenoBuscar"];
        $OrdenBuscar = $_POST["OrdenBuscar"];
        $FechaProceso = $_POST["FechaProc"];

        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->Filtrar_Proceso($DisenoBuscar, $OrdenBuscar, $FechaProceso);
        if(count($data)>0){
          foreach($data as $fila){
            if($fila["Estado_proceso"] == "En progreso.."){
              ?>
              <tr style="font-weight:bold;">
              <td style="background-color:#7EA8ED !important;"><?php echo $fila["no_proceso"];?></td>
              <td style="background-color:#7EA8ED !important;"><?php echo $fila["No_diseno"];?></td>
              <td style="background-color:#7EA8ED !important;"><?php echo $fila["Orden_compra"];?></td>
              <td style="background-color:#7EA8ED !important;"><?php echo $fila["Cantidad"];?></td>
              <td style="background-color:#7EA8ED !important;"><?php echo $fila["Responsable"];?></td>
              <td style="background-color:#7EA8ED !important;">❌</td>
              <td style="background-color:#7EA8ED !important;"><?php echo $fila["Proceso_actual"];?></td>
              <td style="background-color:#7EA8ED !important;"><?php echo $fila["Procesos_realizados"];?></td>
              <td style="background-color:#7EA8ED !important;"><?php echo $fila["Estado_proceso"];?></td>
              <td style="background-color:#7EA8ED !important;"><?php echo $fila["Procesos_restantes"];?></td>
              <td style="background-color:#7EA8ED !important;"><?php echo $fila["Inicio_FH"];?></td>
              <td style="background-color:#7EA8ED !important;"><?php echo $fila["Termino_FH"];?></td>
            </tr>
              <?php
            }if($fila["Estado_proceso"] == "Terminado"){
              ?>
              <tr style="font-weight:bold;">
              <td style="background-color:#55C736 !important;"><?php echo $fila["no_proceso"];?></td>
              <td style="background-color:#55C736 !important;"><?php echo $fila["No_diseno"];?></td>
              <td style="background-color:#55C736 !important;"><?php echo $fila["Orden_compra"];?></td>
              <td style="background-color:#55C736 !important;"><?php echo $fila["Cantidad"];?></td>
              <td style="background-color:#55C736 !important;"><?php echo $fila["Responsable"];?></td>
              <td style="background-color:#55C736 !important;">✅</td>
              <td style="background-color:#55C736 !important;"><?php echo $fila["Proceso_actual"];?></td>
              <td style="background-color:#55C736 !important;"><?php echo $fila["Procesos_realizados"];?></td>
              <td style="background-color:#55C736 !important;"><?php echo $fila["Estado_proceso"];?></td>
              <td style="background-color:#55C736 !important;"><?php echo $fila["Procesos_restantes"];?></td>
              <td style="background-color:#55C736 !important;"><?php echo $fila["Inicio_FH"];?></td>
              <td style="background-color:#55C736 !important;"><?php echo $fila["Termino_FH"];?></td>
              </tr>
              <?php
            }
          }
        }
        else{
            echo "Nada";
        }
    }
?>