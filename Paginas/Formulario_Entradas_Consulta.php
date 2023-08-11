<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Entradas</title>
</head>

<body style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
   
    <section class="d-flex justify-content-center"
        style="padding-left: 20px; max-height: 600px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; background-color: #d2dae6;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);" >
        <form id ="form_nuevoD" class="row g-4" style="overflow: scroll;">
            <h2 style="text-align: center;">Consultar entradas de almacen</h2>
            <h5 style="text-align: center;">Buscar por:</h5>
            <div class="col-md-4">
                <label for="FechaEn" class="form-label">Fecha</label>
                <input type="date" class="form-control"  id="FechaEn" required>
            </div>
            <div class="col-md-4">
                <label for="No_diseñoEn" class="form-label">Numero de diseño</label>
                <input type="text" class="form-control"  id="No_diseñoEn" placeholder="Numero de diseño" required>
            </div>
            <div class="col-md-4">
                <label for="Orden_compraEn" class="form-label">Orden de compra</label>
                <input type="text" class="form-control" id="Orden_compraEn" placeholder="Orden de compra" required>
            </div>
            
            <!-- ------------------------------------------------------------------------------------------ -->
            <div class="col-4" >
            </div>
            <div class="col-4" >
                <input  onclick="return BuscarEntradas(btnSelected);"  type="button" class="btn btn-primary col-12" style="height: 50px; min-height: auto; font-size: auto;" value="Buscar">
            </div>
            <div class="col-4" >
            </div>

            <!--  tabla resultante -->
            <div class="col-12" id="tableResult">
                <table class="table" style="text-align: center; box-shadow: 0px 0px 24px 0px rgba(0,0,0,0.18); background-color: #d2dae6; ">
                    <thead style="background-color: #adbdd3; ">
                      <tr>
                        <th scope="col">Fecha deentrada</th>
                        <th scope="col">No. diseño</th>
                        <th scope="col">Orden de compra</th>
                        <th scope="col">Cantidad entrada</th>
                      </tr>
                    </thead>
                    <tbody id="cuerpoTabla">
                      <!-- <?php

                        require_once("../conexionBD/Consultas.php");
                        $miloraObj = MiloraClass::singleton();
                        $data = $miloraObj->GetAllPiezas();
                        if(count($data)>0){
                          foreach($data as $fila){
                            ?>
                            <tr style="max-height: 10px;">
                                <th scope="row">  <?php echo $fila['Fecha_entrada']; ?>  </th>
                                <td style="max-width: 15px;">  <?php echo $fila['No_diseno']; ?> </td>
                                <td>  <?php echo $fila['Orden_compra']; ?>  </td>
                                <td>  <?php echo $fila['Cantidad_entrada']; ?>  </td>
                            </tr>
                            <?php
                          }
                        }
                        else{
                          ?>
                          <script>
                            alertify.alert("¡Oops!", "Parece que no hay piezas en existencia");
                          </script>
                        <?php
                        }

                      ?> -->

                    </tbody>
                  </table>
            </div>
        </form>
    </section>
</body>

</html>