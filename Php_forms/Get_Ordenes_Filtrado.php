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
                    if(($fila["Estatus_orden"] !="Cerrada") && ($fila["DiasRestantes"] <=20)){
                        ?>
                            <tr>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Fecha_realizacion"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Fecha_limite"]; ?></td>
                                <td style="background-color:#F76D6D !important; font-weight:bold;"><?php if($fila["DiasRestantes"]<0){echo "Atraso: ".($fila["DiasRestantes"]*-1);}else{echo "Restan: ".$fila["DiasRestantes"];}?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Orden_compra"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["No_diseno"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Piezas_solicitadas"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Piezas_realizadas"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Piezas_restantes"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Cliente"]; ?></td>
                            </tr>
                                <?php
                            }if(($fila["Estatus_orden"] !="Cerrada") && ($fila["DiasRestantes"]>20 && $fila["DiasRestantes"]<=80)){
                                ?>
                                 <tr>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Fecha_realizacion"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Fecha_limite"]; ?></td>
                                <td style="background-color:#F89351 !important; font-weight:bold;"><?php echo "Restan: ".$fila["DiasRestantes"];?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Orden_compra"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["No_diseno"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Piezas_solicitadas"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Piezas_realizadas"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Piezas_restantes"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Cliente"]; ?></td>
                            </tr>
                                <?php
                            }if((($fila["Estatus_orden"] !="Cerrada")) && ($fila["DiasRestantes"]>80)){
                                ?>
                                 <tr>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Fecha_realizacion"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Fecha_limite"]; ?></td>
                                <td style="background-color:#63E346 !important; font-weight:bold;"><?php echo "Restan: ".$fila["DiasRestantes"];?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Orden_compra"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["No_diseno"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Piezas_solicitadas"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Piezas_realizadas"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Piezas_restantes"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Cliente"]; ?></td>
                            </tr>
                                <?php
                            }
                            if($fila["Estatus_orden"] == "Cerrada"){
                                ?>
                                 <tr>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Fecha_realizacion"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Fecha_limite"]; ?></td>
                                <td style="background-color:#E1E1E1 !important; font-weight:bold;"><?php echo "Cerrada";?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Orden_compra"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["No_diseno"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Piezas_solicitadas"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Piezas_realizadas"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Piezas_restantes"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Cliente"]; ?></td>
                            </tr>
                                <?php
                            }

                }
            }else{
                foreach($data as $fila){
                    if(($fila["Estatus_orden"] !="Cerrada") && ($fila["DiasRestantes"] <=20)){
                        ?>
                            <tr>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Fecha_realizacion"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Fecha_limite"]; ?></td>
                                <td style="background-color:#F76D6D !important; font-weight:bold;"><?php if($fila["DiasRestantes"]<0){echo "Atraso: ".($fila["DiasRestantes"]*-1);}else{echo "Restan: ".$fila["DiasRestantes"];}?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Orden_compra"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Estatus_orden"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["No_diseno"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Piezas_solicitadas"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Piezas_realizadas"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Piezas_restantes"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Cliente"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Piezas_cortadas"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Piezas_dobladas"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Piezas_roladas"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Piezas_biseladas"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Piezas_taladradas"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Piezas_prensadas"]; ?></td>
                            </tr>
                        <?php
                    }if( ($fila["Estatus_orden"] !="Cerrada") && ($fila["DiasRestantes"]>20 && $fila["DiasRestantes"]<=80)){
                        ?>
                        <tr>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Fecha_realizacion"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Fecha_limite"]; ?></td>
                                <td style="background-color:#F89351 !important; font-weight:bold;"><?php echo "Restan: ".$fila["DiasRestantes"];?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Orden_compra"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Estatus_orden"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["No_diseno"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Piezas_solicitadas"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Piezas_realizadas"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Piezas_restantes"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Cliente"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Piezas_cortadas"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Piezas_dobladas"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Piezas_roladas"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Piezas_biseladas"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Piezas_taladradas"]; ?></td>
                                <td style="background-color:#F89351 !important;"><?php echo $fila["Piezas_prensadas"]; ?></td>
                            </tr>
                        <?php
                    }if(($fila["Estatus_orden"] !="Cerrada") && ($fila["DiasRestantes"]>80)){
                        ?>
                        <tr>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Fecha_realizacion"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Fecha_limite"]; ?></td>
                                <td style="background-color:#63E346 !important; font-weight:bold;"><?php echo "Restan: ".$fila["DiasRestantes"];?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Orden_compra"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Estatus_orden"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["No_diseno"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Piezas_solicitadas"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Piezas_realizadas"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Piezas_restantes"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Cliente"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Piezas_cortadas"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Piezas_dobladas"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Piezas_roladas"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Piezas_biseladas"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Piezas_taladradas"]; ?></td>
                                <td style="background-color:#63E346 !important;"><?php echo $fila["Piezas_prensadas"]; ?></td>
                            </tr>
                        <?php
                    }if($fila["Estatus_orden"] == "Cerrada"){
                        ?>
                        <tr>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Fecha_realizacion"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Fecha_limite"]; ?></td>
                                <td style="background-color:#E1E1E1 !important; font-weight:bold;"><?php echo "Cerrada";?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Orden_compra"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Estatus_orden"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["No_diseno"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Piezas_solicitadas"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Piezas_realizadas"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Piezas_restantes"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Cliente"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Piezas_cortadas"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Piezas_dobladas"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Piezas_roladas"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Piezas_biseladas"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Piezas_taladradas"]; ?></td>
                                <td style="background-color:#E1E1E1 !important;"><?php echo $fila["Piezas_prensadas"]; ?></td>
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