<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Busqueda de ordenes</title>
    <script src="../Script/Formularios_Js/FormsScripts.js"></script>
    <script src="../Script/jquery.js"></script>
    <script src="../Script/jquery-3.5.1.min.js"></script>
    <style>
        .recuadro{
            margin-bottom:15px;
        }

        #CuadrosCentro{
            min-width:max-content; display:flex; flex-direction:row; text-align:center;
        }

        @media(max-width:799px){
            #CuadrosCentro{
                flex-direction:column;
                text-align:left;
            }
        }

        #Head_resumida{
            display:static;
        }

        #Head_completa{
            display:none;
        }
    </style>
</head>
<body>
<section class="d-flex justify-content-center" style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;
        background-color: #d2dae6;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);">
        <form action="" class="row g-4" name="foemulario" method="POST" style="overflow:scroll; padding:5px;">
        <h2 style="text-align: center;">Consultar ordenes</h2>
            <div class="row g-2 col-md-6" style="display: flex; align-items: center; justify-content: center;">
                <div class="col-md-12" style="display: flex; align-items: center; justify-content: center;">
                    <label for="De_fecha" class="form-label"><b>Del día </b></label>
                </div>
                <div class="col-md-12" style="display: flex; align-items: center; justify-content: center;">
                    <input type="date" name="De_fecha" id="De_fecha" class="form-control">
                </div>
            </div>
            <div class="row g-2 col-md-6" style="display: flex; align-items: center; justify-content: center;">
                <div class="col-md-12" style="display: flex; align-items: center; justify-content: center;">
                    <label for="De_fecha" class="form-label"><b>Hasta el día</b></label>
                </div>
                <div class="col-md-12" style="display: flex; align-items: center; justify-content: center;">
                    <input type="date" name="A_fecha" class="form-control" id="Hasta_fecha">
                </div>
            </div>
           <div id="CuadrosCentro" style="">
           <div class="col-md-4 recuadro" style="">
                <label>Orden de compra</label>
                <input type="text" class="form-control" name="Orden_c" id="Orden_c">
            </div>
            <div class="col-md-4 recuadro" style="">
                <label>No diseño</label>
                <input type="text" class="form-control" name="Nodiseno" id="Nodiseno">
            </div>
            <div class="col-md-4 recuadro" style="">
                <label>Cliente</label>
                <input type="text" class="form-control" name="ClienteC" id="Cliente">    
        </div>
            </div>
            <div class="col-md-12">
                <div class="col-12" style="align-text:center">
                <input onclick="return OrdenesResFull(btnSelected);" type="button" class="btn btn-primary" style="margin:0 auto; display:flex; min-width:140px; justify-content:center;" value="Buscar">
                </div>
            </div>

            <!-- Vista -->
            <div class="row g-2 col-md-12" style="display: flex; text-align:center; justify-content: center;">
            <center><h4 style="margin: 0 auto;">Selección de vista:</h4></center>
                <div class="col-6">
                    <input checked onclick="ResOrFull(this);" type="radio" id="rbt-Res" name="Resumida" value="Resumida">
                    <label for="Resumida" class="form-label">Consulta resumida</label>
                </div>
                <div class="col-6">
                    <input onclick="ResOrFull(this);" type="radio" id="rbt-Com" name="Completa" value="Completa">
                    <label for="Completa" class="form-label">Consulta completa</label>
                </div>

                <div class="col-md-12">
                    <div class="col-12" style="align-text:center">
                        <input onclick="return OrdenesResFull(btnSelected);" type="button" class="btn btn-primary" style="margin:0 auto; display:flex; min-width:140px; justify-content:center;" value="Mostrar">
                    </div>
                </div>

            </div>
            <!-- Fin vista -->

            <section class="d-flex justify-content-center;" style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;
        background-color: #d2dae6;">
        <table id="table_id" class="table table-success table-striped" style="box-shadow: 0px 0px 24px 0px rgba(0,0,0,0.18); margin:0 auto;">
            <thead id="Head_resumida">
                <tr>
                    <th scope="col">Fecha realizacion</th>
                    <th scope="col">Fecha límite</th>
                    <th scope="col">Orden compra</th>
                    <th scope="col">No diseno</th>
                    <th scope="col">Piezas solicitadas</th>
                    <th scope="col">Piezas realizadas</th>
                    <th scope="col">Piezas restantes</th>
                    <th scope="col">Cliente</th> 
                </tr>
            </thead>
            <!-- Completa -->
            <thead id="Head_completa">
                <tr>
                    <th scope="col">Fecha realizacion</th>
                    <th scope="col">Fecha límite</th>
                    <th scope="col">Orden compra</th>
                    <th scope="col">Estatus de orden</th>
                    <th scope="col">No diseno</th>
                    <th scope="col">Piezas solicitadas</th>
                    <th scope="col">Piezas realizadas</th>
                    <th scope="col">Piezas restantes</th>
                    <th scope="col">Cliente</th> 
                    <th scope="col">Piezas cortadas</th>
                    <th scope="col">Piezas dobladas</th>
                    <th scope="col">Piezas roladas</th>
                    <th scope="col">Piezas biseladas</th>
                    <th scope="col">Piezas taladradas</th>
                    <th scope="col">Piezas prensadas</th>
                </tr>
            </thead>
            <!--  -->
            <tbody id="Cuerpo_tabla">
                <?php
                require_once("../conexionBD/Consultas.php");
                $miloraObj = MiloraClass::singleton();
                $data = $miloraObj->GetAllOrdenes();
                    if(count($data)>0){
                        foreach($data as $fila){
                            ?>
                            <tr>
                                <td><?php echo $fila["Fecha_realizacion"]; ?></td>
                                <td><?php echo $fila["Fecha_limite"]; ?></td>
                                <td><?php echo $fila["Orden_compra"]; ?></td>
                                <td><?php echo $fila["No_diseno"]; ?></td>
                                <td><?php echo $fila["Piezas_solicitadas"]; ?></td>
                                <td><?php echo $fila["Piezas_realizadas"]; ?></td>
                                <td><?php echo $fila["Piezas_restantes"]; ?></td>
                                <td><?php echo $fila["Cliente"]; ?></td>
                            </tr>
                            <?php
                        }
                    }else{
                        ?>
                        <script>
                            alertify.alert("¡Oops!", "Vaya, parece que no hay ordenes de compra");
                        </script>
                        <?php
                    }
                ?>
        </tbody>
    </table>
</section>


        </form>
    </section>
   
</body>
<script>
        var btnSelected = "Resumida";
        function ResOrFull(btn){
            btnSelected = btn.name;
            // alert(btnSelected);
            if(btnSelected == "Resumida"){
                document.getElementById("rbt-Com").checked = false;
                
            }else if(btnSelected == "Completa"){
                document.getElementById("rbt-Res").checked = false;
            }
            
        }</script>
</html>