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
    <h1 style="text-align: center;">Corte de turno</h1>
    <section class="d-flex justify-content-center"
        style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px; background-color: #d2dae6;">
        <form class="row g-5">
            <div class="col-md-3">
                <label for="Fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="Fecha" placeholder="Fecha" required>
            </div>
            <div class="col-md-3">
                <label for="Turno" class="form-label">Turno</label>
                <select id="Turno" class="form-select" required>
                    <option selected></option>
                    <option>Turno 1</option>
                    <option>Turno 2</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="Maquinas" class="form-label">Maquina</label>
                <select id="Maquinas" class="form-select" required>
                    <option selected></option>
                    <option>Tigres del norte</option>
                    <option>Pantera rosa</option>
                    <option>Aguila</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="Operador" class="form-label">Operador</label>
                <input type="text" class="form-control" id="Operador" placeholder="Nombre del operador" required>
            </div>
            <!-- ------------------------------------------------------------------------------------------------------ -->
            <div class="col-md-3">
                <label for="Proceso_pieza" class="form-label">Proceso</label>
                <select id="Turno" class="form-select" required>
                    <option selected></option>
                    <option>Corte</option>
                    <option>Dobles</option>
                    <option>Rolado</option>
                    <option>Bisel</option>
                    <option>Taladro</option>
                    <option>Prensa</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="Folio_mp" class="form-label">Folio de materia prima(MP)</label>
                <input type="text" class="form-control" id="Folio_mp" placeholder="Folio de MP" required>
            </div>
            <div class="col-md-3">
                <label for="Cantidad_NEST" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="Cantidad_NEST" placeholder="Cantidad NEST" required>
            </div>
            <div class="col-md-3">
                <label for="Cantidad_reportada" class="form-label">Cantidad reportada</label>
                <input type="number" class="form-control" id="Cantidad_reportada" placeholder="Cantidad reportada"
                    required>
            </div>
            <!-- ------------------------------------------------------------------------------------------------------ -->
            <div class="col-md-3">
                <label for="Cantidad_reportada" class="form-label">Piezas con fallo</label>
                <input type="number" class="form-control" id="Cantidad_reportada" placeholder="Piezas que presentan errores"
                    required>
            </div>

            <div class="col-md-3">
                <label for="Placa_solicitada" class="form-label">Placas solicitadas</label>
                <input type="number" class="form-control" id="Placa_solicitada" placeholder="Placas solicitadas"
                    required>
            </div>
            <div class="col-md-3">
                <label for="Placa_cortada" class="form-label">Placas cortadas</label>
                <input type="number" class="form-control" id="Placa_cortada" placeholder="Placas cortadas" required>
            </div>
            <div class="col-md-3">
                <label for="Orden_de_compra" class="form-label">Orden de compra</label>
                <input type="text" class="form-control" id="Orden_de_compra" placeholder="Orden de compra" required>
            </div>
            <!-- ------------------------------------------------------------------------------------------------------ -->
            <div class="col-md-3">
                <label for="Horas" class="form-label">Horas</label>
                <input type="number" class="form-control" id="Horas" placeholder="Horas de proceso" required>
            </div>
            <div class="col-md-9">
            </div>
            <!-- ----------------------------------------------------------------------------------------------------- -->
            <div class="col-4">
            </div>
            <div class="col-4" >
                <button type="submit" class="btn btn-primary col-12" style="height: 50px; min-height: auto; font-size: 20px;">Enviar</button>
            </div>
            <div class="col-4">
            </div>
        </form>
    </section>
</body>

</html>