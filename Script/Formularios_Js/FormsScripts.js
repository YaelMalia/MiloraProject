// -------------------------------- INICIAN PIEZAS --------------------------------
function nueva_Pieza() {
    let flag = false;
    let noDiseno = $("#No_disenoFD")[0].value;
    let descripcion_mp = $("#Descripcion_MP")[0].value;
    let codigo_mp = $("#Codigo_MP")[0].value;
    let corte = $("#Corte")[0].value;
    let dobles = $("#Dobles")[0].value;
    let rolado = $("#Rolado")[0].value;
    let bisel = $("#Bisel")[0].value;
    let taladro = $("#Taladro")[0].value;
    let prensa = $("#Prensa")[0].value;

    if (noDiseno == null || noDiseno == "") {
        alertify.alert("Aviso", "No se ha ingresado el número de diseño o pieza");
    } else {
        if (descripcion_mp == null || descripcion_mp == "") {
            alertify.alert("Aviso", "No se ha ingresado descripción de materia prima");
        } else {
            if (codigo_mp == null || codigo_mp == "") {
                alertify.alert("Aviso", "No se ha ingresado el código de materia prima");
            } else {
                // Nada vacío -----

                flag = true;
                if (flag == true) {
                    let parametros = {
                        "noDiseno": noDiseno,
                        "descripcion_mp": descripcion_mp,
                        "codigo_mp": codigo_mp,
                        "corte": corte,
                        "dobles": dobles,
                        "rolado": rolado,
                        "bisel": bisel,
                        "taladro": taladro,
                        "prensa": prensa
                    };
                    // Enviar por Ajax
                    $.ajax({
                        type: 'POST',
                        url: '../Php_forms/Insert_Pieza.php',
                        data: parametros,
                        async: false,
                        success: function (returning) {
                            if (returning == "si") {
                                // alertify.success('Pieza agregada');
                                alertify.alert("¡Exito!", "El modelo o pieza se ha agregado con éxito");
                                let formulario = $("#form_nuevoD");
                                $("#No_disenoFD")[0].value = "";
                                $("#Descripcion_MP")[0].value = "";
                                $("#Codigo_MP")[0].value = "";
                                $("#Dobles")[0].value = "No";
                                $("#Rolado")[0].value = "No";
                                $("#Bisel")[0].value = "No";
                                $("#Taladro")[0].value = "No";
                                $("#Prensa")[0].value = "No";
                            } else {
                                alertify.alert("Error", "Se ha producido un error al ingresar el número de diseño o pieza, revise que no esté repetida");
                            }
                        }
                    });
                }
            }
        }
    }
}

function buscar_Pieza() {
    let noDiseno = $("#No_disenoFD")[0].value;
    if (noDiseno == null || noDiseno.includes(' ') || noDiseno == "") {
        alertify.alert("Error", "No se ha ingresado un número de diseño o está mal escrito");
    } else {
        let parametros = {
            "noDiseno": noDiseno
        };
        // Envío por Ajax
        $.ajax({
            type: 'POST',
            url: '../Php_forms/Select_Pieza.php',
            data: parametros,
            async: false,
            success: function (returning) {
                if (returning != "no") {
                    var ArrayDatos = returning.split(',');
                    document.getElementById("No_disenoFD").disabled = true;
                    document.getElementById("btn_Buscar").disabled = true;

                    document.getElementById("Descripcion_MP").disabled = false;
                    $("#Descripcion_MP")[0].value = ArrayDatos[0];

                    document.getElementById("Codigo_MP").disabled = false;
                    $("#Codigo_MP")[0].value = ArrayDatos[1];

                    document.getElementById("Dobles").disabled = false;
                    $("#Dobles")[0].value = ArrayDatos[3];

                    document.getElementById("Rolado").disabled = false;
                    $("#Rolado")[0].value = ArrayDatos[4];

                    document.getElementById("Bisel").disabled = false;
                    $("#Bisel")[0].value = ArrayDatos[5];

                    document.getElementById("Taladro").disabled = false;
                    $("#Taladro")[0].value = ArrayDatos[6];

                    document.getElementById("Prensa").disabled = false;
                    $("#Prensa")[0].value = ArrayDatos[7];

                    document.getElementById("btn-update").disabled = false;
                } else {
                    alertify.alert("Error", "Número de diseño proporcionado no existe o está equivocado");
                }
            }
        });
    }
}

function busqueda_Filtrada_Piezas(Seleccion) {

    let identificador = "";
    if (Seleccion == "noDiseno") {
        identificador = $("#No_disenoFD")[0].value;
    } else {
        identificador = $("#Codigo_MP")[0].value;
    }
    let parametros = {
        "dato-Rbt": Seleccion,
        "ID": identificador
    };

    $.ajax({
        type: 'POST',
        url: '../Php_forms/Get_Piezas.php',
        data: parametros,
        async: false,
        success: function (returning) {
            if (returning != "No") {
                $("#cuerpoTabla")[0].value = "";
                document.getElementById("cuerpoTabla").innerHTML = returning;
                // alert(returning);
            } else {
                alertify.alert("Error", "Pieza no se ha encontrado, revise sus datos");
            }
        }
    });
}

function actualizar_Pieza() {
    let flag = false;

    let noDiseno = $("#No_disenoFD")[0].value;
    let descripcion_mp = $("#Descripcion_MP")[0].value;
    let codigo_mp = $("#Codigo_MP")[0].value;
    let corte = $("#Corte")[0].value;
    let dobles = $("#Dobles")[0].value;
    let rolado = $("#Rolado")[0].value;
    let bisel = $("#Bisel")[0].value;
    let taladro = $("#Taladro")[0].value;
    let prensa = $("#Prensa")[0].value;

    if (noDiseno == null || noDiseno == "") {
        alertify.alert("Aviso", "No se ha ingresado el número de diseño o pieza");
    } else {
        if (descripcion_mp == null || descripcion_mp == "") {
            alertify.alert("Aviso", "No se ha ingresado descripción de materia prima");
        } else {
            if (codigo_mp == null || codigo_mp == "") {
                alertify.alert("Aviso", "No se ha ingresado el código de materia prima");
            } else {
                // Nada vacío -----

                flag = true;
                if (flag == true) {
                    let parametros = {
                        "noDiseno": noDiseno,
                        "descripcion_mp": descripcion_mp,
                        "codigo_mp": codigo_mp,
                        "corte": corte,
                        "dobles": dobles,
                        "rolado": rolado,
                        "bisel": bisel,
                        "taladro": taladro,
                        "prensa": prensa
                    };
                    // Enviar por Ajax
                    $.ajax({
                        type: 'POST',
                        url: '../Php_forms/Update_Pieza.php',
                        data: parametros,
                        async: false,
                        success: function (returning) {
                            if (returning == "si") {
                                alertify.alert("¡Exito!", "El modelo o pieza se ha modificado con éxito");


                                document.getElementById("No_disenoFD").disabled = false;
                                document.getElementById("btn_Buscar").disabled = false;

                                document.getElementById("Descripcion_MP").disabled = true;
                                document.getElementById("Codigo_MP").disabled = true;
                                document.getElementById("Dobles").disabled = true;
                                document.getElementById("Rolado").disabled = true;
                                document.getElementById("Bisel").disabled = true;
                                document.getElementById("Taladro").disabled = true;
                                document.getElementById("Prensa").disabled = true;
                                document.getElementById("btn-update").disabled = true;

                                $("#No_disenoFD")[0].value = "";

                                $("#Descripcion_MP")[0].value = "";
                                $("#Codigo_MP")[0].value = "";
                                $("#Dobles")[0].value = "No";
                                $("#Rolado")[0].value = "No";
                                $("#Bisel")[0].value = "No";
                                $("#Taladro")[0].value = "No";
                                $("#Prensa")[0].value = "No";


                            } else {
                                alertify.alert("Error", "Se ha producido un error al actualizar el diseño o pieza, revise sus datos");
                            }
                        }
                    });
                }
            }
        }
    }
}
// -------------------------------- FIN PIEZAS --------------------------------

