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
    <title>Salidas a bodega</title>
    <script>
        document.querySelector('#CategoriasSa').addEventListener("change", function() {
            document.getElementById('IdentificadorSa').innerHTML = '';
            let categoriaSeleccionada = this.value;
        if (categoriaSeleccionada!=null || categoriaSeleccionada!="") {
            let parametros = {
                "TipoCat": categoriaSeleccionada
            };
            $.ajax({
                type: 'POST',
                url: '../Php_forms_insumos/GetInsumosporCatetoria.php',
                data: parametros,
                async: false,
                success: function (returning) {
                    if(returning!="notFound"){
                        $("#IdentificadorSa").append(returning);
                    }else{
                        alertify.alert("Aviso", "No hay insumos en esta categoria")
                    }
                }
            });
        } else {
        }
        });
    </script>
</head>

<body style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
    <section class="d-flex justify-content-center" style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;
        background-color: #d2dae6;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);">
        <form id="form_nuevoD" class="row g-4">
            <h2 style="text-align: center;">Salidas almacen de herramientas</h2>
            <div class="col-md-3">
                <label for="FechaSa" class="form-label">Fecha de salida</label>
                <input type="date" class="form-control" id="FechaSa" required>
            </div>
            <div class="col-md-3">
                <label for="IdentificadorSa" class="form-label">Identificador de insumo</label>
                <select id="IdentificadorSa" class="form-select" required>
                    <option select></option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="CategoriasSa" class="form-label">Categoria del insumo</label>
                <select id="CategoriasSa" class="form-select" required>
                    <option select></option>
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
            <div class="col-md-3">
                <label for="CantidadSa" class="form-label">Cantidad de insumo</label>
                <input type="number" class="form-control" id="CantidadSa" required>
            </div>
            <!-- ---------------------------------------------------------------------------------------- -->
            <div class="col-4"></div>
            <div class="col-4">
                <input onclick="nueva_Salida()" type="button" class="btn btn-primary col-12" style="height: 50px;
                min-height: auto; font-size: auto;" value="Registrar salida de insumo">
            </div>
            <div class="col-4"></div>
        </form>
    </section>
</body>

</html>