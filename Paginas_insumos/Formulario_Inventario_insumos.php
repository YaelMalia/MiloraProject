<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="../Script/Formularios_Js/ScriptsInsumos.js"></script>
    <script src="../Script/jquery.js"></script>
    <script src="../Script/jquery-3.5.1.min.js"></script>
    <title>Inventario</title>
</head>

<body style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
    <section class="d-flex justify-content-center" style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;
        background-color: #d2dae6;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);">
        <form id="form_nuevoInsumo" class="row g-4">
            <h2 style="text-align: center;">Almacen de herramientas</h2>
            <div class="col-md-4">
                <label for="IdentificadorInsumo" class="form-label">Identificador de insumo</label>
                <input type="text" class="form-control" id="IdentificadorInsumo" required>
            </div>
            <div class="col-md-4">
                <label for="NombreInsumo" class="form-label">Nombre de insumo</label>
                <input type="text" class="form-control" id="NombreInsumo" required>
            </div>
            <div class="col-md-4">
                <label for="CategoriasInsumo" class="form-label">Categoria del insumo</label>
                <select id="CategoriasInsumo" class="form-select" required>
                    <?php
                        require_once("../conexionBD/Consultas_insumos.php");
                        $miloraObj = InsumosClass::singleton();
                        $data = $miloraObj->GetCategoria2();
                    
                        if (count($data) > 0) {
                            foreach ($data as $fila) {
                                $Categoria = $fila["TipoCategoria"];
                    
                                // Agregar una opción al select para cada producto
                                echo "<option>$Categoria</option>";
                            }
                        } else {
                            echo "<option value=''>Error</option>";
                        }
                        ?>
                </select>
            </div>
            <!-- ---------------------------------------------------------------------------------------- -->
            <div class="col-md-6">
                <label for="EspecificacionesInsumo" class="form-label">Especificaciones del insumo</label>
                <input type="text" class="form-control" id="EspecificacionesInsumo" required>
            </div>
            <div class="col-md-6">
                <label for="DescripcionInsumo" class="form-label">Descripción de insumo</label>
                <input type="text" class="form-control" id="DescripcionInsumo" required>
            </div>
            <!-- ---------------------------------------------------------------------------------------- -->
            <div class="col-4"></div>
            <div class="col-4">
                <input onclick="nuevo_Insumo()" type="button" class="btn btn-primary col-12" style="height: 50px;
                min-height: auto; font-size: auto;" value="Agregar nuevo insumo">
            </div>
            <div class="col-4"></div>
        </form>
    </section>
</body>

</html>