// -------------------------------- INICIAN ORDENES DE COMPRA --------------------------------
function AgregarOrden() {

    let fecha_inicio = $("#Fecha_inicio")[0].value;
    let fecha_limite = $("#Fecha_final")[0].value;
    let orden_compra = $("#Orden_de_compra")[0].value;
    let cliente = $("#lst_Clientes")[0].value;
    let noDiseno = $("#No_diseno")[0].value;
    let noPiezas = $("#Numero_de_piezas")[0].value;

    let flag = false;

    if (fecha_inicio == null || fecha_inicio == "") {
        alertify.alert("Error", "Fecha de inicio de la orden no se ha ingresado");
    } else {
        if (fecha_limite == null || fecha_limite == "") {
            alertify.alert("Error", "Fecha límite de la orden no se ha ingresado");
        } else {
            if (orden_compra == null || orden_compra == "") {
                alertify.alert("Error", "No se ha ingresado el identificador de la orden de compra");
            } else {
                if (cliente == null || cliente == "") {
                    alertify.alert("Error", "No se ha seleccionado un cliente de compra válido");
                } else {
                    if (noDiseno == null || noDiseno == "") {
                        alertify.alert("Error", "No se ha ingresado un número de diseño");
                    } else {
                        if (noPiezas == null || noPiezas == "") {
                            alertify.alert("Error", "No se ha ingresado la cantidad de piezas para la orden de compra");
                        } else {
                            if (noPiezas <= 0) {
                                alertify.alert("Error", "La cantidad de piezas para la orden no puede ser menor a cero");
                            } else {
                                flag = true;
                            }
                            if (flag == true) {

                                if (Date.parse(fecha_limite) < Date.parse(fecha_inicio)) {
                                    alertify.alert("Error", "La fecha límite no puede ser menor a la fecha de inicio de la orden de compra, intenta de nuevo");
                                } else {
                                    // Todo correcto

                                    let pCount = {
                                        "disenoCount": noDiseno,
                                        "ordenCount": orden_compra
                                    };

                                    $.ajax({
                                        type: 'POST',
                                        url: '../Php_forms/Get_countOrdenes.php',
                                        data: pCount,
                                        async: false,
                                        success: function (cantidadOrdenes) {
                                            
                                            if(cantidadOrdenes>0){
                                                alertify.alert("¡Atención!", "Parece que ya existe una orden de compra con estos datos y no se pueden repetir");
                                            }else{
                                                let parametros = {
                                                    "fechaInicio": fecha_inicio,
                                                    "fechaLimite": fecha_limite,
                                                    "ID_Orden": orden_compra,
                                                    "Cliente": cliente,
                                                    "No_diseno": noDiseno,
                                                    "CantidadPzs": noPiezas
                                                };
            
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '../Php_forms/Insert_Ordenes.php',
                                                    data: parametros,
                                                    async: false,
                                                    success: function (returning) {
                                                        if (returning == "si") {
                                                            alertify.alert("¡Exito!", "Se ha registrado la nueva orden de compra correctamente");
                                                            $("#Fecha_inicio")[0].value = "";
                                                            $("#Fecha_final")[0].value = "";
                                                            $("#Orden_de_compra")[0].value = "";
                                                            $("#lst_Clientes")[0].value = "";
                                                            $("#No_diseno")[0].value = "";
                                                            $("#Numero_de_piezas")[0].value = "";
                                                        } else {
                                                            alertify.alert("Error", "No se ha podido agregar la orden de compra, revisa los datos ingresados e intenta de nuevo");
                                                        }
                                                    }
                                                });
                                            }
                                        }});

                                }

                            } else {
                                if (noPiezas <= 0) {
                                    alertify.alert("Error", "La cantidad de piezas para la orden no puede ser menor a cero");
                                } else {
                                    alertify.alert("Error", "Algo se ha ingresado de manera incorrecta, revise sus datos");
                                }
                            }
                        }
                    }
                }
            }
        }
    }

}

function OrdenesResFull(Seleccion) {

    document.getElementById("Cuerpo_tabla").innerText = "";

    let fechaInf = $("#De_fecha")[0].value;
    let fechaSup = $("#Hasta_fecha")[0].value;
    let ordenC = $("#Orden_c")[0].value;
    let noDiseno = $("#Nodiseno")[0].value;
    let cliente = $("#Cliente")[0].value;

    if (fechaInf == "" && fechaSup == "" && ordenC == "" && noDiseno == "" && cliente == "") {
        let parametros = {
            "tipoVista": Seleccion
        };
        $.ajax({
            type: 'POST',
            url: '../Php_forms/Get_Ordenes.php',
            data: parametros,
            async: false,
            success: function (returning) {
                if (Seleccion == "Resumida") {
                    $("#Head_completa").hide();
                    $("#Head_resumida").show();
                } else {
                    $("#Head_completa").show();
                    $("#Head_resumida").hide();
                }
                if (returning != "Nada") {
                    document.getElementById("Cuerpo_tabla").innerHTML = returning;
                } else {
                    alertify.alert("¡Oops!", "No se han podido recopilar los datos, intente más tarde");
                }
            }
        });
    } else {
        var banderaF = false;
        if (fechaInf != "") {
            if (fechaSup == "") {
                alertify.alert("Error", "Se necesita una fecha límite (Hasta el día) para filtrar la búsqueda")
                // alert("Error");
            } else {
                if (Date.parse(fechaInf) > Date.parse(fechaSup)) {
                    alertify.alert("Error", "La fecha superior no puede ser menor a la fecha de inicio, intenta de nuevo");
                    // alert("error__");
                    banderaF = false;
                } else {
                    banderaF = true;

                    if (banderaF == true) {

                        let parametros = {
                            "tipoVista": Seleccion,
                            "fechaInf": fechaInf,
                            "fechaSup": fechaSup,
                            "ordenC": ordenC,
                            "noDiseno": noDiseno,
                            "cliente": cliente
                        };

                        $.ajax({
                            type: 'POST',
                            url: '../Php_forms/Get_Ordenes_Filtrado.php',
                            data: parametros,
                            async: false,
                            success: function (returning) {
                                // alert(returning);
                                if (Seleccion == "Resumida") {
                                    $("#Head_completa").hide();
                                    $("#Head_resumida").show();
                                } else {
                                    $("#Head_completa").show();
                                    $("#Head_resumida").hide();
                                }
                                if (returning != "Nada") {
                                    document.getElementById("Cuerpo_tabla").innerHTML = returning;
                                } else {
                                    alertify.alert("¡Oops!", "No se han encontrado ordenes de compra con los datos proporcionados");
                                }
                            }
                        });
                    }
                }

            }
        } else {
            if (fechaSup == "") {
                let parametros = {
                    "tipoVista": Seleccion,
                    "fechaInf": fechaInf,
                    "fechaSup": fechaSup,
                    "ordenC": ordenC,
                    "noDiseno": noDiseno,
                    "cliente": cliente
                };

                $.ajax({
                    type: 'POST',
                    url: '../Php_forms/Get_Ordenes_Filtrado.php',
                    data: parametros,
                    async: false,
                    success: function (returning) {
                        // alert(returning);
                        if (Seleccion == "Resumida") {
                            $("#Head_completa").hide();
                            $("#Head_resumida").show();
                        } else {
                            $("#Head_completa").show();
                            $("#Head_resumida").hide();
                        }
                        if (returning != "Nada") {
                            document.getElementById("Cuerpo_tabla").innerHTML = returning;
                        } else {
                            alertify.alert("¡Oops!", "No se han podido recopilar los datos, intente nuevamente");
                        }
                    }
                });
            } else {
                alertify.alert("Error", "Falta una fecha por asignar");

            }
        }

    }
}

// -------------------------------- Busqueda para editar --------------------------------
var NoOrdenGlobal;
var PRealizadasGlobal;

function Buscar_Orden_Filtro() {
    let ordenB = $("#B_orden")[0].value;
    let disenoB = $("#B_Diseno")[0].value;

    if (ordenB == "") {
        alertify.alert("¡Oops!", "Parece que no se ha llenado el campo de 'Orden' para la búsqueda");
    } else {
        if (disenoB == "") {
            alertify.alert("¡Oops!", "Parece que no se ha llenado el campo de 'diseño' para la búsqueda");
        } else {
            // Correcto
            let parametros = {
                "ordenBuscar": ordenB,
                "disenoBuscar": disenoB
            };

            $.ajax({
                type: 'POST',
                url: '../Php_forms/Search_Orden_Editar.php',
                data: parametros,
                async: false,
                success: function (returning) {

                    if (returning != "no") {
                        // alert(returning);
                        var ArrayDatos = returning.split(',');
                        document.getElementById("B_orden").disabled = true;
                        document.getElementById("B_Diseno").disabled = true;
                        document.getElementById("btn_Buscar").disabled = true;

                        document.getElementById("Fecha_final").disabled = false;
                        $("#Fecha_final")[0].value = ArrayDatos[0];
                        document.getElementById("Orden_de_compra").disabled = false;
                        $("#Orden_de_compra")[0].value = ArrayDatos[1];
                        document.getElementById("No_diseno").disabled = false;
                        $("#No_diseno")[0].value = ArrayDatos[2];
                        document.getElementById("Numero_de_piezas").disabled = false;
                        $("#Numero_de_piezas")[0].value = ArrayDatos[3];

                        document.getElementById("Cliente").disabled = false;
                        $("#Cliente")[0].value = ArrayDatos[4];

                        NoOrdenGlobal = ArrayDatos[5];
                        PRealizadasGlobal = ArrayDatos[6];

                        document.getElementById("Actualizar_Orden").disabled = false;
                    } else {
                        alertify.alert("¡Oops!", "Parece que no se ha encontrado ninguna orden de compra con los datos proporcionados, verifique sus datos");
                    }
                }
            });

        }
    }
}

