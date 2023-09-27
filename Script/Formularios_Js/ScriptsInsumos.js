function nuevo_Insumo() {
    let IdentificadorIn = $("#IdentificadorInsumo")[0].value;
    let NombreIn = $("#NombreInsumo")[0].value;
    let DescripcionIn = $("#DescripcionInsumo")[0].value;
    let EspecificaionesIn = $("#EspecificacionesInsumo")[0].value;
    let CategoriaIn = $("#CategoriasInsumo")[0].value;

    if(IdentificadorIn == null || IdentificadorIn == ""){
        alertify.alert("Aviso", "No se ha ingresado el identificador del insumo");
    }else{
        if (NombreIn == null || NombreIn == "") {
            alertify.alert("Aviso", "No se ha ingresado el nombre del insumo");
        } else {
            if (DescripcionIn == null || DescripcionIn == "") {
                alertify.alert("Aviso", "No se ha ingresado la descripción del insumo");
            } else {
                if (EspecificaionesIn == null || EspecificaionesIn == "") {
                    alertify.alert("Aviso", "No se ha ingresado la especificación del insumo");
                } else {
                    if (CategoriaIn == null || CategoriaIn == "") {
                        alertify.alert("Aviso", "No se ha ingresado la categoria del insumo");
                    } else {
                        let parametros = {
                            "TipoCate": CategoriaIn
                        };
                        // Enviar por Ajax
                        $.ajax({
                            type: 'POST',
                            url: '../Php_forms_insumos/GetNoCategoria.php',
                            data: parametros,
                            async: false,
                            success: function (returning) {
                                if (returning == "notFound") {
                                    alertify.alert("Error", "Aguas con la categoria");
                                } else {
                                    let parametrosIn = {
                                        "Identificador": IdentificadorIn,
                                        "Nombre": NombreIn,
                                        "Descripcion": DescripcionIn,
                                        "Especificaciones": EspecificaionesIn,
                                        "Categoria": returning
                                    };
                                    // Enviar por Ajax
                                    $.ajax({
                                        type: 'POST',
                                        url: '../Php_forms_insumos/Insert_Insumo.php',
                                        data: parametrosIn,
                                        async: false,
                                        success: function (returnings) {
                                            if (returnings == "si") {
                                                // alertify.success('Pieza agregada');
                                                alertify.alert("¡Exito!", "Nuevo insumo agregado con éxito");
                                                let formulario = $("#form_nuevoD");
                                                $("#IdentificadorInsumo")[0].value="";
                                                $("#NombreInsumo")[0].value="";
                                                $("#DescripcionInsumo")[0].value="";
                                                $("#EspecificacionesInsumo")[0].value="";
                                                $("#CategoriasInsumo")[0].value="";
                                            } else {
                                                alertify.alert("Error", "Se ha producido un error al ingresar el insumo revise que no exista ya un insumo con estos datos o el identificador");
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

function nueva_Entrada(){
    let FechaEn = $("#FechaEn")[0].value;
    let IdentificadorEn = $("#IdentificadorEn")[0].value;
    let CantidadEn = $("#CantidadEn")[0].value;
    if (FechaEn == null || FechaEn == ""){
        alertify.alert("Aviso", "No se ha ingresado una fecha");
    } else{
        if(IdentificadorEn == null || IdentificadorEn == ""){
            alertify.alert("Aviso", "No se ha ingresado el identificador del insumo");
        }else{
            if (CantidadEn == null || CantidadEn == ""){
                alertify.alert("Aviso", "No se ha ingresado cantidad de entrada");
            }
            else{
                let parametrosEn2 = {
                    "Fecha": FechaEn,
                    "IdProd": IdentificadorEn,
                    "Cantidad": CantidadEn
                };
                // Enviar por Ajax
                $.ajax({
                    type: 'POST',
                    url: '../Php_forms_insumos/InsertEntrada.php',
                    data: parametrosEn2,
                    async: false,
                    success: function (returningEn2) {
                        if (returningEn2 != "si") {
                            alertify.alert("Error", "Revise los datos de la entrada");
                        } else {
                            alertify.alert("¡Exito!", "Nueva entrada registrada con éxito");
                            let formulario = $("#form_nuevoD");
                            $("#FechaEn")[0].value="";
                            $("#IdentificadorEn")[0].value="";
                            $("#CantidadEn")[0].value="";
                        }
                    }
                });
            }
        }
    }
}

function nueva_Salida(){
    let FechaSa = $("#FechaSa")[0].value;
    let IdentificadorSa = $("#IdentificadorSa")[0].value;
    let CantidadSa = $("#CantidadSa")[0].value;
    if (FechaSa == null || FechaSa == ""){
        alertify.alert("Aviso", "No se ha ingresado una fecha");
    } else{
        if(IdentificadorSa == null || IdentificadorSa == ""){
            alertify.alert("Aviso", "No se ha ingresado el identificador del insumo");
        }else{
            if (CantidadSa == null || CantidadSa == ""){
                alertify.alert("Aviso", "No se ha ingresado cantidad de entrada");
            }
            else{
                let parametrosSa = {
                    "Fecha": FechaSa,
                    "IdProd": IdentificadorSa,
                    "Cantidad": CantidadSa
                };
                // Enviar por Ajax
                $.ajax({
                    type: 'POST',
                    url: '../Php_forms_insumos/InsertSalida.php',
                    data: parametrosSa,
                    async: false,
                    success: function (returningSa) {
                        if (returningSa != "si") {
                            alertify.alert("Error", "Revise los datos de la entrada");
                        } else {
                            alertify.alert("¡Exito!", "Nueva salida registrada con éxito");
                            let formulario = $("#form_nuevoD");
                            $("#FechaSa")[0].value="";
                            $("#IdentificadorSa")[0].value="";
                            $("#CantidadSa")[0].value="";
                        }
                    }
                });
            }
        }
    }
}