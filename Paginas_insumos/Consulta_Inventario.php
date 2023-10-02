<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Busqueda de insumos</title>
    <script src="../Script/Formularios_Js/ScriptsInsumos.js"></script>
    <script src="../Script/jquery.js"></script>
    <script src="../Script/jquery-3.5.1.min.js"></script>
</head>
<body>
<section class="justify-content-center" style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;
        background-color: #d2dae6;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);">
        <form action="" class="row g-1" name="foemulario" method="POST" style=" padding:5px;">
        <h2 style="text-align: center;">Consultar insumos</h2>
        <div class="col-12" style="align-text:center">
            <input onclick="RefreshInventario();" type="button" class="btn btn-primary" style="margin:0 auto; display:flex; min-width:140px; justify-content:center;" value="Recargar">
        </div>
        <section class="d-flex" style="padding-top: 20px; overflow:scroll; padding-bottom: 20px; padding-right: 20px;">
        <div class="col-md-12 table-responsive">
        <table class="table" id="TablaInfo" style="text-align:center; box-shadow: 0px 0px 24px 0px rgba(0,0,0,0.18); background-color: #d2dae6; ">
            <thead id="Head_resumida" style="background-color: #adbdd3;">
                <tr>
                    <th scope="col">Identificador</th>
                    <th scope="col">Nombre de insumo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Especificaciones</th>
                    <th scope="col">Categoria</th>
                </tr>
            </thead>
            <!-- Completa -->
            <tbody id="Cuerpo_tabla">
                <?php
                require_once("../conexionBD/Consultas_insumos.php"); //Archivo para la conexion a la base de datos y la ocnsulta
                $miloraObj = InsumosClass::singleton();//
                $data = $miloraObj->GetAllInsumos(); //Aqui se ejecuta una query para obtener todo
                    if(count($data)>0){
                        foreach($data as $fila){ //Aqui es para llenar los datos
                            if($fila["Cantidad"]<=5){
                            ?>
                            <tr>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Id_producto"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Nombre_insumo"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Descripcion"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Cantidad"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["Especificaciones"]; ?></td>
                                <td style="background-color:#F76D6D !important;"><?php echo $fila["TipoCategoria"]; ?></td>
                            </tr>
                            <?php
                            }else if($fila["Cantidad"]<=10){
                                ?>
                                <tr>
                                    <td style="background-color:#F89351 !important;"><?php echo $fila["Id_producto"]; ?></td>
                                    <td style="background-color:#F89351 !important;"><?php echo $fila["Nombre_insumo"]; ?></td>
                                    <td style="background-color:#F89351 !important;"><?php echo $fila["Descripcion"]; ?></td>
                                    <td style="background-color:#F89351 !important;"><?php echo $fila["Cantidad"]; ?></td>
                                    <td style="background-color:#F89351 !important;"><?php echo $fila["Especificaciones"]; ?></td>
                                    <td style="background-color:#F89351 !important;"><?php echo $fila["TipoCategoria"]; ?></td>
                                </tr>
                                <?php
                            }else {
                                ?>
                                <tr>
                                    <td style="background-color:#63E346 !important;"><?php echo $fila["Id_producto"]; ?></td>
                                    <td style="background-color:#63E346 !important;"><?php echo $fila["Nombre_insumo"]; ?></td>
                                    <td style="background-color:#63E346 !important;"><?php echo $fila["Descripcion"]; ?></td>
                                    <td style="background-color:#63E346 !important;"><?php echo $fila["Cantidad"]; ?></td>
                                    <td style="background-color:#63E346 !important;"><?php echo $fila["Especificaciones"]; ?></td>
                                    <td style="background-color:#63E346 !important;"><?php echo $fila["TipoCategoria"]; ?></td>
                                </tr>
                                <?php

                            }
                        }
                    }else{
                        ?>
                        <script>
                            alertify.alert("¡Oops!", "Vaya, parece que no hay insumos");
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
</html>