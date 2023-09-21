<?php
    if(isset($_POST["act"])){
        $fechaBusqueda = $_POST["fechaCarga"];

        require_once("../conexionBD/Consultas.php");
                        $miloraObj = MiloraClass::singleton();
                        $data = $miloraObj->FiltrarCargaDetallado($fechaBusqueda);
                        if(count($data)>0){
                          foreach($data as $fila){
                            if($fila["Estatus"] == "En proceso"){
                              ?>
                             <th style="background-color:#7EA8ED !important;"><?php echo $fila["No_reporte"]; ?></th>
                                <td style="background-color:#7EA8ED !important;"><input onclick="mostrarModalDetallado(this);" id="btn-check" type="button" class="btn btn-success" value="✅"></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Fecha"]; ?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Estatus"]; ?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["FechaLimite"]; ?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Turno"]; ?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Operador"]; ?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["TipoDetallado"]; ?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["No_diseno"]; ?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Orden_compra"]; ?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["CantidadSolicitada"]; ?></td>
                                <td style="background-color:#7EA8ED !important;"><?php if($fila["CantidadEntregada"] == 0){echo "- - -";} ?></td>
                                <td style="background-color:#7EA8ED !important;"><?php if($fila["Horas_trabajadas"] == ""){echo "- - -";} ?></td>
                                <td style="background-color:#7EA8ED !important;"><?php if($fila["Observaciones"] == "Ninguna"){echo "- - -";} ?></td>
                                <td style="background-color:#7EA8ED !important;"><?php if($fila["Porcentaje_cumplimiento"] == 0){echo "- - -";} ?></td>
                              </tr>
                              <?php
                            }else if($fila["Estatus"] == "Terminado"){
                              ?>
                                <th style="background-color:#55C736 !important;"><?php echo $fila["No_reporte"]; ?></th>
                                <td style="background-color:#55C736 !important;"><input onclick="mostrarModalDetallado(this);" id="btn-check" type="button" class="btn btn-success" value="✅"></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Fecha"]; ?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Estatus"]; ?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["FechaLimite"]; ?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Turno"]; ?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Operador"]; ?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["TipoDetallado"]; ?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["No_diseno"]; ?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Orden_compra"]; ?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["CantidadSolicitada"]; ?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["CantidadEntregada"]; ?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Horas_trabajadas"]; ?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Observaciones"]; ?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Porcentaje_cumplimiento"]; ?></td>
                              </tr>
                            </tr>
                              <?php
                            }else{
                                ?>
                                <th style="background-color:#F79C59 !important;"><?php echo $fila["No_reporte"]; ?></th>
                                <td style="background-color:#F79C59 !important;"><input onclick="mostrarModalDetallado(this);" id="btn-check" type="button" class="btn btn-success" value="✅"></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Fecha"]; ?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Estatus"]; ?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["FechaLimite"]; ?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Turno"]; ?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Operador"]; ?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["TipoDetallado"]; ?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["No_diseno"]; ?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Orden_compra"]; ?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["CantidadSolicitada"]; ?></td>
                                <td style="background-color:#F79C59 !important;"><?php if($fila["CantidadEntregada"] == 0){echo "- - -";} ?></td>
                                <td style="background-color:#F79C59 !important;"><?php if($fila["Horas_trabajadas"] == ""){echo "- - -";} ?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Observaciones"]; ?></td>
                                <td style="background-color:#F79C59 !important;"><?php if($fila["Porcentaje_cumplimiento"] == ""){echo "- - -";} ?></td>

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