function Editar_Orden() {
    let flag = false;
    let RazonCambio;
    alertify.prompt('Ingrese un motivo del cambio en la orden de compra:\nAmpliación/Reducción/Datos', ''
        , function (evt, value) {
            RazonCambio = value;
            if (RazonCambio == "Ampliación" || RazonCambio == "Reducción" || RazonCambio == "Datos") {
                flag = true;
                alertify.success('Motivo de cambio agregado');

                if (flag == true) {

                    //Mandamos a llamar el editar

                    let ordenB = $("#B_orden")[0].value;
                    let disenoB = $("#B_Diseno")[0].value;


                    let fechaF = $("#Fecha_final")[0].value;
                    let ordenC = $("#Orden_de_compra")[0].value;
                    let noDiseno = $("#No_diseno")[0].value;
                    let cantidadP = $("#Numero_de_piezas")[0].value;
                    let cliente = $("#Cliente")[0].value;

                    if (fechaF == "" || ordenC == "" || noDiseno == "" || cantidadP == "" || cliente == "") {
                        alertify.alert("Error", "Vaya, parece que uno o más campos están vacíos, revise sus datos");
                    } else {
                        if (RazonCambio == "Datos") {
                            RazonCambio = "Activa";
                        }
                        let parametros = {

                            "filterOrden": ordenB,
                            "filterDiseno": disenoB,

                            "RazonCambio": RazonCambio,
                            "FechaLimite": fechaF,
                            "ordenC": ordenC,
                            "noDiseno": noDiseno,
                            "cantidadP": cantidadP,
                            "cliente": cliente
                        }

                        $.ajax({
                            type: 'POST',
                            url: '../Php_forms/Update_Ordenes.php',
                            data: parametros,
                            async: false,
                            success: function (returning) {
                                if (returning != "no") {
                                    alertify.alert("¡Exito!", "Orden de compra modificada con éxito");

                                    document.getElementById("B_orden").disabled = false;
                                    $("#B_orden")[0].value = "";
                                    document.getElementById("B_Diseno").disabled = false;
                                    $("#B_Diseno")[0].value = "";
                                    document.getElementById("btn_Buscar").disabled = false;

                                    document.getElementById("Fecha_final").disabled = true;
                                    $("#Fecha_final")[0].value = "";
                                    document.getElementById("Orden_de_compra").disabled = true;
                                    $("#Orden_de_compra")[0].value = "";
                                    document.getElementById("No_diseno").disabled = true;
                                    $("#No_diseno")[0].value = "";
                                    document.getElementById("Numero_de_piezas").disabled = true;
                                    $("#Numero_de_piezas")[0].value = "";
                                    document.getElementById("Cliente").disabled = true;
                                    $("#Cliente")[0].value = "";

                                    document.getElementById("Actualizar_Orden").disabled = true;

                                    let Restantes;
                                    Restantes = cantidadP - PRealizadasGlobal;
                                    // alert(Restantes);

                                    P_restantes = {
                                        "NoOrden": NoOrdenGlobal,
                                        "Restantes": Restantes
                                    };

                                    $.ajax({
                                        type: 'POST',
                                        url: '../Php_forms/Actualiza_restantes.php',
                                        data: P_restantes,
                                        async: false,
                                        success: function (res) {
                                            if (res == "si") {
                                                alert("Cantidad de piezas restantes actualizada");
                                            } else {
                                                alert("No se ha podido actualizar la cantidad restante");
                                            }
                                        }
                                    });

                                } else {
                                    alertify.alert("Error", "No se ha podido actualizar la orden de compra, revise sus datos e intente nuevamente");
                                }
                            }
                        });
                    }

                } else {
                    alertify.alert("Aviso", "No se puede continuar con el proceso hasta que se agregue un motivo de cambio válido");
                }

            } else {
                alertify.alert("Aviso", "No se puede continuar con el proceso hasta que se agregue un motivo de cambio válido");
                alertify.error('Ingrese un motivo válido');
            }
        });
}
// -------------------------------- FIN ORDENES DE COMPRA -------------------------------- //

// ------------------------------- INICIAN REGISTRO DE ENTRADAS --------------------------------//
function RegistrarEntrada() {
    let fecha_Entrada = $("#Fecha_de_ingreso")[0].value;
    let ordenCompra = $("#Orden_de_compra")[0].value;
    let noDiseno = $("#Numero_de_pieza")[0].value;
    let cantidadPiezas = $("#Cantidad_de_piezas")[0].value;

    if (fecha_Entrada == "" || ordenCompra == "" || noDiseno == "" || cantidadPiezas == "") {
        alertify.alert("Aviso", "Faltan por llenar uno o más campos, revise sus datos");
        // alert("Faltan datos");
    } else {
        // Primero obtenemos el número de orden de compra con una consulta SQL
        // Valores para la consulta: número de diseño y la orden de compra
        let parametrosConsulta = {
            "disenoConsulta": noDiseno,
            "ordenConsulta": ordenCompra
        };

        $.ajax({
            type: 'POST',
            url: '../Php_forms/Get_noOrden_Entradas.php',
            data: parametrosConsulta,
            async: false,
            success: function (returning) {
                if (returning == "notFound") {
                    alertify.alert("Error", "Parece que no hay ninguna orden de compra con dicha pieza, revise sus datos");
                    // alert("No orden existente");
                } else if (returning.includes("Fatal Error")) {
                    alertify.alert("Error", "Se ha producido un error, revise su conexión a internet");
                    // alert("Error de conexión");
                } else {
                    let parametros = {
                        "numero_orden": returning,
                        "fechaEntrada": fecha_Entrada,
                        "ordenEntrada": ordenCompra,
                        "disenoEntrada": noDiseno,
                        "cantidadEntrada": cantidadPiezas
                    };
                    $.ajax({
                        type: 'POST',
                        url: '../Php_forms/Registrar_Entrada.php',
                        data: parametros,
                        async: false,
                        success: function (returningEntrada) {

                            if (returningEntrada != "no" && !returningEntrada.includes("Cantidad de entrada supera a las restantes")) {
                                alertify.alert("¡Exito!", "Se ha registrado una entrada en el almacén");
                                // alert(returningEntrada);
                                $("#Fecha_de_ingreso")[0].value = "";
                                $("#Orden_de_compra")[0].value = "";
                                $("#Numero_de_pieza")[0].value = "";
                                $("#Cantidad_de_piezas")[0].value = "";
                            } else {
                                if (returningEntrada.includes("Cantidad de entrada supera a las restantes")) {
                                    alertify.alert("Error", "Cantidad de entrada supera a las restantes");
                                } else {
                                    alertify.alert("Error", "Se ha producido un error al registrar la entrada, revise su conexión");
                                    // alert(returningEntrada);
                                }
                            }
                        }
                    });
                }
            }
        });
    }
}

function BuscarEntradas() {
    let fechaSa = $("#FechaEn")[0].value;
    let ordenSa = $("#Orden_compraEn")[0].value;
    let noDisenoSa = $("#No_diseñoEn")[0].value;
    if (fechaSa == "" && ordenSa == "" && noDisenoSa == "") {
        alertify.alert("Aviso", "No se han ingresado alguno de los datos");
    } else {
        let parametros = {
            "FechaEn": fechaSa,
            "OrdenEn": ordenSa,
            "NoDisenoEn": noDisenoSa
        };
        $.ajax({
            type: 'POST',
            url: '../Php_forms/Search_Entrada.php',
            data: parametros,
            async: false,
            success: function (returning) {
                if (returning == "Nada") {
                    alertify.alert("Error", "No se encontraron datos");
                } else {
                    document.getElementById("cuerpoTabla").innerHTML = returning;
                }
            }
        });
    }
}
// -------------------------------- FIN REGISTRO DE ENTRADAS ---------------------------------//

