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

    <section id="DetrasP" class="d-flex justify-content-center"
        style="padding-left: 20px; max-height: 600px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; background-color: #d2dae6;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);" >
        <form id ="form_nuevoD" class="row g-4" style="overflow:scroll;">
        <h2 style="text-align: center;">Historial completo de procesos</h2>
        <center><p id="p-dia" style="font-size:20px;">Búsqueda filtrada</p></center>
            
                <div class="col-md-4">
                    <label for="BP_Diseno" class="form-label">Diseño de pieza</label>
                    <input type="text" class="form-control" id="BP_Diseno" placeholder="Filtrar por diseño de pieza" required>
                </div>

                <div class="col-md-4">
                    <label for="BP_orden" class="form-label">Orden de compra</label>
                    <input type="text" class="form-control" id="BP_orden" placeholder="Filtrar por orden de compra" required>
                </div>

                <div class="col-md-4">
                    <label for="FechaProc" class="form-label">Fecha de proceso</label>
                    <input type="date" class="form-control"  id="FechaProc" required>
                </div>

                <div class="col-md-4"></div>
                    <input onclick="BuscarProceso();" type="button" class="btn btn-primary col-md-4" value="Buscar">
                <div class="col-md-4"></div>
            <!--  tabla resultante -->
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
                        $data = $miloraObj->GetAllProcesos();
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