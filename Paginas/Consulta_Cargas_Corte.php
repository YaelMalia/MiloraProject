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

    <script src="../Script/table2excel.js"></script>
    <script src="../Script/xlsx.mini.flow.js"></script>

    <style>
      .modalCorte{
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
      
    </style>
</head>
<body id="cuerpoP" style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; ">
   
    <!-- Modal para registro de producción -->
    <div class="modalCorte" id="modalCorte">
            <h2 style="text-align: center;">Reportar carga final</h2>
            <div style="text-align: center;"><p style="font-size:18px;">Porcentaje de productividad: </p><p id="porcentaje" style="text-decoration: underline; font-size:20px;">0%</p></div>
            <div class="row g-3" style="margin-top:30px;">

        <div class="col-md-4">
            <label for="CantidadRep" class="form-label">Cantidad reportada</label>
            <input type="number" class="form-control" id="CantidadRep" placeholder="Cantidad reportada" required>
        </div>
<!--  -->
        <div class="col-md-4">
            <label for="Placa_cortadaT" class="form-label">Placas cortadas</label>
            <input type="text" class="form-control" id="Placa_cortadaT" placeholder="Placas cortadas" required>
        </div>

        <div class="col-md-4">
            <label for="HorasT" class="form-label">Horas trabajadas</label>
            <input type="text" class="form-control" id="HorasT" placeholder="Horas de trabajadas para este proceso" required>
        </div>
        
        <div class="col-md-12">
            <label for="Observaciones" class="form-label">Observaciones</label>
            <textarea name="Observaciones" class="form-control" id="Observaciones" cols="auto" rows="1" placeholder="(En caso de no haber observaciones, dejarlo vacío)"></textarea>
        </div>
        
        <input id="btn-Cancel" onclick="" type="button" class="btn btn-danger col-md-4" value="Cancelar">
                <div class="col-md-4"></div>    
        <input onclick="ReportarCarga_Corte();" type="button" class="btn btn-success col-md-4" value="Aceptar">

        </div>
      </div>
    <!-- Fin modal -->

    <section id="DetrasP" class="d-flex justify-content-center"
        style="padding-left: 20px; max-height: 600px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; background-color: #d2dae6;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);" >
        <form id ="form_nuevoD" class="row g-4" style="overflow:scroll;">
        <h2 style="text-align: center;">Cargas para corte</h2>
        <!-- <center><p id="p-dia" style="font-size:20px;">Procesos activos para el día de hoy</p></center> -->
            <!--  tabla resultante -->
            <!--  -->
            <p style="text-align: center; font-size:16px;">Filtrar cargas de trabajo por día</p>
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <!-- <label for="FechaCarga" class="form-label">Fecha Limite</label> -->
                <input type="date" class="form-control" id="FechaCarga" required>
            </div>
            <div class="col-md-3">
            <div class="col-md-12" style="align-text:center">
                        <input onclick="" type="button" class="btn btn-primary" style="margin:0 auto; display:flex; min-width:140px; justify-content:center;" value="Buscar">
                    </div>
            </div>
            <div class="col-md-3"></div>

            <div class="col-md-4">
                    <div class="col-4" style="align-text:center">
                        <input onclick="RefreshCC();" type="button" class="btn btn-primary" style="margin:0 auto; display:flex; min-width:140px; justify-content:center;" value="Recargar">
                    </div>
                </div>

               <!-- Botón flotante excel -->

            <a class="float" id="botonExcel">
              <i class="fa my-float">
                <img src="../Images/excel-logo.png" alt="Excel logo" style="width: 40px; height:40px; margin-top:10px; margin-left:-3px; " srcset="">
              </i>
            </a>

            <!-- Fin botón flotante -->

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
                                <td style="background-color:#7EA8ED !important;"><input onclick="mostrarModalCorte(this);" id="btn-check" type="button" class="btn btn-success" value="✅"></td>
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
                                <td style="background-color:#7EA8ED !important;"><?php if($fila["Porcentaje_cumplimiento"] == 0){echo "- - -";}?></td>
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
                                <td style="background-color:#F79C59 !important;"><input onclick="mostrarModalCorte(this);" id="btn-check" type="button" class="btn btn-success" value="✅"></td>
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
                            alertify.alert("¡Vaya!", "Parece que no hay cargas de trabajo");
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
      $("#modalCorte").hide(800);
      document.getElementById("DetrasP").style.filter = "blur(0) grayscale(0%)";
      document.getElementById("DetrasP").style.pointerEvents = "auto";
    });
   </script>

   <script>
      $("#botonExcel").click(function() {
        // var table = document.getElementById("TablaInfo");

        //     // Crear un nuevo libro de Excel
        //     var wb = XLSX.utils.book_new();
        //     // Crear una hoja en el libro
        //     var ws = XLSX.utils.table_to_sheet(table);

        //     // Aplicar estilo personalizado a la primera fila (encabezado)
        //     for (var i = 0; i < table.rows[0].cells.length; i++) {
        //         var cell = ws[XLSX.utils.encode_cell({ r: 0, c: i })];
        //         if (cell && cell.s) {
        //             cell.s.font = { bold: true };
        //             cell.s.fill = { fgColor: { rgb: "0000FF" } }; // Color azul
        //         }
        //     }

        //     // Agregar la hoja al libro
        //     XLSX.utils.book_append_sheet(wb, ws, "Hoja1");

        //     // Exportar el libro como un archivo Excel
        //     XLSX.writeFile(wb, "Excel-existencias.xlsx");

        var table = document.getElementById("TablaInfo");

        // Obtener el número de filas y columnas en la tabla
            var numRows = table.rows.length;
            var numColumns = table.rows[0].cells.length;


            // Excluir la segunda columna (índice 1) de la hoja de Excel
            for (var i = 0; i < numRows; i++) {
                table.rows[i].deleteCell(1); // Eliminar la segunda celda (índice 1)
            }

            // Crear un nuevo libro de Excel
            var wb = XLSX.utils.book_new();
            // Crear una hoja en el libro
            var ws = XLSX.utils.table_to_sheet(table);

            // Agregar la hoja al libro
            XLSX.utils.book_append_sheet(wb, ws, "Hoja1");

            // Exportar el libro como un archivo Excel
            XLSX.writeFile(wb, "Reporte-Cargas-Corte.xlsx");

            RefreshCC();
    });
    </script>
</body>
</html>