<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
   
    <section class="d-flex justify-content-center"
        style="padding-left: 20px; max-height: 600px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; background-color: #d2dae6;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);" >
        <form id ="form_nuevoD" class="row g-4" style="overflow: scroll;">
            <h2 style="text-align: center;">Seguimiento de procesos de producción</h2>
            
            <!--  tabla resultante -->
            <div class="col-12" id="tableResult">
                <table class="table" id="TablaInfo" style="text-align: center; box-shadow: 0px 0px 24px 0px rgba(0,0,0,0.18); background-color: #d2dae6; ">
                    <thead id="headTable" style="background-color: #adbdd3; ">
                      <tr>
                        <th scope="col">No. diseño</th>
                        <th scope="col">Orden de compra</th>
                        <th scope="col">Cantidad de piezas</th>
                        <th scope="col">Estatus</th>
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