// ------------------------------- INICIAN REGISTRO DE SALIDAS --------------------------------//
function RegistrarSalida() {
    let fecha_Salida = $("#Fecha_de_salida")[0].value;
    let ordenCompra = $("#Orden_de_compra")[0].value;
    let noDiseno = $("#Numero_de_pieza")[0].value;
    let cantidadPiezas = $("#Cantidad_de_piezas")[0].value;

    if (fecha_Salida == "" || ordenCompra == "" || noDiseno == "" || cantidadPiezas == "") {
        alertify.alert("Aviso", "Faltan por llenar uno o más campos, revise sus datos");
        // alert("Faltan datos");
    } else {
        // Primero obtenemos el número de orden de compra con una consulta SQL
        // Valores para la consulta: número de diseño y la orden de compra
        let parametrosConsulta = {
            "disenoConsulta": noDiseno,
            "ordenConsulta": ordenCompra
        };

        $.ajax({
            type: 'POST',
            url: '../Php_forms/Get_noStock_Salidas.php',
            data: parametrosConsulta,
            async: false,
            success: function (returning) {
                if (returning == "notFound") {
                    alertify.alert("Error", "Parece que no hay orden o stock existente, revise sus datos");

                } else if (returning.includes("Fatal Error")) {
                    alertify.alert("Error", "Se ha producido un error, revise su conexión a internet");
                    // alert("Error de conexión");
                } else {

                    let parametros = {
                        "cve_stock": returning,
                        "fechaSalida": fecha_Salida,
                        "ordenSalida": ordenCompra,
                        "disenoSalida": noDiseno,
                        "cantidadSalida": cantidadPiezas
                    };
                    $.ajax({
                        type: 'POST',
                        url: '../Php_forms/Registrar_Salida.php',
                        data: parametros,
                        async: false,
                        success: function (returningSalida) {
                            // alert(returningSalida);
                            if (returningSalida.includes("SQLSTATE[45000]")) {
                                alertify.alert("Error", "La cantidad de stock para esta orden de compra supera a la cantidad de salida");
                                // alert("cantidad de salida supera al stock");
                            }
                            else {
                                if (returningSalida.includes("OK")) {
                                    alertify.alert("¡Exito!", "Se ha registrado una salida del almacén");
                                    $("#Fecha_de_salida")[0].value = "";
                                    $("#Orden_de_compra")[0].value = "";
                                    $("#Numero_de_pieza")[0].value = "";
                                    $("#Cantidad_de_piezas")[0].value = "";

                                    // Modificar estado de orden y stock
                                    let p_cerrarCompra = {
                                        "disenoC": noDiseno,
                                        "ordenC": ordenCompra
                                    };

                                    $.ajax({
                                        type: 'POST',
                                        url: '../Php_forms/Obtener_stock_cerrarCompra.php',
                                        data: p_cerrarCompra,
                                        async: false,
                                        success: function (cantidad) {
                                            if (cantidad == 0) {
                                                if (confirm("Se ha detectado que las existencias para esta orden de compra ha llegado a cero, ¿deseas cerrar esta orden de compra?")) {
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '../Php_forms/CerrarOrden_Auto.php',
                                                        data: p_cerrarCompra,
                                                        async: false,
                                                        success: function (bandera) {
                                                            if (bandera == "Hecho") {
                                                                alert("Orden cerrada correctamente");
                                                            } else {
                                                                alert(bandera);
                                                                alert("Se ha producido un error al cerrar la compra, revise su conexión a internet");
                                                            }
                                                        }
                                                    });
                                                }
                                            }
                                        }
                                    });

                                } else {
                                    alertify.alert("Error", "Se ha producido un error al registrar la salida, revise su conexión");
                                }
                            }
                        }
                    });
                }
            }
        });
    }
}

function BuscarSalidas() {
    let fechaSa = $("#FechaSa")[0].value;
    let ordenSa = $("#Orden_compraSa")[0].value;
    let noDisenoSa = $("#No_diseñoSa")[0].value;
    if (fechaSa == "" && ordenSa == "" && noDisenoSa == "") {
        alert("datos vacios");
    } else {
        let parametros = {
            "FechaSa": fechaSa,
            "OrdenSa": ordenSa,
            "NoDisenoSa": noDisenoSa
        };
        $.ajax({
            type: 'POST',
            url: '../Php_forms/Search_Salida.php',
            data: parametros,
            async: false,
            success: function (returning) {
                if (returning == "Nada") {
                    alertify.alert("Error", "No se encontraron datos");
                } else {
                    document.getElementById("cuerpoTabla").innerHTML = returning;
                }
            }
        });
    }
}
// -------------------------------- FIN REGISTRO DE SALIDAS ---------------------------------

// --------------------------------- INICIO STOCK ---------------------------------

function buscarStock() {
    let disenoF = $("#No_disenoSt")[0].value;
    let EstatusF = $("#EstatusSt")[0].value;

    if (disenoF == "" && EstatusF == "") {
        //Busca sin filtro
        alertify.alert("Aviso", "Esta consulta genera la cantidad general del stock en almacén, es decir, no se respetan las ordenes de compra");
        document.getElementById("headTable").innerHTML = '<tr> <th scope="col" data-type="string">No. diseño</th> <th scope="col">Cantidad de piezas</th> <th scope="col">Estatus</th></tr>';
        let parametrosO = {
            "where": 1
        }
        $.ajax({
            type: 'POST',
            url: '../Php_forms/Count_Stock.php',
            data: parametrosO,
            async: false,
            success: function (returning) {
                if (returning == "Nada") {
                    alertify.alert("Error", "No se encontraron datos");
                } else {
                    document.getElementById("cuerpoTabla").innerHTML = returning;
                }
            }
        });
    } else {
        document.getElementById("headTable").innerHTML = '<tr> <th scope="col" data-type="string">No. diseño</th> <th scope="col">Orden de compra</th> <th scope="col">Cantidad de piezas</th> <th scope="col">Estatus</th> </tr>'
        let parametros = {
            "disenoBusqueda": disenoF,
            "estatusBusqueda": EstatusF
        };
        $.ajax({
            type: 'POST',
            url: '../Php_forms/Search_filtro_stock.php',
            data: parametros,
            async: false,
            success: function (returning) {
                if (returning == "Nada") {
                    alertify.alert("Error", "No se encontraron datos");
                } else {
                    document.getElementById("cuerpoTabla").innerHTML = returning;
                }
            }
        });

    }
}
// --------------------------------- FIN BUSQUEDAS STOCK ---------------------------------

