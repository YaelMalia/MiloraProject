function nuevo_Insumo() {
    let NombreIn = $("#NombreInsumo")[0].value;
    let DescripcionIn = $("#DescripcionInsumo")[0].value;
    let EspecificaionesIn = $("#EspecificacionesInsumo")[0].value;
    let CategoriaIn = $("#CategoriasInsumo")[0].value;

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
                            alert(returning);
                            if (returning == "notFound") {
                                alertify.alert("Error", "Aguas con la categoria");
                            } else {
                                let parametrosIn = {
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
                                        alert(returnings);
                                        if (returnings == "si") {
                                            // alertify.success('Pieza agregada');
                                            alertify.alert("¡Exito!", "El modelo o pieza se ha agregado con éxito");
                                            let formulario = $("#form_nuevoD");
                                            $("#NombreInsumo")[0].value="";
                                            $("#DescripcionInsumo")[0].value="";
                                            $("#EspecificacionesInsumo")[0].value="";
                                            $("#CategoriasInsumo")[0].value="";
                                        } else {
                                            alertify.alert("Error", "Se ha producido un error al ingresar el insumo revise que no exista ya un insumo con estos datos");
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