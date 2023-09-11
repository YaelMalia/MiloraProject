<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Turnos</title>
</head>

<body style="padding-left: 25px; padding-top: 25px; padding-bottom: 25px; padding-right: 25px;">
   
    <section class="d-flex justify-content-center"
        style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; background-color: #d2dae6;  border-radius:10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);" >
        <form id ="form_Turnos" class="row g-5">
        
        <h2 style="text-align: center;">Reporte de corte</h2>

            <div class="col-md-3">
                <label for="FechaT" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="FechaT" placeholder="Fecha" required>
            </div>
            <!-- ---------- -->
            <div class="col-md-3">
                <label for="TurnoT" class="form-label">Turno</label>
                <select id="TurnoT" class="form-select" required>
                    <option>Turno 1</option>
                    <option>Turno 2</option>
                </select>
            </div>
            <!-- -------- -->
            <div class="col-md-3">
                <label for="OperadorT" class="form-label">Operador</label>
                <input type="text" class="form-control" id="OperadorT" placeholder="Nombre del operador" required>
            </div>
            <!-- ------------ -->
            <div class="col-md-3">
                <label for="MaquinasT" class="form-label">Máquina</label>
                <select id="MaquinasT" class="form-select" required>
                    <option>Plasma 1</option>
                    <option>Plasma 2</option>
                    <option>Plasma 3</option>
                    <option>Plasma 4</option>
                    <option>Plasma 5</option>
                </select>
            </div>

            
           
            <!-- ------------------------------------------------------------------------------------------------------ -->
            <div class="col-md-3">
                <label for="disenoT" class="form-label">Pieza o diseño</label>
                <input type="text" class="form-control" id="disenoT" placeholder="Pieza o diseño" required>
            </div>

            <div class="col-md-3">
                <label for="Orden_de_compraT" class="form-label">Orden de compra</label>
                <input type="text" class="form-control" id="Orden_de_compraT" placeholder="Orden de compra" required>
            </div>

            <div class="col-md-3">
                <label for="EspesorT" class="form-label">Espesor</label>
                <input type="text" class="form-control" id="EspesorT" placeholder="Espesor" required>
            </div>

            <div class="col-md-3">
                <label for="ValeMP" class="form-label">Vale de materia prima</label>
                <input type="number" class="form-control" id="ValeMP" placeholder="Vale de materia prima" required>
            </div>

            <div class="col-md-3">
                <label for="Cantidad_NEST" class="form-label">Cantidad solicitada en NEST</label>
                <input type="text" class="form-control" id="Cantidad_NEST" placeholder="Cantidad solicitada NEST" required>
            </div>
           
            <!-- ------------------------------------------------------------------------------------------------------ -->
            
            <div class="col-md-3">
                <label for="CantidadRep" class="form-label">Cantidad reportada</label>
                <input type="number" class="form-control" id="CantidadRep" placeholder="Cantidad reportada" required>
            </div>

            <!-- ---------- -->

            <div class="col-md-3">
                <label for="PlacasNEST" class="form-label">Placas solicitada en NEST</label>
                <input type="number" class="form-control" id="PlacasNEST" placeholder="Placas solicitada en NEST" required>
            </div>

            <!-- ------------ -->
            
            <div class="col-md-3">
                <label for="Placa_cortadaT" class="form-label">Placas cortadas</label>
                <input type="number" class="form-control" id="Placa_cortadaT" placeholder="Placas cortadas" required>
            </div>
            
            <!-- ------------------------------------------------------------------------------------------------------ -->
            <div class="col-md-3">
                <label for="HorasT" class="form-label">Horas</label>
                <input type="number" class="form-control" id="HorasT" placeholder="Horas de proceso" required>
            </div>

            <div class="col-md-9">
                <label for="Observaciones" class="form-label">Observaciones</label>
                <textarea name="Observaciones" class="form-control" id="Observaciones" cols="auto" rows="1" placeholder="(En caso de no haber observaciones, dejarlo vacío)"></textarea>
            </div>
            
            <div class="col-4"></div>

            <div class="col-4" >
                <input onclick="" type="button" class="btn btn-primary col-12" style="height: 50px; min-height: auto; font-size: 20px;" value="Aceptar">
            </div>
            
        </form>
    </section>
</body>

</html>