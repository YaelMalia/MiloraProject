<?php
if (isset($_POST["TipoCat"])) {
    $Cat = $_POST["TipoCat"];
    require_once("../conexionBD/Consultas_insumos.php");
    $miloraObj = InsumosClass::singleton();
    $data = $miloraObj->GetInsumosPorCategoria($Cat);

    if (count($data) > 0) {
        foreach ($data as $fila) {
            ?>
            <option><?php echo $fila["Id_producto"]?></option>;
           <?php 
        }
    } else {
        echo "notFound";
    }
}
?>