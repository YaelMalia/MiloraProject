<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


    <script src="../alertify/alertify.js"></script>
    <link rel="stylesheet" href="../alertify/alertify.css">

    <script src="../Script/Formularios_Js/FormsScripts.js"></script>
    <script src="../Script/jquery.js"></script>
    <script src="../Script/jquery-3.5.1.min.js"></script>

    <style>
      .modalMine{
        margin:0 auto;
        border-radius:10px;
        background-color:#E5E6E6;
        width:70%;
        min-height: 250px;
        position:fixed;
        z-index:10;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0px 0px 24px 0px rgba(0,0,0,0.18);
        padding:30px;
        display:none;
      }

      
    </style>
</head>
<body id="cuerpoP" style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; ">
   
    <!-- Modal para registro de producción -->
    <div class="modalMine" id="modal">
      <h2 style="text-align: center;">Registro de proceso terminado</h2>
      <p style="text-align: center;">(En caso que el siguiente proceso sea "ninguno", ingresar almacén como el siguiente responsable y la cantidad de piezas)</p>
      <div class="row g-3" style="margin-top:30px;">
            <div class="col-md-4">
                <label for="ComboProcesos" class="form-label">Siguiente proceso:</label>
                <select id="ComboProcesos" class="form-select">
                    <!-- <option>Si</option>
                    <option selected>No</option> -->
                </select>
            </div>

            <div class="col-md-4">
                <label for="Responsable" class="form-label">Responsable del siguiente proceso</label>
                <input type="text" class="form-control" id="Responsable" placeholder="Responsable del siguiente proceso">
            </div>

            <div class="col-md-4">
                <label for="CantidadSP" class="form-label">Cantidad de piezas</label>
                <input type="text" class="form-control" id="CantidadSP" placeholder="Piezas por hacer para el siguiente proceso">
            </div>

        <input id="btn-Cancel" onclick="" type="button" class="btn btn-danger col-md-4" value="Cancelar">
        <div class="col-md-4"></div>    
        <input onclick="Actualizar_Procesos();" type="button" class="btn btn-success col-md-4" value="Aceptar">


      </div>

    </div>
    <!-- Fin modal -->

    <section id="DetrasP" class="d-flex justify-content-center"
        style="padding-left: 20px; max-height: 600px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; background-color: #d2dae6;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);" >
        <form id ="form_nuevoD" class="row g-4" style="overflow:scroll;">
        <h2 style="text-align: center;">Cargas realizadas para corte</h2>
        <!-- <center><p id="p-dia" style="font-size:20px;">Procesos activos para el día de hoy</p></center> -->
            <!--  tabla resultante -->
            <!--  -->
            <div class="col-md-4">
                    <div class="col-4" style="align-text:center">
                        <input onclick="Refresh_CC();" type="button" class="btn btn-primary" style="margin:0 auto; display:flex; min-width:140px; justify-content:center;" value="Recargar">
                    </div>
                </div>
                <!--  -->
            <div class="table-responsive" id="tableResult">
                <table class="table" id="TablaInfo" style="text-align: center; box-shadow: 0px 0px 24px 0px rgba(0,0,0,0.18); background-color: #d2dae6; ">
                    <thead id="headTable" style="background-color: #adbdd3; ">
                      <tr>
                      <th scope="col">#</th>
                        <th scope="col">Reportar</th>
                        <th scope="col" style="min-width:100px;">Fecha carga</th>
                        <th scope="col">Estatus</th>
                        <th scope="col" style="min-width:100px;">Fecha límite</th>
                        <th scope="col">Turno</th>
                        <th scope="col">Operador</th>
                        <th scope="col">Diseño</th>
                        <th scope="col">Código MP</th>
                        <th scope="col">Espesor</th>
                        <th scope="col">Vale MP</th>
                        <th scope="col">Cant. Solic. NEST</th>
                        <th scope="col">Cantidad reportada</th>
                        <th scope="col">Placas solicitadas</th>
                        <th scope="col">Placas Cortadas</th>
                        <th scope="col">Proyecto o lote</th>
                        <th scope="col">Horas trabajadas</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">% cumplimiento</th>

                      </tr>
                    </thead>
                    <tbody id="cuerpoTabla">
                      <?php

                        require_once("../conexionBD/Consultas.php");
                        $miloraObj = MiloraClass::singleton();
                        $data = $miloraObj->Get_Cargas_Corte();
                        if(count($data)>0){
                          foreach($data as $fila){
                            if($fila["Estatus"] == "En proceso"){
                              ?>
                             <th style="background-color:#7EA8ED !important;"><?php echo $fila["No_reporte"]; ?></th>
                                <td style="background-color:#7EA8ED !important;"><input onclick="" id="btn-check" type="button" class="btn btn-success" value="✅"></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Fecha"];?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Estatus"];?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["FechaLimite"];?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Turno"];?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Operador"];?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["No_diseno"];?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Codigo_MP"];?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Espesor"];?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Vale_MP"];?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["NEST_Solicitado"];?></td>
                                <td style="background-color:#7EA8ED !important;"><?php if($fila["Cantidad_reportada"]==0){echo "- - -";}?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Placas_NEST"];?></td>
                                <td style="background-color:#7EA8ED !important;"><?php if($fila["PlacasCortadas"]==""){echo "- - -";}?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Orden_compra"];?></td>
                                <td style="background-color:#7EA8ED !important;"><?php if($fila["Horas_trabajadas"]==""){echo "- - -";}?></td>
                                <td style="background-color:#7EA8ED !important;"><?php if($fila["Observaciones"]=="Ninguna"){echo "- - -";}?></td>
                                <td style="background-color:#7EA8ED !important;"><?php echo $fila["Porcentaje_cumplimiento"];?></td>
                            </tr>
                              <?php
                            }else if($fila["Estatus"] == "Terminado"){
                              ?>
                              <th style="background-color:#55C736 !important;"><?php echo $fila["No_reporte"]; ?></th>
                                <td style="background-color:#55C736 !important;">✅</td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Fecha"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Estatus"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["FechaLimite"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Turno"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Operador"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["No_diseno"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Codigo_MP"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Espesor"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Vale_MP"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["NEST_Solicitado"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Cantidad_reportada"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Placas_NEST"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["PlacasCortadas"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Orden_compra"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Horas_trabajadas"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Observaciones"];?></td>
                                <td style="background-color:#55C736 !important;"><?php echo $fila["Porcentaje_cumplimiento"];?></td>
                            </tr>
                              <?php
                            }else{
                                ?>
                                <th style="background-color:#F79C59 !important;"><?php echo $fila["No_reporte"]; ?></th>
                                <td style="background-color:#F79C59 !important;"><input onclick="" id="btn-check" type="button" class="btn btn-success" value="✅"></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Fecha"];?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Estatus"];?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["FechaLimite"];?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Turno"];?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Operador"];?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["No_diseno"];?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Codigo_MP"];?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Espesor"];?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Vale_MP"];?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["NEST_Solicitado"];?></td>
                                <td style="background-color:#F79C59 !important;"><?php if($fila["Cantidad_reportada"]==0){echo "- - -";}?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Placas_NEST"];?></td>
                                <td style="background-color:#F79C59 !important;"><?php if($fila["PlacasCortadas"]==""){echo "- - -";}?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Orden_compra"];?></td>
                                <td style="background-color:#F79C59 !important;"><?php if($fila["Horas_trabajadas"]==""){echo "- - -";}?></td>
                                <td style="background-color:#F79C59 !important;"><?php if($fila["Observaciones"]=="Ninguna"){echo "- - -";}?></td>
                                <td style="background-color:#F79C59 !important;"><?php echo $fila["Porcentaje_cumplimiento"];?></td>
                            </tr>
                                <?php
                            }
                          }
                        }
                        else{
                          ?>
                          <script>
                            alertify.alert("¡Vaya!", "Parece que no hay procesos activos para el día de hoy");
                          </script>
                        <?php
                        }

                      ?>

                    </tbody>
                  </table>
            </div>
        </form>
    </section>
   <script>
    $("#btn-Cancel").click(function(){
      $("#modal").hide(800);
      document.getElementById("DetrasP").style.filter = "blur(0) grayscale(0%)";
      document.getElementById("DetrasP").style.pointerEvents = "auto";
    });
   </script>
</body>
</html>