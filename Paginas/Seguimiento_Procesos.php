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

</head>
<body style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
   
    <section class="d-flex justify-content-center"
        style="padding-left: 20px; max-height: 600px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; background-color: #d2dae6;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);" >
        <form id ="form_nuevoD" class="row g-4" style="">
            <h2 style="text-align: center;">Seguimiento de procesos de producción</h2>
            <input onclick="AgregarProceso_Test();" type="button" class="btn btn-primary col-12" value="Agregar">
            <!--  tabla resultante -->
            <div class="table-responsive col-12" id="tableResult">
                <table class="table" id="TablaInfo" style="text-align: center; box-shadow: 0px 0px 24px 0px rgba(0,0,0,0.18); background-color: #d2dae6; ">
                    <thead id="headTable" style="background-color: #adbdd3; ">
                      <tr>
                        <th scope="col">Diseño</th>
                        <th scope="col">Orden de compra</th>
                        <th scope="col">Proceso actual</th>
                        <th scope="col">Procesos realizados</th>
                        <th scope="col">Estado del proceso</th>
                        <th scope="col">Procesos restantes</th>
                        <th scope="col">Hora de inicio</th>
                        <th scope="col">Hora de termino</th>
                      </tr>
                    </thead>
                    <tbody id="cuerpoTabla">
                      <?php

                        require_once("../conexionBD/Consultas.php");
                        $miloraObj = MiloraClass::singleton();
                        $data = $miloraObj->GetProcesos();
                        if(count($data)>0){
                          foreach($data as $fila){
                            ?>
                            <tr style="max-height: 10px;">
                                <th scope="row" data-type="string">  <?php echo $fila['No_diseno']; ?>  </th>
                                <td style="max-width: 15px;">  <?php echo $fila['Orden_compra']; ?> </td>
                                <td>  <?php echo $fila['Cantidad_actual']; ?>  </td>
                                <td>  <?php echo $fila['Estatus']; ?>  </td>
                            </tr>
                            <?php
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
</body>
</html>