// --------------------------------- INICIO TURNOS/CORTE TURNO/PROCESOS ---------------------------------
function InsertReporte_Corte() {
    // let flag = false;
    let FechaT = $("#FechaT")[0].value;
    let TurnoT = $("#TurnoT")[0].value;
    let OperadorT = $("#OperadorT")[0].value;
    let MaquinasT = $("#MaquinasT")[0].value;
    let disenoT = $("#disenoT")[0].value;
    let Orden_de_compraT = $("#Orden_de_compraT")[0].value;
    let espesorT = $("#EspesorT")[0].value;
    let Folio_mpT = $("#ValeMP")[0].value;
    let Cantidad_NEST = $("#Cantidad_NEST")[0].value;
    // let Cantidad_reportadaT = $("#CantidadRep")[0].value;
    let PlacasNEST = $("#PlacasNEST")[0].value;

    if (FechaT == null || FechaT == "") {
        alertify.alert("Aviso", "No se ha especificado la fecha límite");
    } else {
        if (TurnoT == null || TurnoT == "") {
            alertify.alert("Aviso", "El turno no puede estar vacío.");
        } else {
            if (OperadorT == null || OperadorT == "") {
                alertify.alert("Aviso", "El no se ha ingresado el nombre del operador");
            } else {
                if (MaquinasT == null || MaquinasT == "") {
                    alertify.alert("Aviso", "El campo maquinas no puede estar vacío");
                } else {
                    if (disenoT == null || disenoT == "") {
                        alertify.alert("Aviso", "El campo diseño no puede estar vacío");
                    } else {
                        if (Orden_de_compraT == null || Orden_de_compraT == "") {
                            alertify.alert("Aviso", "El campo de la orden de compra no puede estar vacío");
                        } else {
                            if (espesorT == null || espesorT == "") {
                                alertify.alert("Aviso", "El campo de espesor no puede estar vacío");
                            } else {
                                if (Folio_mpT == null || Folio_mpT == "") {
                                    alertify.alert("Aviso", "El campo de vale de materia prima no puede estar vacío");
                                } else {
                                    if (Cantidad_NEST == null || Cantidad_NEST == "") {
                                        alertify.alert("Aviso", "El campo del NEST solicitado no puede estar vacío");
                                    } else {
                                        if (PlacasNEST == null || PlacasNEST == "") {
                                            alertify.alert("Aviso", "El campo de las placas reuqeridas en NEST no puede estar vacío");
                                        } else {
                                            // Todo correcto!

                                            // Se preparan los datos para el post

                                            let parametrosConsulta = {
                                                "disenoConsulta": disenoT,
                                                "ordenConsulta": Orden_de_compraT
                                            };

                                            $.ajax({
                                                type: 'POST',
                                                url: '../Php_forms/Get_noOrden_Entradas.php',
                                                data: parametrosConsulta,
                                                async: false,
                                                success: function (returning) {
                                                    if (returning == "notFound") {
                                                        alertify.alert("Error", "Parece que no hay ninguna orden de compra con dicha pieza, revise sus datos");
                                                        // alert("No orden existente");
                                                    } else if (returning.includes("Fatal Error")) {
                                                        alertify.alert("Error", "Se ha producido un error, revise su conexión a internet");
                                                        // alert("Error de conexión");
                                                    } else {
                                                        // Se han encontrado los datos
                                                        let noOrden = returning;

                                                        // Agregar a tabla
                                                        var fechaUTC = new Date();
                                                        const desplazamientoUTC6 = -6 * 60;
                                                        let today = new Date(fechaUTC.getTime() + (desplazamientoUTC6 * 60000));
                                                        // alert(today);
                                                        var date = today.toISOString().slice(0, 10);

                                                        let horasProyectadas = ((50 * PlacasNEST) / 1) / 60;
                                                        horasProyectadas = horasProyectadas.toFixed(2);

                                                        let parametrosCarga = {
                                                            "Fecha": date,
                                                            "FechaLimite": FechaT,
                                                            "Turno": TurnoT,
                                                            "Operador": OperadorT,
                                                            "Maquina": MaquinasT,
                                                            "No_orden": noOrden,
                                                            "Espesor": espesorT,
                                                            "FolioMP": Folio_mpT,
                                                            "NEST_solic": Cantidad_NEST,
                                                            "Placa_NEST": PlacasNEST,
                                                            "HorasProyectadas": horasProyectadas
                                                        }

                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '../Php_forms/Insert_CargaCorte.php',
                                                            data: parametrosCarga,
                                                            async: false,
                                                            success: function (returnInsert) {

                                                                if (returnInsert == "si") {
                                                                    alertify.alert("¡Exito!", "Se ha agregado una nueva carga de trabajo");

                                                                    $("#FechaT")[0].value = "";
                                                                    $("#TurnoT")[0].value = "";
                                                                    $("#OperadorT")[0].value = "";
                                                                    $("#MaquinasT")[0].value = "";
                                                                    $("#disenoT")[0].value = "";
                                                                    $("#Orden_de_compraT")[0].value = "";
                                                                    $("#EspesorT")[0].value = "";
                                                                    $("#ValeMP")[0].value = "";
                                                                    $("#Cantidad_NEST")[0].value = "";
                                                                    $("#PlacasNEST")[0].value = "";

                                                                } else {
                                                                    alertify.alert("Error", "Se ha producido un error al realizar esta carga de trabajo, revise sus datos. Si el problema persiste, vuelva a iniciar sesión");
                                                                }
                                                            }
                                                        });
                                                    }
                                                }
                                            });


                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

        }
    }
}

function AgregarProceso() {
    let P_diseno = $("#P_Diseno")[0].value;
    let P_orden = $("#P_orden")[0].value;
    let cantidadProd = $("#P_cantidad")[0].value;
    if (P_diseno == null || P_diseno == "") {
        alertify.alert("Aviso", "No se ha ingresado un diseño");
    } else {
        if (P_orden == null || P_orden == "") {
            alertify.alert("Aviso", "No se ha ingresado una orden de compra");
        } else {
            if (cantidadProd == null || cantidadProd == "" || cantidadProd <= 0) {
                alertify.alert("Aviso", "No se ha ingresado una cantidad de producción o no es válida");
            } else {
                // Aquí inicia todo el quilombo para ingresar los procesos
                let BuscarDatos = {
                    "diseno": P_diseno,
                    "orden_compra": P_orden
                };

                $.ajax({
                    type: 'POST',
                    url: '../Php_forms/Buscar_OrdenProcesos.php',
                    data: BuscarDatos,
                    async: false,
                    success: function (returning) {
                        if (returning == "Nada") {
                            alertify.alert("Error", "No se encontraron para la orden de compra y diseño ingresado, revise su información");
                        } else {
                            var fechaUTC = new Date();
                            const desplazamientoUTC6 = -6 * 60;
                            let today = new Date(fechaUTC.getTime() + (desplazamientoUTC6 * 60000));

                            // alert(today);

                            var date = today.toISOString().slice(0, 10);
                            var time;

                            var horas = today.getHours() + 6;
                            horas < 10 ? horas = '0' + horas : 0;
                            var minutos = today.getMinutes();
                            minutos < 10 ? minutos = '0' + minutos : 0;
                            time = horas + ':' + minutos;

                            var dateTime = date + ' a las ' + time;
                            var ArrayDatos = returning.split(':');
                            let noOrden = ArrayDatos[0];
                            let Procesos = ArrayDatos[1];
                            // alert("No orden: " + noOrden + " - Procesos: "+ Procesos + "" + dateTime);

                            //Insertar proceso
                            let DatosInsertar = {
                                "No_orden": noOrden,
                                "ProcesoActual": "Corte",
                                "Cantidad": cantidadProd,
                                "Estado_proceso": "En progreso..",
                                "Procesos_restantes": Procesos,
                                "Inicio": dateTime
                            };

                            $.ajax({
                                type: 'POST',
                                url: '../Php_forms/Insertar_Nuevo_proceso.php',
                                data: DatosInsertar,
                                async: false,
                                success: function (returningInsert) {
                                    // alert(returningInsert);
                                    if (returningInsert == "si") {
                                        alertify.alert("¡Correcto!", "Proceso iniciado correctamente, verifique la información en el seguimiento de procesos");
                                        $("#P_Diseno")[0].value = "";
                                        $("#P_orden")[0].value = "";
                                        $("#P_cantidad")[0].value = "";
                                    } else {
                                        alertify.alert("Error", "Se ha producido un error al ingresar el proceso, revise su conexión a internet");
                                    }
                                }
                            });
                        }

                    }
                });

            }
        }
    }
}

function Refresh() {
    document.getElementById("ControlCentral").innerHTML = "";
    $("#ControlCentral").load("Seguimiento_Procesos.php");
}

function RefreshCC() {
    document.getElementById("ControlCentral").innerHTML = "";
    $("#ControlCentral").load("Consulta_Cargas_Corte.php");
}

function RefreshCD() {
    document.getElementById("ControlCentral").innerHTML = "";
    $("#ControlCentral").load("Consulta_Cargas_Detallado.php");
}

var P_actualGlobal, P_restantesGlobal, noProceso, Norden_compraGlobal, P_realizados;

function mostrarModal(btn) {
    $("#modal").show(800);
    $("#Responsable")[0].value = "";
    $("#CantidadSP")[0].value = "";
    document.getElementById("ComboProcesos").innerHTML = "";

    P_realizados = btn.parentNode.nextElementSibling.nextElementSibling.textContent;
    // no_DisenoGlobal = btn.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.textContent;
    // orden_compraGlobal = btn.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.textContent;
    noProceso = btn.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.textContent;
    P_actualGlobal = btn.parentNode.nextElementSibling.textContent;
    P_restantesGlobal = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.firstChild.textContent;

    let ArrAuxiliar = P_restantesGlobal.split(',');
    for (let i = 0; i < ArrAuxiliar.length; i++) {
        ArrAuxiliar[i] == P_actualGlobal ? delete (ArrAuxiliar[i]) : 0;
    }
    if (ArrAuxiliar.length > 1) {
        P_restantesGlobal = "";
        ArrAuxiliar.forEach(element => {
            P_restantesGlobal += element + ",";
        });
        P_restantesGlobal = P_restantesGlobal.substring(0, P_restantesGlobal.length - 1);
        // alert("Fin: " + P_restantesGlobal);
    } else {
        P_restantesGlobal = "Ninguno";
        $("#ComboProcesos").append('<option>' + P_restantesGlobal + '</option>');
        // alert(P_restantesGlobal);
    }

    ArrAuxiliar.forEach(elt => {
        $("#ComboProcesos").append('<option>' + elt + '</option>');
    });

    // Obtener la orden de compra
    let datosProc = {
        "NoProc": noProceso
    };

    $.ajax({
        type: 'POST',
        url: '../Php_forms/get_orden_proceso.php',
        data: datosProc,
        async: false,
        success: function (returningInsert) {
            // alert(returningInsert);
            if (returningInsert.includes("Warning") || returningInsert == "Nada") {
                alertify.alert("Error", "Se ha producido un error, revise su conexión a internet");
            } else {
                Norden_compraGlobal = returningInsert;
            }
        }
    });

    document.getElementById("DetrasP").style.filter = "blur(8px) grayscale(100%)";
    document.getElementById("DetrasP").style.pointerEvents = "none";
    document.getElementById("modal").style.filter = "blur(0)";
}

function Actualizar_Procesos() {

    let SigProceso = $("#ComboProcesos")[0].value;
    let Responsable = $("#Responsable")[0].value;
    let CantidadSP = $("#CantidadSP")[0].value;

    if (SigProceso == null || SigProceso == "") {
        alertify.alert("Error", "No se ha ingresado el siguiente proceso, intente de nuevo");
    } else {
        if (Responsable == null || Responsable == "") {
            alertify.alert("Error", "No se ha ingresado el responsable para el siguiente proceso");
        } else {
            if (CantidadSP == null || CantidadSP == "" || !Number.isInteger(parseInt(CantidadSP)) || CantidadSP <= 0) {
                alertify.alert("Error", "No se ha ingresado la cantidad de piezas para el siguiente proceso o es incorrecta");
            } else {
                //Todo correcto uwu
                var fechaUTC = new Date();
                const desplazamientoUTC6 = -6 * 60;
                let today = new Date(fechaUTC.getTime() + (desplazamientoUTC6 * 60000));

                // alert(today);

                var date = today.toISOString().slice(0, 10);
                var time;

                var horas = today.getHours() + 6;
                horas < 10 ? horas = '0' + horas : 0;
                var minutos = today.getMinutes();
                minutos < 10 ? minutos = '0' + minutos : 0;
                time = horas + ':' + minutos;

                var dateTime = date + ' a las ' + time; //Tiempo de termino

                let PReal;
                P_realizados == "Ninguno" ? PReal = "" + P_actualGlobal : PReal = P_realizados + "," + P_actualGlobal;

                // alert("Proc Realizados:" + PReal);
                // Continuar xd

                let parametrosActualiza_pAct = {
                    "NoProcesoAct": noProceso,
                    "Estado_proceso": "Terminado",
                    "PRealizados": PReal,
                    "Prestantes": P_restantesGlobal,
                    "TerminoFH": dateTime
                };

                $.ajax({
                    type: 'POST',
                    url: '../Php_forms/Actualiza_proceso.php',
                    data: parametrosActualiza_pAct,
                    async: false,
                    success: function (returnUpdate) {
                        // alert(returningInsert);
                        if (returnUpdate.includes("Warning") || returnUpdate == "No") {
                            alertify.alert("Error", "Se ha producido un error, revise su conexión a internet");
                        } else {

                            if (P_restantesGlobal == "Ninguno") {
                                alertify.alert("Aviso", "Esta pieza ha completado todos sus procesos y está lista para entrar a almacén");
                                alertify.success("Proceso actualizado");
                                Refresh();
                                $("#modal").hide(800);
                            } else {
                                // Insertar nuevo proceso
                                let parametrosNP = {
                                    "NoOrden": Norden_compraGlobal,
                                    "Pactual": SigProceso,
                                    "CantidadSP": CantidadSP,
                                    "Responsable": Responsable,
                                    "PRealizados": PReal,
                                    "Estado_proceso": "En progreso..",
                                    "PRestantes": P_restantesGlobal,
                                    "InicioFH": dateTime
                                };
                                $.ajax({
                                    type: 'POST',
                                    url: '../Php_forms/Push_Proceso_Actualizar.php',
                                    data: parametrosNP,
                                    async: false,
                                    success: function (returnNP) {
                                        if (returnNP.includes("No")) {
                                            alertify.error("Se ha producido un error al agregar el seguimiento del proceso");
                                        } else {
                                            alertify.success("Proceso actualizado");
                                            Refresh();
                                            $("#modal").hide(800);
                                        }
                                    }
                                });

                            }
                        }
                    }
                });
            }
        }
    }

}

function BuscarProceso() {

    let Diseno = $("#BP_Diseno")[0].value;
    let Orden = $("#BP_orden")[0].value;
    let Fecha = $("#FechaProc")[0].value;

    let parametros = {
        "where": 1,
        "DisenoBuscar": Diseno,
        "OrdenBuscar": Orden,
        "FechaProc": Fecha
    };

    $.ajax({
        type: 'POST',
        url: '../Php_forms/Filtrar_Procesos.php',
        data: parametros,
        async: false,
        success: function (returning) {
            if (returning.includes("En progreso..") || returning.includes("Terminado")) {
                $("#cuerpoTabla")[0].value = "";
                document.getElementById("cuerpoTabla").innerHTML = returning;
            } else {
                if (returning == "Nada") {
                    alertify.alert("¡Oops!", "No se han podido recuperar datos con la información ingresada");
                } else {
                    alertify.alert("Error", "Se ha producido un error, revise su conexión");
                }
            }
        }
    });
}

function AgregarProcesoDetallado() {
    let fechaDetallada = $("#FechaFD")[0].value;
    let Turnodetallado = $("#TurnoFD")[0].value;
    let SupervisorFD = $("#SupervisorFD")[0].value;
    let TipoFD = $("#TipoFD")[0].value;
    let OrdenCompraFD = $("#OrdenCompraFD")[0].value;
    let NoDisenoFD = $("#noDisenoFD")[0].value;
    let CantidadSoliFD = $("#CantidadSoliFD")[0].value;

    if (OrdenCompraFD == "" || fechaDetallada == "" || SupervisorFD == "" || TipoFD == "" || NoDisenoFD == "" || CantidadSoliFD == "") {
        alertify.alert("Aviso", "Faltan por llenar uno o más campos, revise sus datos");
        // alert("Faltan datos");
    } else {
        let parametrosConsulta = {
            "ordenConsulta": OrdenCompraFD,
            "disenoConsulta": NoDisenoFD
        };
        $.ajax({
            type: 'POST',
            url: '../Php_forms/Get_noOrdenDetallado.php',
            data: parametrosConsulta,
            async: false,
            success: function (returning) {
                if (returning == "notFound") {
                    alertify.alert("Error", "Parece que no hay ninguna orden de compra, revise sus datos");
                    // alert("No orden existente");
                } else if (returning.includes("Fatal Error")) {
                    alertify.alert("Error", "Se ha producido un error, revise su conexión a internet");
                    // alert("Error de conexión");
                } else {
                    var fechaUTC = new Date();
                    const desplazamientoUTC6 = -6 * 60;
                    let today = new Date(fechaUTC.getTime() + (desplazamientoUTC6 * 60000));

                    // alert(today);

                    var date = today.toISOString().slice(0, 10);
                    let parametros = {
                        "Fecha": date,
                        "Turno": Turnodetallado,
                        "FechaLim": fechaDetallada,
                        "Operador": SupervisorFD,
                        "TipoDetallado": TipoFD,
                        "No_orden": returning,
                        "CantidadSolicitada": CantidadSoliFD,
                    }
                    $.ajax({
                        type: 'POST',
                        url: '../Php_forms/Insert_Detallado.php',
                        data: parametros,
                        async: false,
                        success: function (returnings) {
                            // alert(returnings);
                            if (returnings == "si") {
                                alertify.alert("¡Exito!", "Se ha agregado una nueva carga de trabajo");
                                $("#FechaFD")[0].value = "";
                                $("#SupervisorFD")[0].value = "";
                                $("#TipoFD")[0].value = "";
                                $("#OrdenCompraFD")[0].value = "";
                                $("#noDisenoFD")[0].value = "";
                                $("#CantidadSoliFD")[0].value = "";
                            }
                            else {
                                alertify.alert("Error", "Se ha producido un error al realizar esta carga de trabajo, revise sus datos. Si el problema persiste, vuelva a iniciar sesión");
                            }
                        }
                    });
                }
            }
        });
    }
}

// En caso de que se tenga faltante---------------------
let NEST_solicGlobal, placasNEST;
let noCarga;
let FechaCargaGlobal, FechaLimiteCGlobal, TurnoGlobal, No_ordenCC, CodigoMPGlobal, HorasPGlobal, EspesorGlobal, ValeMPGlobal;

// -----------------------------------------

function mostrarModalCorte(btn) {
    $("#modalCorte").show(800);

    $("#CantidadRep")[0].value = "";
    $("#Placa_cortadaT")[0].value = "";
    $("#HorasT")[0].value = "";
    $("#Observaciones")[0].value = "";
    $("#porcentaje")[0].textContent = "0%";
    document.getElementById("porcentaje").style.color = "black";


    NEST_solicGlobal = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    placasNEST = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    HorasPGlobal = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;

    FechaCargaGlobal = btn.parentNode.nextElementSibling.textContent;
    FechaLimiteCGlobal = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    CodigoMPGlobal = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    EspesorGlobal = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    ValeMPGlobal = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent
    TurnoGlobal = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;

    // Event listener para la cantida de piezas --------------------------
    const input = document.querySelector("#CantidadRep");
    input.addEventListener("input", function (e) {
        if (e.target.value >= 0) {
            let porcentaje = (e.target.value * 100) / NEST_solicGlobal;
            porcentaje = porcentaje.toFixed(2);
            if (porcentaje > 100) {
                alertify.alert("Aviso", "Usted está sobrepasando la cantidad solicitada en NEST");
            } else if (porcentaje >= 90 && porcentaje <= 100) {
                document.getElementById("porcentaje").style.color = "green";
            } else if (porcentaje >= 70 && porcentaje < 90) {
                document.getElementById("porcentaje").style.color = "orange";
            } else {
                document.getElementById("porcentaje").style.color = "red";
            }

            $("#porcentaje")[0].textContent = porcentaje + "%";
        } else {
            alertify.alert("Error", "No se pueden aceptar números negativos");
        }
    });
    // Fin del event listener --------------------------------

    // Event listener para la cantidad de horas trabajadas -------------------------------------
    const input2 = document.querySelector("#Placa_cortadaT");
    input2.addEventListener("input", function (e) {
        let horasTrab = (50 * (Number(e.target.value)) / 1) / 60;
        horasTrab = horasTrab.toFixed(2);
        $("#HorasT")[0].value = horasTrab;
    });

    // Fin del otro event listener --------------------------

    noCarga = btn.parentNode.previousElementSibling.textContent;

    let datosProc = {
        "NoProc": noCarga
    };

    $.ajax({
        type: 'POST',
        url: '../Php_forms/get_orden_carga.php',
        data: datosProc,
        async: false,
        success: function (returningInsert) {
            // alert(returningInsert);
            if (returningInsert.includes("Warning") || returningInsert == "Nada") {
                alertify.alert("Error", "Se ha producido un error, revise su conexión a internet");
            } else {
                No_ordenCC = returningInsert;
            }
        }
    });

    document.getElementById("DetrasP").style.filter = "blur(8px) grayscale(100%)";
    document.getElementById("DetrasP").style.pointerEvents = "none";
    document.getElementById("modalCorte").style.filter = "blur(0)";
}

function ReportarCarga_Corte() {

    let cantidadReportada = $("#CantidadRep")[0].value;
    let placasCortadas = $("#Placa_cortadaT")[0].value;
    let horas = $("#HorasT")[0].value;
    let Observaciones = $("#Observaciones")[0].value;

    let PorcentajeCum = $("#porcentaje")[0].textContent;

    if (cantidadReportada == null || cantidadReportada == "") {
        alertify.alert("Aviso", "No se ha ingresado la cantidad reportada");
    } else {
        if (placasCortadas == null || placasCortadas == "") {
            alertify.alert("Aviso", "No se ha ingresado la cantidad de placas cortadas");
        } else {
            if (horas == null || horas == "") {
                alertify.alert("Aviso", "No se ha ingresado la cantidad de horas trabajadas");
            } else {


                if (Observaciones == null || Observaciones == "") {
                    Observaciones = "Ninguna";
                }

                if (Number(cantidadReportada) < NEST_solicGlobal) {
                    // Agregar una nueva carga de trabajo
                    let Nturno;
                    TurnoGlobal == "Turno 1" ? Nturno = "Turno 2" : Nturno = "Turno 1";

                    let NCantNEST = NEST_solicGlobal - cantidadReportada;
                    let NCantPlacas = Number(placasNEST) - Number(placasCortadas);
                    let placas;
                    NCantPlacas <= 0 ? placas = "Por destinar" : placas = NCantPlacas.toString();
                    let NHorasProy = Number(HorasPGlobal) - Number(horas);
                    let HP;
                    NHorasProy <= 0 ? HP = "Por destinar" : HP = NHorasProy.toString();

                    let parametrosCargaRes = {
                        "Fecha": FechaCargaGlobal,
                        "Estatus": "Restante",
                        "FechaLimite": FechaLimiteCGlobal,
                        "Turno": Nturno,
                        "Operador": "Por destinar",
                        "Maquina": "Por destinar",
                        "No_orden": No_ordenCC,
                        "Espesor": EspesorGlobal,
                        "FolioMP": ValeMPGlobal,
                        "NEST_solic": NCantNEST,
                        "Placa_NEST": placas,
                        "HorasP": HP
                    };

                    $.ajax({
                        type: 'POST',
                        url: '../Php_forms/Insert_NCorte.php',
                        data: parametrosCargaRes,
                        async: false,
                        success: function (returnNCargaRes) {
                            if (returnNCargaRes != "si") {
                                alertify.alert("Error", "Se ha producido un error al realizar esta carga de trabajo, revise sus datos. Si el problema persiste, vuelva a iniciar sesión");
                            } else {
                                alertify.alert("¡Exito!", "Se ha agregado una nueva carga de trabajo restante");

                                //Actualizar datos
                                let parametrosReporte = {
                                    "NoReporte": noCarga,
                                    "Estatus": "Terminado",
                                    "Cantidad_reportada": cantidadReportada,
                                    "Placas_cortadas": placasCortadas,
                                    "Horas_trabajadas": horas,
                                    "Observaciones": Observaciones,
                                    "Porcentaje_cum": PorcentajeCum
                                }

                                $.ajax({
                                    type: 'POST',
                                    url: '../Php_forms/Actualizar_Carga.php',
                                    data: parametrosReporte,
                                    async: false,
                                    success: function (returnCarga) {
                                        // alert(returnCarga);
                                        if (returnCarga != "Si") {
                                            alertify.error("Se ha producido un error al actualizar carga");
                                        } else {
                                            alertify.success("Carga actualizada");
                                            RefreshCC();
                                            $("#modalCorte").hide(800);
                                        }
                                    }
                                });
                            }
                        }
                    });

                } else {
                    //Actualizar datos
                    let parametrosReporte = {
                        "NoReporte": noCarga,
                        "Estatus": "Terminado",
                        "Cantidad_reportada": cantidadReportada,
                        "Placas_cortadas": placasCortadas,
                        "Horas_trabajadas": horas,
                        "Observaciones": Observaciones,
                        "Porcentaje_cum": PorcentajeCum
                    }

                    $.ajax({
                        type: 'POST',
                        url: '../Php_forms/Actualizar_Carga.php',
                        data: parametrosReporte,
                        async: false,
                        success: function (returnCarga) {
                            // alert(returnCarga);
                            if (returnCarga != "Si") {
                                alertify.error("Se ha producido un error al actualizar la carga");
                            } else {
                                alertify.success("Carga actualizada");
                                RefreshCC();
                                $("#modalCorte").hide(800);
                            }
                        }
                    });
                }

            }
        }
    }
}

// --------------------------------- Modal detallado
let FechaMD, EstatusMD, FechaLiMD, TurnoMD, OperadorMD, TipoMD, DiseñoMD, OrdenMD, CantSoliMD, CantEntreMD, HorasMD, ObservacionesMD;
let noCargaD;

function mostrarModalDetallado(btn) {
    $("#modalDetallado").show(800);
    $("#CantidadEntregadaD")[0].value = "";
    $("#HorasD")[0].value = "";
    $("#ObservacionesD")[0].value = "";
    $("#porcentajeD")[0].textContent = "0%";
    document.getElementById("porcentajeD").style.color = "black";

    FechaMD = btn.parentNode.nextElementSibling.textContent;
    EstatusMD= btn.parentNode.nextElementSibling.nextElementSibling.textContent;
    FechaLiMD = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    TurnoMD = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    OperadorMD = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    TipoMD = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    DiseñoMD = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    OrdenMD = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    CantSoliMD = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    CantEntreMD = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    HorasMD = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    ObservacionesMD = btn.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;

    const input = document.querySelector("#CantidadEntregadaD");

    input.addEventListener("input", function (e) {
        let porcentaje = (e.target.value * 100) / Number(CantSoliMD);
        porcentaje = porcentaje.toFixed(2);
        if (porcentaje > 100) {
            alertify.alert("Aviso", "Usted está sobrepasando la cantidad solicitada en NEST");
        } else if (porcentaje >= 90 && porcentaje <= 100) {
            document.getElementById("porcentajeD").style.color = "green";
        } else if (porcentaje >= 70 && porcentaje < 90) {
            document.getElementById("porcentajeD").style.color = "orange";
        } else {
            document.getElementById("porcentajeD").style.color = "red";
        }

        $("#porcentajeD")[0].textContent = porcentaje + "%";
    });

    const input2 = document.querySelector("#CantidadEntregadaD");
    input2.addEventListener("input", function (e) {
        let horasTrab = (50 * (Number(e.target.value)) / 1) / 60;
        horasTrab = horasTrab.toFixed(2);
        $("#HorasD")[0].value = horasTrab;
    });
    noCargaD = btn.parentNode.previousElementSibling.textContent;

    let datosProc = {
        "NoProc": noCargaD
    };

    $.ajax({
        type: 'POST',
        url: '../Php_forms/get_orden_cargadetallado.php',
        data: datosProc,
        async: false,
        success: function (returningInsertD) {
            // alert(returningInsert);
            if (returningInsertD.includes("Warning") || returningInsertD == "Nada") {
                alertify.alert("Error", "Se ha producido un error, revise su conexión a internet");
            } else {
                No_ordenCC = returningInsertD;
            }
        }
    });

    document.getElementById("DetrasP").style.filter = "blur(8px) grayscale(100%)";
    document.getElementById("DetrasP").style.pointerEvents = "none";
    document.getElementById("modalDetallado").style.filter = "blur(0)";
}

function ReportarCarga_Detallado() {

    let CantidadEntregadaD = $("#CantidadEntregadaD")[0].value;
    let HorasD = $("#HorasD")[0].value;
    let ObservacionesD = $("#ObservacionesD")[0].value;
    let PorcentajeCum = $("#porcentajeD")[0].textContent;

    if (CantidadEntregadaD == null || CantidadEntregadaD == "") {
        alertify.alert("Aviso", "No se ha ingresado la cantidad reportada");
    } else {
        if (HorasD == null || HorasD == "") {
            alertify.alert("Aviso", "No se ha ingresado la cantidad de horas trabajadas");
        } else {
            if (ObservacionesD == null || ObservacionesD == "") {
                ObservacionesD = "Ninguna";
            }

            if (Number(CantidadEntregadaD) < CantSoliMD) {
                // Agregar una nueva carga de trabajo
                let Nturno;
                TurnoMD == "Turno 1" ? Nturno = "Turno 2" : Nturno = "Turno 1";

                let NCant = CantSoliMD - CantidadEntregadaD;

                let parametrosConsultaN = {
                    "ordenConsulta": OrdenMD,
                    "disenoConsulta": DiseñoMD
                };
                $.ajax({
                    type: 'POST',
                    url: '../Php_forms/Get_noOrdenDetallado.php',
                    data: parametrosConsultaN,
                    async: false,
                    success: function (returningN) {
                        if (returningN == "notFound") {
                            alertify.alert("Error", "Parece que no hay ninguna orden de compra, revise sus datos");
                            // alert("No orden existente");
                        } else if (returningN.includes("Fatal Error")) {
                            alertify.alert("Error", "Se ha producido un error, revise su conexión a internet");
                            // alert("Error de conexión");
                        } else {
                            let parametrosCargaResD = {
                                "Estatus": "Restante",
                                "Fecha": FechaMD,
                                "FechaLimite": FechaLiMD,
                                "Turno": Nturno,
                                "Operador": "Por destinar",
                                "TipoDetallado": "Por destinar",
                                "No_orden": returningN,
                                "CantidadS": NCant
                            };

                            $.ajax({
                                type: 'POST',
                                url: '../Php_forms/Insert_NDetallado.php',
                                data: parametrosCargaResD,
                                async: false,
                                success: function (returnNCargaRestD) {
                                    if (returnNCargaRestD != "si") {
                                        alertify.alert("Error", "Se ha producido un error al agregar el seguimiento del proceso");
                                    } else {
                                        alertify.alert("¡Exito!", "Se ha agregado una nueva carga de trabajo restante");

                                        //Actualizar datos
                                        let parametrosReporte = {
                                            "NoReporte": noCargaD,
                                            "Estatus": "Terminado",
                                            "Cantidad_reportada": CantidadEntregadaD,
                                            "Horas_trabajadas": HorasD,
                                            "Observaciones": ObservacionesD,
                                            "Porcentaje_cum": PorcentajeCum
                                        }
                                        $.ajax({
                                            type: 'POST',
                                            url: '../Php_forms/Actualizar_Carga_Detallado.php',
                                            data: parametrosReporte,
                                            async: false,
                                            success: function (returnCargaNRD) {
                                                // alert(returnCarga);
                                                if (returnCargaNRD != "Si") {
                                                    alertify.error("Se ha producido un error al agregar el seguimiento del proceso");
                                                } else {
                                                    alertify.success("Carga actualizada");
                                                    RefreshCD();
                                                    $("#modalDetallado").hide(800);
                                                }
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    }
                });
                //Ya quedo la actualizada tuuuuuuuuuu
            } else {
                //Actualizar datos
                let parametrosReporte = {
                    "NoReporte": noCargaD,
                    "Estatus": "Terminado",
                    "Cantidad_reportada": CantidadEntregadaD,
                    "Horas_trabajadas": HorasD,
                    "Observaciones": ObservacionesD,
                    "Porcentaje_cum": PorcentajeCum
                }

                $.ajax({
                    type: 'POST',
                    url: '../Php_forms/Actualizar_Carga_Detallado.php',
                    data: parametrosReporte,
                    async: false,
                    success: function (returnCargaND) {
                        // alert(returnCarga);
                        if (returnCargaND != "Si") {
                            alertify.error("Se ha producido un error al actualizar carga 2 putito");
                        } else {
                            alertify.success("Carga actualizada");
                            RefreshCD();
                            $("#modalDetallado").hide(800);
                        }
                    }
                });
            }
        }
    }
}
// --------------------------------- FIN TURNOS/CORTE TURNO ---------------------------------

// -------------------------------- CARGA --------------------------

function buscarCargas() {
    // Cargas de corte
    let fechaCarga = $("#FechaCarga")[0].value;
    let filtro;
    if( (!document.getElementById('Rbt-Terminado').checked) && (!document.getElementById('Rbt-Restante').checked) && (!document.getElementById('Rbt-Proceso').checked) ){
        filtro = "0";
    }else{
        if( (document.getElementById('Rbt-Terminado').checked) && (!document.getElementById('Rbt-Restante').checked) && (!document.getElementById('Rbt-Proceso').checked) ){
            filtro = "1";
        }else if( (document.getElementById('Rbt-Terminado').checked) && (document.getElementById('Rbt-Restante').checked) && (!document.getElementById('Rbt-Proceso').checked) ){
            filtro = "12";
        }else if( (document.getElementById('Rbt-Terminado').checked) && (document.getElementById('Rbt-Restante').checked) && (document.getElementById('Rbt-Proceso').checked) ){
            filtro = "123";
        }else if( (!document.getElementById('Rbt-Terminado').checked) && (document.getElementById('Rbt-Restante').checked) && (!document.getElementById('Rbt-Proceso').checked) ){
            filtro = "2";
        }else if( (!document.getElementById('Rbt-Terminado').checked) && (document.getElementById('Rbt-Restante').checked) && (document.getElementById('Rbt-Proceso').checked) ){
            filtro = "23";
        }else if((!document.getElementById('Rbt-Terminado').checked) && (!document.getElementById('Rbt-Restante').checked) && (document.getElementById('Rbt-Proceso').checked)){
            filtro = "3";
        }else{
            filtro = "13";
        }
    }

    let parametros = {
        "act": "yes",
        "filtro": filtro,
        "fechaCarga": fechaCarga
    };

    $.ajax({
        type: 'POST',
        url: '../Php_forms/Buscar_Carga.php',
        data: parametros,
        async: false,
        success: function (returnBusqueda) {
            // alert(returnCarga);
            if (returnBusqueda == "Nada") {
                alertify.alert("¡Oops!", "Parece que no hay cargas con la información ingresada, intente de nuevo");
            } else {
                if (returnBusqueda.includes("FATAL ERROR")) {
                    alertify.alert("Error", "Se ha producido un error, revise su conexión a internet");
                } else {
                    if (returnBusqueda == "") {
                        alertify.alert("¡Oops!", "Parece que no hay cargas de trabajo");
                    } else {
                        $("#cuerpoTabla")[0].value = "";
                        document.getElementById("cuerpoTabla").innerHTML = returnBusqueda;
                    }
                }
            }
        }
    });
}

function buscarCargasDetallado() {

    let fechaCarga = $("#FechaCarga")[0].value;
    let filtroD;
    if( (!document.getElementById('Rbt-Terminado').checked) && (!document.getElementById('Rbt-Restante').checked) && (!document.getElementById('Rbt-Proceso').checked) ){
        filtroD = "0";
    }else{
        if( (document.getElementById('Rbt-Terminado').checked) && (!document.getElementById('Rbt-Restante').checked) && (!document.getElementById('Rbt-Proceso').checked) ){
            filtroD = "1";
        }else if( (document.getElementById('Rbt-Terminado').checked) && (document.getElementById('Rbt-Restante').checked) && (!document.getElementById('Rbt-Proceso').checked) ){
            filtroD = "12";
        }else if( (document.getElementById('Rbt-Terminado').checked) && (document.getElementById('Rbt-Restante').checked) && (document.getElementById('Rbt-Proceso').checked) ){
            filtroD = "123";
        }else if( (!document.getElementById('Rbt-Terminado').checked) && (document.getElementById('Rbt-Restante').checked) && (!document.getElementById('Rbt-Proceso').checked) ){
            filtroD = "2";
        }else if( (!document.getElementById('Rbt-Terminado').checked) && (document.getElementById('Rbt-Restante').checked) && (document.getElementById('Rbt-Proceso').checked) ){
            filtroD = "23";
        }else if((!document.getElementById('Rbt-Terminado').checked) && (!document.getElementById('Rbt-Restante').checked) && (document.getElementById('Rbt-Proceso').checked)){
            filtroD = "3";
        }else{
            filtroD = "13";
        }
    }
    let parametros = {
        "act": "yes",
        "filtro": filtroD,
        "fechaCarga": fechaCarga
    };

    $.ajax({
        type: 'POST',
        url: '../Php_forms/Buscar_CargaDetallado.php',
        data: parametros,
        async: false,
        success: function (returnBusqueda1) {
            // alert(returnCarga);
            if (returnBusqueda1 == "Nada") {
                alertify.alert("¡Oops!", "Parece que no hay cargas para esta fecha, intente de nuevo");
            } else {
                if (returnBusqueda1.includes("FATAL ERROR")) {
                    alertify.alert("Error", "Se ha producido un error, revise su conexión a internet");
                } else {
                    if (returnBusqueda1 == "") {
                        alertify.alert("¡Oops!", "Parece que no hay cargas de trabajo");
                    } else {
                        $("#cuerpoTabla")[0].value = "";
                        document.getElementById("cuerpoTabla").innerHTML = returnBusqueda1;
                    }
                }
            }
        }
    });
}

// -------------------------------------