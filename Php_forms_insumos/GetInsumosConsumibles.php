<?php
if (isset($_POST["tipoVista"])) {
    $vista = $_POST["tipoVista"];
    require_once("../conexionBD/Consultas_insumos.php");
    $miloraObj = InsumosClass::singleton();
    if ($vista == "insumos") {
        $data = $miloraObj->GetInsumos();
        if (count($data) > 0) {
            foreach ($data as $fila) { //Aqui es para llenar los datos
                if ($fila["Cantidad"] <= 5) {
                    ?>
                    <tr>
                        <td style="background-color:#F76D6D !important;"><?php echo $fila["Id_producto"]; ?>
                        </td>
                        <td style="background-color:#F76D6D !important;"><?php echo $fila["Nombre_insumo"]; ?>
                        </td>
                        <td style="background-color:#F76D6D !important;"><?php echo $fila["Descripcion"]; ?>
                        </td>
                        <td style="background-color:#F76D6D !important;"><?php echo $fila["Cantidad"]; ?>
                        </td>
                        <td style="background-color:#F76D6D !important;"><?php echo $fila["Especificaciones"]; ?>
                        </td>
                        <td style="background-color:#F76D6D !important;"><?php echo $fila["TipoCategoria"]; ?>
                        </td>
                    </tr>
                    <?php
                } else if ($fila["Cantidad"] <= 10) {
                    ?>
                        <tr>
                            <td style="background-color:#F89351 !important;"><?php echo $fila["Id_producto"]; ?>
                            </td>
                            <td style="background-color:#F89351 !important;"><?php echo $fila["Nombre_insumo"]; ?>
                            </td>
                            <td style="background-color:#F89351 !important;"><?php echo $fila["Descripcion"]; ?>
                            </td>
                            <td style="background-color:#F89351 !important;"><?php echo $fila["Cantidad"]; ?>
                            </td>
                            <td style="background-color:#F89351 !important;"><?php echo $fila["Especificaciones"]; ?>
                            </td>
                            <td style="background-color:#F89351 !important;"><?php echo $fila["TipoCategoria"]; ?>
                            </td>
                        </tr>
                    <?php
                } else {
                    ?>
                        <tr>
                            <td style="background-color:#63E346 !important;"><?php echo $fila["Id_producto"]; ?>
                            </td>
                            <td style="background-color:#63E346 !important;"><?php echo $fila["Nombre_insumo"]; ?>
                            </td>
                            <td style="background-color:#63E346 !important;"><?php echo $fila["Descripcion"]; ?>
                            </td>
                            <td style="background-color:#63E346 !important;"><?php echo $fila["Cantidad"]; ?>
                            </td>
                            <td style="background-color:#63E346 !important;"><?php echo $fila["Especificaciones"]; ?>
                            </td>
                            <td style="background-color:#63E346 !important;"><?php echo $fila["TipoCategoria"]; ?>
                            </td>
                        </tr>
                    <?php

                }
            }
        } else {
            echo "Nada";
        }
    }
    if ($vista == "consumibles") {
        $data = $miloraObj->GetConsumibles();
        if (count($data) > 0) {
            foreach ($data as $fila) { //Aqui es para llenar los datos
                if ($fila["Cantidad"] <= 5) {
                    ?>
                    <tr>
                        <td style="background-color:#F76D6D !important;"><?php echo $fila["Id_producto"]; ?>
                        </td>
                        <td style="background-color:#F76D6D !important;"><?php echo $fila["Nombre_insumo"]; ?>
                        </td>
                        <td style="background-color:#F76D6D !important;"><?php echo $fila["Descripcion"]; ?>
                        </td>
                        <td style="background-color:#F76D6D !important;"><?php echo $fila["Cantidad"]; ?>
                        </td>
                        <td style="background-color:#F76D6D !important;"><?php echo $fila["Especificaciones"]; ?>
                        </td>
                        <td style="background-color:#F76D6D !important;"><?php echo $fila["TipoCategoria"]; ?>
                        </td>
                    </tr>
                    <?php
                } else if ($fila["Cantidad"] <= 10) {
                    ?>
                    <tr>
                        <td style="background-color:#F89351 !important;"><?php echo $fila["Id_producto"]; ?>
                        </td>
                        <td style="background-color:#F89351 !important;"><?php echo $fila["Nombre_insumo"]; ?>
                        </td>
                        <td style="background-color:#F89351 !important;"><?php echo $fila["Descripcion"]; ?>
                        </td>
                        <td style="background-color:#F89351 !important;"><?php echo $fila["Cantidad"]; ?>
                        </td>
                        <td style="background-color:#F89351 !important;"><?php echo $fila["Especificaciones"]; ?>
                        </td>
                        <td style="background-color:#F89351 !important;"><?php echo $fila["TipoCategoria"]; ?>
                        </td>
                    </tr>
                    <?php
                } else {
                    ?>
                        <tr>
                            <td style="background-color:#63E346 !important;"><?php echo $fila["Id_producto"]; ?>
                            </td>
                            <td style="background-color:#63E346 !important;"><?php echo $fila["Nombre_insumo"]; ?>
                            </td>
                            <td style="background-color:#63E346 !important;"><?php echo $fila["Descripcion"]; ?>
                            </td>
                            <td style="background-color:#63E346 !important;"><?php echo $fila["Cantidad"]; ?>
                            </td>
                            <td style="background-color:#63E346 !important;"><?php echo $fila["Especificaciones"]; ?>
                            </td>
                            <td style="background-color:#63E346 !important;"><?php echo $fila["TipoCategoria"]; ?>
                            </td>
                        </tr>
                    <?php

                }
            }
        } else {
            echo "Nada";
        }
    }
}
?>