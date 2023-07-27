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
                    <input type="date" name="De_fecha" class="form-control"
                    value="<?php if(isset($_POST['De_fecha'])){ echo $_POST['De_fecha']; } ?>">
                </div>
            </div>
            <div class="row g-2 col-md-6" style="display: flex; align-items: center; justify-content: center;">
                <div class="col-md-12" style="display: flex; align-items: center; justify-content: center;">
                    <label for="De_fecha" class="form-label"><b>Hasta el Dia</b></label>
                </div>
                <div class="col-md-12" style="display: flex; align-items: center; justify-content: center;">
                    <input type="date" name="A_fecha" class="form-control"
                    value="<?php if(isset($_POST['A_fecha'])){ echo $_POST['A_fecha']; } ?>">
                </div>
            </div>
            <div class="col-md-4">
                <label><b>Orden de compra</b></label>
                <input type="text" name="Orden_c"
                    value="<?php if(isset($_POST['Orden_c'])){ echo $_POST['Orden_c']; } ?>">
            </div>
            <div class="col-md-4">
                <label><b>No diseño</b></label>
                <input type="text" name="Nodiseño"
                    value="<?php if(isset($_POST['Nodiseño'])){ echo $_POST['Nodiseño']; } ?>">
            </div>
            <div class="col-md-4">
                <label><b>Cliente</b></label>
                <input type="ClienteC" name="ClienteC"
                    value="<?php if(isset($_POST['ClienteC'])){ echo $_POST['ClienteC']; } ?>">
            </div>
            <div class="col-md-12">
                <label><b></b></label> <br>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </section>
    <section class="d-flex justify-content-center" style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;
        background-color: #F21616;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 1);">
        <table id="table_id" class="table table-success table-striped">
            <thead>
                <tr>
                    <th>Fecha_realizacion</th>
                    <th>Fecha_finalizacion</th>
                    <th>Orden_compra</th>
                    <th>No_diseno</th>
                    <th>Piezas_solicitadas</th>
                    <th>Piezas_realizadas</th>
                    <th>Piezas_restantes</th>
                    <th>Cliente</th>
                </tr>
            </thead>
            <tbody id="Cuerpecito">

    
<?php
require 'cn.php';
    $De_fecha='';
    $A_fecha='';
    $Orden='';
    $Nodiseño='';
    $ClienteC='';
    $De_fecha = $_POST['De_fecha'];
    $A_fecha = $_POST['A_fecha'];
    $Orden = $_POST['Orden_c'];
    $Nodiseño = $_POST['Nodiseño'];
    $ClienteC = $_POST['ClienteC'];


$query= "SELECT Fecha_realizacion, Fecha_finalizacion, Orden_compra, No_diseno, Piezas_solicitadas, Piezas_realizadas, Piezas_restantes, Cliente FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN '$De_fecha' AND '$A_fecha')";
if($Orden !=''){

    $query .= "AND (Orden_compra LIKE '$Orden')";

}
if($Nodiseño != ''){
    $query .= "AND (No_diseno LIKE '$Nodiseño')";
}
if($ClienteC !=''){
    $query .= "AND (Cliente LIKE '$ClienteC')";
}

$resultado= $mysqli->query($query);

foreach($resultado as $fila){
    ?>
    <tr>
        <td><?php echo $fila['Fecha_realizacion']?></td>
        <td><?php echo $fila['Fecha_finalizacion']?></td>
        <td><?php echo $fila['Orden_compra']?></td>
        <td><?php echo $fila['No_diseno']?></td>
        <td><?php echo $fila['Piezas_solicitadas']?></td>
        <td><?php echo $fila['Piezas_realizadas']?></td>
        <td><?php echo $fila['Piezas_restantes']?></td>
        <td><?php echo $fila['Cliente']?></td>
    </tr>
<?php
}
?>
        </tbody>
    </table>
</section>
</body>
</html>