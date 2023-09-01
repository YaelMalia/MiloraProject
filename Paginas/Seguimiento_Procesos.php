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
        <h2 style="text-align: center;">Procesos de producción activos</h2>
        <center><p id="p-dia" style="font-size:20px;">Procesos activos para el día de hoy</p></center>
            <!--  tabla resultante -->
            <!--  -->
            <div class="col-md-4">
                    <div class="col-4" style="align-text:center">
                        <input onclick="Refresh();" type="button" class="btn btn-primary" style="margin:0 auto; display:flex; min-width:140px; justify-content:center;" value="Recargar">
                    </div>
                </div>
                <!--  -->
            <div class="table-responsive" id="tableResult">
                <table class="table" id="TablaInfo" style="text-align: center; box-shadow: 0px 0px 24px 0px rgba(0,0,0,0.18); background-color: #d2dae6; ">
                    <thead id="headTable" style="background-color: #adbdd3; ">
                      <tr>
                      <th scope="col">#</th>
                        <th scope="col">Diseño</th>
                        <th scope="col">Orden de compra</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Responsable</th>
                        <th scope="col">Terminado</th>
                        <th scope="col">Proceso actual</th>
                        <th scope="col">Procesos realizados</th>
                        <th scope="col">Estado del proceso</th>
                        <th scope="col">Procesos restantes</th>
                        <th scope="col">Inició</th>
                        <th scope="col">Termino</th>
                      </tr>
                    </thead>
                    <tbody id="cuerpoTabla">
                      <?php

                        require_once("../conexionBD/Consultas.php");
                        $miloraObj = MiloraClass::singleton();
                        $data = $miloraObj->GetProcesos();
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
                              <td style="background-color:#7EA8ED !important;"><input onclick="mostrarModal(this);" id="btn-check" type="button" class="btn btn-success" value="✅"></td>
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