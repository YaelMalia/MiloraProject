<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="GET">
    
    <div>
        <div>
            <div>
                <label><b>Del Dia</b></label>
                <input type="date" name="De_fecha" value="<?php if(isset($_GET['De_fecha'])){ echo $_GET['De_fecha']; } ?>">
            </div>
        </div>
        <div>
            <div>
                <label><b> Hasta  el Dia</b></label>
                <input type="date" name="A_fecha" value="<?php if(isset($_GET['A_fecha'])){ echo $_GET['A_fecha']; } ?>">
            </div>
        </div>
        <div>
            <div>
                <label><b>Orden de compra</b></label>
                <input type="text" name="Orden_c" value="<?php if(isset($_GET['Orden_c'])){ echo $_GET['Orden_c']; } ?>">
            </div>
        </div>
        <div>
            <div>
                <label><b></b></label> <br>
              <button type="submit" >Buscar</button>
            </div>
        </div>
    </div>
    <br>
</form>
<table id= "table_id">
                            <thead>
                            <tr >
                            <th>Fecha_realizacion</th>
                        <th>Fecha_finalizacion</th>
                        <th>Orden_compra</th>
                        <th>No_diseno</th>
                        <th>Piezas_solicitadas</th>
                        <th>Piezas_realizadas</th>
                        <th>Piezas_restantes</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
require 'cn.php';
$De_fecha = $_GET['De_fecha'];
$A_fecha = $_GET['A_fecha'];
$Orden = $_GET['Orden_c'];
$query= "SELECT Fecha_realizacion, Fecha_finalizacion, Orden_compra, No_diseno, Piezas_solicitadas, Piezas_realizadas, Piezas_restantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN '$De_fecha' AND '$A_fecha') AND Orden_compra LIKE '$Orden'";
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
    </tr>
<?php
}
?>
</body>
</html>