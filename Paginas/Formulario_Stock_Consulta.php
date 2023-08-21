<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Stock</title>
    <script src="../Script/Formularios_Js/FormsScripts.js"></script>
    <script src="../Script/jquery.js"></script>
    <script src="../Script/jquery-3.5.1.min.js"></script>
    <script src="../Script/table2excel.js"></script>
    
    
    <style>
.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#2e6930;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;
  transition: 0.5s;
}

.float:hover{
  background-color:#1e4620;
  transform: scale(1.04);
}

/* .my-float{
	margin-top:22px;
} */
    </style>
</head>

<body style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
   
    <section class="d-flex justify-content-center"
        style="padding-left: 20px; max-height: 600px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; background-color: #d2dae6;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);" >
        <form id ="form_nuevoD" class="row g-4" style="overflow: scroll;">
            <h2 style="text-align: center;">Consultar existencias en almacen</h2>
            <h5 style="text-align: center;">Buscar por:</h5>

            <div class="col-md-6">
                <label for="No_diseñoSt" class="form-label">Numero de diseño</label>
                <input type="text" class="form-control"  id="No_disenoSt" placeholder="Numero de diseño" required>
            </div>
            <div class="col-md-6">
                <label for="EstatusSt" class="form-label">Estatus de pieza</label>
                <input type="text" class="form-control" id="EstatusSt" placeholder="Estatus de pieza" required>
            </div>
            
            <!-- ------------------------------------------------------------------------------------------ -->
            <div class="col-4"></div>
            <div class="col-4">
                <input  onclick="return buscarStock();"  type="button" class="btn btn-primary col-12" style="height: 50px; min-height: auto; font-size: auto;" value="Buscar">
            </div>
            <div class="col-4"></div>
            
            <!-- Botón flotante excel -->

            <a class="float" id="botonExcel">
              <i class="fa my-float">
                <img src="../Images/excel-logo.png" alt="Excel logo" style="width: 40px; height:40px; margin-top:10px; margin-left:-3px; " srcset="">
              </i>
            </a>

            <!-- Fin botón flotante -->


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
                        $data = $miloraObj->GetAllStock();
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
  
  $("#botonExcel").click(function(){
            var table2excel = new Table2Excel();
            table2excel.export(document.getElementById("TablaInfo"));
    });
</script>

</html>