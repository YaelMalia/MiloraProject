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
        .recuadro {
            margin-bottom: 15px;
        }

        #CuadrosCentro {
            min-width: max-content;
            display: flex;
            flex-direction: row;
            text-align: center;
        }

        @media(max-width:799px) {
            #CuadrosCentro {
                flex-direction: column;
                text-align: left;
            }
        }

        #Head_resumida {
            display: static;
        }

        #Head_completa {
            display: none;
        }

        .sticky-header {
            position: sticky;
            top: 0;
            /* Fija el encabezado en la parte superior de la tabla */
            z-index: 2;
            /* Para que esté encima del contenido */
        }

        /* Ajusta el estilo del encabezado para que se vea bien */
        .sticky-header th {
            background-color: #adbdd3;
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
                    <input onclick="return OrdenesResFull(btnSelected);" type="button" class="btn btn-primary"
                        style="margin:0 auto; display:flex; min-width:140px; justify-content:center;" value="Buscar">
                </div>
            </div>

            <!-- Vista -->
            <div class="row g-2 col-md-12" style="display: flex; text-align:center; justify-content: center;">
                <center>
                    <h4 style="margin: 0 auto;">Selección de vista:</h4>
                </center>
                <div class="col-6">
                    <input checked onclick="ResOrFull(this);" type="radio" id="rbt-Res" name="Resumida"
                        value="Resumida">
                    <label for="Resumida" class="form-label">Consulta resumida</label>
                </div>
                <div class="col-6">
                    <input onclick="ResOrFull(this);" type="radio" id="rbt-Com" name="Completa" value="Completa">
                    <label for="Completa" class="form-label">Consulta completa</label>
                </div>

                <div class="col-md-12">
                    <div class="col-12" style="align-text:center">
                        <input onclick="return OrdenesResFull(btnSelected);" type="button" class="btn btn-primary"
                            style="margin:0 auto; display:flex; min-width:140px; justify-content:center;"
                            value="Mostrar">
                    </div>
                </div>

            </div>
            <!-- Fin vista -->

            <section class="d-flex justify-content-center;"
                style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
                <div class="table-responsive">
                    <table id="table_id" class="table table-success"
                        style="box-shadow: 0px 0px 24px 0px rgba(0,0,0,0.18); margin:0 auto; background-color: #d2dae6;">
                        <thead id="Head_resumida" class="sticky-header" style="background-color: #adbdd3;">
                            <tr>
                                <th scope="col" style="min-width:100px;">Fecha realizacion</th>
                                <th scope="col" style="min-width:100px;">Fecha límite</th>
                                <th scope="col">Dias atraso o restantes</th>
                                <th scope="col">Orden compra</th>
                                <th scope="col">No diseño</th>
                                <th scope="col">Piezas solicitadas</th>
                                <th scope="col">Piezas realizadas</th>
                                <th scope="col">Piezas restantes</th>
                                <th scope="col">Cliente</th>
                            </tr>
                        </thead>
                        <!-- Completa -->
                        <thead id="Head_completa" class="sticky-header" style="background-color: #adbdd3;">
                            <tr>
                                <th scope="col" style="min-width:100px;">Fecha realizacion</th>
                                <th scope="col" style="min-width:100px;">Fecha límite</th>
                                <th scope="col">Dias atraso o restantes</th>
                                <th scope="col">Orden compra</th>
                                <th scope="col">Estatus de orden</th>
                                <th scope="col">No diseño</th>
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
                            if (count($data) > 0) {
                                foreach ($data as $fila) {
                                    if (($fila["Estatus_orden"] != "Cerrada") && ($fila["DiasRestantes"] <= 20)) {
                                        ?>
                                        <tr>
                                            <td style="background-color:#F76D6D !important;">
                                                <?php echo $fila["Fecha_realizacion"]; ?>
                                            </td>
                                            <td style="background-color:#F76D6D !important;">
                                                <?php echo $fila["Fecha_limite"]; ?>
                                            </td>
                                            <td style="background-color:#F76D6D !important; font-weight:bold;">
                                                <?php if ($fila["DiasRestantes"] < 0) {
                                                    echo "Atraso: " . ($fila["DiasRestantes"] * -1);
                                                } else {
                                                    echo "Restan: " . $fila["DiasRestantes"];
                                                } ?>
                                            </td>
                                            <td style="background-color:#F76D6D !important;">
                                                <?php echo $fila["Orden_compra"]; ?>
                                            </td>
                                            <td style="background-color:#F76D6D !important;">
                                                <?php echo $fila["No_diseno"]; ?>
                                            </td>
                                            <td style="background-color:#F76D6D !important;">
                                                <?php echo $fila["Piezas_solicitadas"]; ?>
                                            </td>
                                            <td style="background-color:#F76D6D !important;">
                                                <?php echo $fila["Piezas_realizadas"]; ?>
                                            </td>
                                            <td style="background-color:#F76D6D !important;">
                                                <?php echo $fila["Piezas_restantes"]; ?>
                                            </td>
                                            <td style="background-color:#F76D6D !important;">
                                                <?php echo $fila["Cliente"]; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    if (($fila["Estatus_orden"] != "Cerrada") && ($fila["DiasRestantes"] > 20 && $fila["DiasRestantes"] <= 80)) {
                                        ?>
                                        <tr>
                                            <td style="background-color:#F89351 !important;">
                                                <?php echo $fila["Fecha_realizacion"]; ?>
                                            </td>
                                            <td style="background-color:#F89351 !important;">
                                                <?php echo $fila["Fecha_limite"]; ?>
                                            </td>
                                            <td style="background-color:#F89351 !important; font-weight:bold;">
                                                <?php echo "Restan: " . $fila["DiasRestantes"]; ?>
                                            </td>
                                            <td style="background-color:#F89351 !important;">
                                                <?php echo $fila["Orden_compra"]; ?>
                                            </td>
                                            <td style="background-color:#F89351 !important;">
                                                <?php echo $fila["No_diseno"]; ?>
                                            </td>
                                            <td style="background-color:#F89351 !important;">
                                                <?php echo $fila["Piezas_solicitadas"]; ?>
                                            </td>
                                            <td style="background-color:#F89351 !important;">
                                                <?php echo $fila["Piezas_realizadas"]; ?>
                                            </td>
                                            <td style="background-color:#F89351 !important;">
                                                <?php echo $fila["Piezas_restantes"]; ?>
                                            </td>
                                            <td style="background-color:#F89351 !important;">
                                                <?php echo $fila["Cliente"]; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    if ((($fila["Estatus_orden"] != "Cerrada")) && ($fila["DiasRestantes"] > 80)) {
                                        ?>
                                        <tr>
                                            <td style="background-color:#63E346 !important;">
                                                <?php echo $fila["Fecha_realizacion"]; ?>
                                            </td>
                                            <td style="background-color:#63E346 !important;">
                                                <?php echo $fila["Fecha_limite"]; ?>
                                            </td>
                                            <td style="background-color:#63E346 !important; font-weight:bold;">
                                                <?php echo "Restan: " . $fila["DiasRestantes"]; ?>
                                            </td>
                                            <td style="background-color:#63E346 !important;">
                                                <?php echo $fila["Orden_compra"]; ?>
                                            </td>
                                            <td style="background-color:#63E346 !important;">
                                                <?php echo $fila["No_diseno"]; ?>
                                            </td>
                                            <td style="background-color:#63E346 !important;">
                                                <?php echo $fila["Piezas_solicitadas"]; ?>
                                            </td>
                                            <td style="background-color:#63E346 !important;">
                                                <?php echo $fila["Piezas_realizadas"]; ?>
                                            </td>
                                            <td style="background-color:#63E346 !important;">
                                                <?php echo $fila["Piezas_restantes"]; ?>
                                            </td>
                                            <td style="background-color:#63E346 !important;">
                                                <?php echo $fila["Cliente"]; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    if ($fila["Estatus_orden"] == "Cerrada") {
                                        ?>
                                        <tr>
                                            <td style="background-color:#E1E1E1 !important;">
                                                <?php echo $fila["Fecha_realizacion"]; ?>
                                            </td>
                                            <td style="background-color:#E1E1E1 !important;">
                                                <?php echo $fila["Fecha_limite"]; ?>
                                            </td>
                                            <td style="background-color:#E1E1E1 !important; font-weight:bold;">
                                                <?php echo "Cerrada"; ?>
                                            </td>
                                            <td style="background-color:#E1E1E1 !important;">
                                                <?php echo $fila["Orden_compra"]; ?>
                                            </td>
                                            <td style="background-color:#E1E1E1 !important;">
                                                <?php echo $fila["No_diseno"]; ?>
                                            </td>
                                            <td style="background-color:#E1E1E1 !important;">
                                                <?php echo $fila["Piezas_solicitadas"]; ?>
                                            </td>
                                            <td style="background-color:#E1E1E1 !important;">
                                                <?php echo $fila["Piezas_realizadas"]; ?>
                                            </td>
                                            <td style="background-color:#E1E1E1 !important;">
                                                <?php echo $fila["Piezas_restantes"]; ?>
                                            </td>
                                            <td style="background-color:#E1E1E1 !important;">
                                                <?php echo $fila["Cliente"]; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            } else {
                                ?>
                                <script>
                                    alertify.alert("¡Oops!", "Vaya, parece que no hay ordenes de compra");
                                </script>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </form>
    </section>

</body>
<script>
    var btnSelected = "Resumida";
    function ResOrFull(btn) {
        btnSelected = btn.name;
        // alert(btnSelected);
        if (btnSelected == "Resumida") {
            document.getElementById("rbt-Com").checked = false;

        } else if (btnSelected == "Completa") {
            document.getElementById("rbt-Res").checked = false;
        }

    }</script>

</html>