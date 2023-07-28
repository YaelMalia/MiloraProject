<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Diseños</title>
</head>

<body style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
   
    <section class="d-flex justify-content-center"
        style="padding-left: 20px; max-height: 600px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; background-color: #d2dae6;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);" >
        <form id ="form_nuevoD" class="row g-4" style="overflow: scroll;">
            <h2 style="text-align: center;">Consultar diseño de pieza</h2>
            <h5 style="text-align: center;">Buscar por:</h5>
            <div class="col-md-4">
                <input checked onclick="checkRbt(this);" type="radio" id="rbt-diseno" name="noDiseno" value="noDis">
                <label for="No_diseñoFD" class="form-label">Numero de diseño</label>
                <input type="text" class="form-control"  id="No_disenoFD" placeholder="Numero de diseño" required>
            </div>
            <div class="col-md-4">
                <input onclick="checkRbt(this);" type="radio" id="rbt-codigomp" name="Codemp" value="Codigomp">
                <label for="Codigo_MP" class="form-label">Código de materia prima</label>
                <input disabled type="text" class="form-control" id="Codigo_MP" placeholder="Código de materia prima" required>
            </div>
            
            <!-- ------------------------------------------------------------------------------------------ -->
            <div class="col-4" >
            </div>
            <div class="col-4" >
                <input  onclick="return busqueda_Filtrada_Piezas(btnSelected);"  type="button" class="btn btn-primary col-12" style="height: 50px; min-height: auto; font-size: auto;" value="Buscar">
            </div>
            <div class="col-4" >
            </div>

            <!--  tabla resultante -->
            <div class="col-12" id="tableResult">
                <table class="table" style="text-align: center; box-shadow: 0px 0px 24px 0px rgba(0,0,0,0.18); background-color: #d2dae6; ">
                    <thead style="background-color: #adbdd3; ">
                      <tr>
                        <th scope="col">No. diseño</th>
                        <th scope="col">Descripción de M.P.</th>
                        <th scope="col">Código de M.P.</th>
                        <th scope="col">Orden de compra</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Corte</th>
                        <th scope="col">Dobles</th>
                        <th scope="col">Rolado</th>
                        <th scope="col">Bisel</th>
                        <th scope="col">Taladro</th>
                        <th scope="col">Prensa</th>
                      </tr>
                    </thead>
                    <tbody id="cuerpoTabla">
                      <?php

                        require_once("../conexionBD/Consultas.php");
                        $miloraObj = MiloraClass::singleton();
                        $data = $miloraObj->GetAllPiezas();
                        if(count($data)>0){
                          foreach($data as $fila){
                            ?>
                            <tr style="max-height: 10px;">
                                <th scope="row">  <?php echo $fila['No_diseno']; ?>  </th>
                                <td style="max-width: 15px;">  <?php echo $fila['Descripcion_MP']; ?> </td>
                                <td>  <?php echo $fila['Codigo_MP']; ?>  </td>
                                <td>  <?php echo $fila['Orden_compra']; ?>  </td>
                                <td>  <?php echo $fila['Cliente']; ?>  </td>
                                <td>  <?php echo $fila['Corte']; ?>  </td>
                                <td>  <?php echo $fila['Dobles']; ?>  </td>
                                <td>  <?php echo $fila['Rolado']; ?>  </td>
                                <td>  <?php echo $fila['Bisel']; ?>  </td>
                                <td>  <?php echo $fila['Taladro']; ?>  </td>
                                <td>  <?php echo $fila['Prensa']; ?>  </td>
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

                      ?>

                    </tbody>
                  </table>
            </div>
        </form>
    </section>
</body>
    <script>
        
        var btnSelected = "noDiseno";
        function checkRbt(btn){
            btnSelected = btn.name;
            // alert(btnSelected);
            if(btnSelected == "noDiseno"){
                document.getElementById("rbt-codigomp").checked = false;
                document.getElementById("Codigo_MP").disabled = true;
                document.getElementById("No_disenoFD").disabled = false;
                
            }else if(btnSelected == "Codemp"){
                document.getElementById("rbt-diseno").checked = false;
                document.getElementById("No_disenoFD").disabled = true;
                document.getElementById("Codigo_MP").disabled = false;
            }
            
        }

       
    </script>

</html>