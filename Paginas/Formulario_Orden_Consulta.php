<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Busqueda de ordenes</title>
</head>
<body>
<section class="d-flex justify-content-center" style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;
        background-color: #d2dae6;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);">
        <form action="" class="row g-4" name="foemulario" method="POST">
            <div class="row g-2 col-md-6" style="display: flex; align-items: center; justify-content: center;">
                <div class="col-md-12" style="display: flex; align-items: center; justify-content: center;">
                    <label for="De_fecha" class="form-label"><b>Del Dia </b></label>
                </div>
                <div class="col-md-12" style="display: flex; align-items: center; justify-content: center;">
                    <input type="date" name="De_fecha" class="form-control">
                </div>
            </div>
            <div class="row g-2 col-md-6" style="display: flex; align-items: center; justify-content: center;">
                <div class="col-md-12" style="display: flex; align-items: center; justify-content: center;">
                    <label for="De_fecha" class="form-label"><b>Hasta el Dia</b></label>
                </div>
                <div class="col-md-12" style="display: flex; align-items: center; justify-content: center;">
                    <input type="date" name="A_fecha" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <label><b>Orden de compra</b></label>
                <input type="text" name="Orden_c">
            </div>
            <div class="col-md-4">
                <label><b>No diseño</b></label>
                <input type="text" name="Nodiseno">
            </div>
            <div class="col-md-4">
                <label><b>Cliente</b></label>
                <input type="ClienteC" name="ClienteC">
            </div>
            <div class="col-md-12">
                <label><b></b></label> <br>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </section>
    <section class="d-flex justify-content-center" style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;
        background-color: #F21616;   box-shadow: 0 2px 5px rgba(0, 0, 0, 1);">
        <table id="table_id" class="table table-success table-striped">
            <thead id="Head_resumida" style="display:none;">
                <tr>
                    <th>Fecha realizacion</th>
                    <th>Fecha límite</th>
                    <th>Orden compra</th>
                    <th>No diseno</th>
                    <th>Piezas solicitadas</th>
                    <th>Piezas realizadas</th>
                    <th>Piezas restantes</th>
                    <th>Cliente</th>
                </tr>
            </thead>
            <!-- Completa -->
            <thead id="Head_completa" style="display:block;">
                <tr>
                    <th>Fecha realizacion</th>
                    <th>Fecha límite</th>
                    <th>Orden compra</th>
                    <th>No diseno</th>
                    <th>Piezas solicitadas</th>
                    <th>Piezas realizadas</th>
                    <th>Piezas restantes</th>
                    <th>Piezas cortadas</th>
                    <th>Piezas realizadas</th>
                    <th>Piezas restantes</th>
                    <th>Cliente</th>
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

                        }
                    }
                ?>
        </tbody>
    </table>
</section>
</body>
</html>