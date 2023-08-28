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
        if(count($data)>0){
            if($vista == "Resumida"){
                foreach($data as $fila){
                    if($fila["DiasRestantes"] <=20 && $fila["Estatus_orden"] !="Cerrada"){
                        ?>
                    <tr style="color:#BC2727;">
                        <td><?php echo $fila["Fecha_realizacion"]; ?></td>
                        <td><?php echo $fila["Fecha_limite"]; ?></td>
                        <td><?php if($fila["DiasRestantes"]<0){echo "Atraso: ".($fila["DiasRestantes"]*-1);}else{echo "Restan: ".$fila["DiasRestantes"];}?></td>
                        <td><?php echo $fila["Orden_compra"]; ?></td>
                        <td><?php echo $fila["No_diseno"]; ?></td>
                        <td><?php echo $fila["Piezas_solicitadas"]; ?></td>
                        <td><?php echo $fila["Piezas_realizadas"]; ?></td>
                        <td><?php echo $fila["Piezas_restantes"]; ?></td>
                        <td><?php echo $fila["Cliente"]; ?></td>
                    </tr>
                        <?php
                    }if($fila["DiasRestantes"]>20 && $fila["DiasRestantes"]<=80 && $fila["Estatus_orden"] !="Cerrada"){
                        ?>
                         <tr style="color:#F76C00;">
                        <td><?php echo $fila["Fecha_realizacion"]; ?></td>
                        <td><?php echo $fila["Fecha_limite"]; ?></td>
                        <td><?php echo "Restan: ".$fila["DiasRestantes"];?></td>
                        <td><?php echo $fila["Orden_compra"]; ?></td>
                        <td><?php echo $fila["No_diseno"]; ?></td>
                        <td><?php echo $fila["Piezas_solicitadas"]; ?></td>
                        <td><?php echo $fila["Piezas_realizadas"]; ?></td>
                        <td><?php echo $fila["Piezas_restantes"]; ?></td>
                        <td><?php echo $fila["Cliente"]; ?></td>
                    </tr>
                        <?php
                    }if($fila["DiasRestantes"]>80 && $fila["Estatus_orden"] !="Cerrada"){
                        ?>
                         <tr style="color:#369A31;">
                        <td><?php echo $fila["Fecha_realizacion"]; ?></td>
                        <td><?php echo $fila["Fecha_limite"]; ?></td>
                        <td><?php echo "Restan: ".$fila["DiasRestantes"];?></td>
                        <td><?php echo $fila["Orden_compra"]; ?></td>
                        <td><?php echo $fila["No_diseno"]; ?></td>
                        <td><?php echo $fila["Piezas_solicitadas"]; ?></td>
                        <td><?php echo $fila["Piezas_realizadas"]; ?></td>
                        <td><?php echo $fila["Piezas_restantes"]; ?></td>
                        <td><?php echo $fila["Cliente"]; ?></td>
                    </tr>
                        <?php
                    }if($fila["Estatus_orden"] == "Cerrada"){
                        ?>
                         <tr style="color:#000000">
                        <td><?php echo $fila["Fecha_realizacion"]; ?></td>
                        <td><?php echo $fila["Fecha_limite"]; ?></td>
                        <td><?php echo "Cerrada";?></td>
                        <td><?php echo $fila["Orden_compra"]; ?></td>
                        <td><?php echo $fila["No_diseno"]; ?></td>
                        <td><?php echo $fila["Piezas_solicitadas"]; ?></td>
                        <td><?php echo $fila["Piezas_realizadas"]; ?></td>
                        <td><?php echo $fila["Piezas_restantes"]; ?></td>
                        <td><?php echo $fila["Cliente"]; ?></td>
                    </tr>
                        <?php
                    }

                }
            }else{
                foreach($data as $fila){
                    if($fila["DiasRestantes"] <=20 && $fila["Estatus_orden"] !="Cerrada"){
                        ?>
                            <tr style="color:#BC2727;">
                                <td><?php echo $fila["Fecha_realizacion"]; ?></td>
                                <td><?php echo $fila["Fecha_limite"]; ?></td>
                                <td><?php if($fila["DiasRestantes"]<0){echo "Atraso: ".($fila["DiasRestantes"]*-1);}else{echo "Restan: ".$fila["DiasRestantes"];}?></td>
                                <td><?php echo $fila["Orden_compra"]; ?></td>
                                <td><?php echo $fila["Estatus_orden"]; ?></td>
                                <td><?php echo $fila["No_diseno"]; ?></td>
                                <td><?php echo $fila["Piezas_solicitadas"]; ?></td>
                                <td><?php echo $fila["Piezas_realizadas"]; ?></td>
                                <td><?php echo $fila["Piezas_restantes"]; ?></td>
                                <td><?php echo $fila["Cliente"]; ?></td>
                                <td><?php echo $fila["Piezas_cortadas"]; ?></td>
                                <td><?php echo $fila["Piezas_dobladas"]; ?></td>
                                <td><?php echo $fila["Piezas_roladas"]; ?></td>
                                <td><?php echo $fila["Piezas_biseladas"]; ?></td>
                                <td><?php echo $fila["Piezas_taladradas"]; ?></td>
                                <td><?php echo $fila["Piezas_prensadas"]; ?></td>
                            </tr>
                        <?php
                    }if($fila["DiasRestantes"]>20 && $fila["DiasRestantes"]<=80 && $fila["Estatus_orden"] !="Cerrada"){
                        ?>
                        <tr style="color:#F76C00;">
                                <td><?php echo $fila["Fecha_realizacion"]; ?></td>
                                <td><?php echo $fila["Fecha_limite"]; ?></td>
                                <td><?php echo "Restan: ".$fila["DiasRestantes"];?></td>
                                <td><?php echo $fila["Orden_compra"]; ?></td>
                                <td><?php echo $fila["Estatus_orden"]; ?></td>
                                <td><?php echo $fila["No_diseno"]; ?></td>
                                <td><?php echo $fila["Piezas_solicitadas"]; ?></td>
                                <td><?php echo $fila["Piezas_realizadas"]; ?></td>
                                <td><?php echo $fila["Piezas_restantes"]; ?></td>
                                <td><?php echo $fila["Cliente"]; ?></td>
                                <td><?php echo $fila["Piezas_cortadas"]; ?></td>
                                <td><?php echo $fila["Piezas_dobladas"]; ?></td>
                                <td><?php echo $fila["Piezas_roladas"]; ?></td>
                                <td><?php echo $fila["Piezas_biseladas"]; ?></td>
                                <td><?php echo $fila["Piezas_taladradas"]; ?></td>
                                <td><?php echo $fila["Piezas_prensadas"]; ?></td>
                            </tr>
                        <?php
                    }if($fila["DiasRestantes"]>80 && $fila["Estatus_orden"] !="Cerrada"){
                        ?>
                        <tr style="color:#369A31;">
                                <td><?php echo $fila["Fecha_realizacion"]; ?></td>
                                <td><?php echo $fila["Fecha_limite"]; ?></td>
                                <td><?php echo "Restan: ".$fila["DiasRestantes"];?></td>
                                <td><?php echo $fila["Orden_compra"]; ?></td>
                                <td><?php echo $fila["Estatus_orden"]; ?></td>
                                <td><?php echo $fila["No_diseno"]; ?></td>
                                <td><?php echo $fila["Piezas_solicitadas"]; ?></td>
                                <td><?php echo $fila["Piezas_realizadas"]; ?></td>
                                <td><?php echo $fila["Piezas_restantes"]; ?></td>
                                <td><?php echo $fila["Cliente"]; ?></td>
                                <td><?php echo $fila["Piezas_cortadas"]; ?></td>
                                <td><?php echo $fila["Piezas_dobladas"]; ?></td>
                                <td><?php echo $fila["Piezas_roladas"]; ?></td>
                                <td><?php echo $fila["Piezas_biseladas"]; ?></td>
                                <td><?php echo $fila["Piezas_taladradas"]; ?></td>
                                <td><?php echo $fila["Piezas_prensadas"]; ?></td>
                            </tr>
                        <?php
                    }if($fila["Estatus_orden"] == "Cerrada"){
                        ?>
                        <tr style="color:#000000;">
                                <td><?php echo $fila["Fecha_realizacion"]; ?></td>
                                <td><?php echo $fila["Fecha_limite"]; ?></td>
                                <td><?php echo "Cerrada";?></td>
                                <td><?php echo $fila["Orden_compra"]; ?></td>
                                <td><?php echo $fila["Estatus_orden"]; ?></td>
                                <td><?php echo $fila["No_diseno"]; ?></td>
                                <td><?php echo $fila["Piezas_solicitadas"]; ?></td>
                                <td><?php echo $fila["Piezas_realizadas"]; ?></td>
                                <td><?php echo $fila["Piezas_restantes"]; ?></td>
                                <td><?php echo $fila["Cliente"]; ?></td>
                                <td><?php echo $fila["Piezas_cortadas"]; ?></td>
                                <td><?php echo $fila["Piezas_dobladas"]; ?></td>
                                <td><?php echo $fila["Piezas_roladas"]; ?></td>
                                <td><?php echo $fila["Piezas_biseladas"]; ?></td>
                                <td><?php echo $fila["Piezas_taladradas"]; ?></td>
                                <td><?php echo $fila["Piezas_prensadas"]; ?></td>
                            </tr>
                        <?php
                    }
                    
                }
            }
        }else{
            echo "Nada";
        }
    }
?>