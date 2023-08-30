// -------------------------------- INICIAN PIEZAS --------------------------------
function nueva_Pieza(){
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
 
    if(noDiseno == null || noDiseno == ""){
         alertify.alert("Aviso", "No se ha ingresado el número de diseño o pieza");
    }else{
         if(descripcion_mp == null || descripcion_mp == ""){
             alertify.alert("Aviso", "No se ha ingresado descripción de materia prima");
         }else{
             if(codigo_mp == null || codigo_mp == ""){
                 alertify.alert("Aviso", "No se ha ingresado el código de materia prima"); 
             }else{
                 // Nada vacío -----
 
                 flag = true;
                 if(flag == true){
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
                         success: function(returning){
                             if(returning == "si"){
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
                             }else{
                                 alertify.alert("Error", "Se ha producido un error al ingresar el número de diseño o pieza, revise que no esté repetida");
                             }
                         }
                     });
                 }
             }
         }
    }
}

function buscar_Pieza(){
    let noDiseno = $("#No_disenoFD")[0].value;
    if(noDiseno == null || noDiseno.includes(' ') || noDiseno == ""){
        alertify.alert("Error", "No se ha ingresado un número de diseño o está mal escrito");
    }else{
        let parametros = {
            "noDiseno": noDiseno
        };
        // Envío por Ajax
        $.ajax({
            type: 'POST',
            url: '../Php_forms/Select_Pieza.php',
            data: parametros,
            success: function(returning){
                if(returning!="no"){
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
                }else{
                    alertify.alert("Error", "Número de diseño proporcionado no existe o está equivocado");
                }
            }
        });
    }
}

function busqueda_Filtrada_Piezas(Seleccion){
    
    let identificador = "";
    if(Seleccion == "noDiseno"){
        identificador = $("#No_disenoFD")[0].value;
    }else{
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
            success: function(returning){
                if(returning!="No"){
                    $("#cuerpoTabla")[0].value = "";
                    document.getElementById("cuerpoTabla").innerHTML = returning;
                    // alert(returning);
                }else{
                    alertify.alert("Error", "Pieza no se ha encontrado, revise sus datos");
                }
            }
    });
}

function actualizar_Pieza(){
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

   if(noDiseno == null || noDiseno == ""){
        alertify.alert("Aviso", "No se ha ingresado el número de diseño o pieza");
   }else{
        if(descripcion_mp == null || descripcion_mp == ""){
            alertify.alert("Aviso", "No se ha ingresado descripción de materia prima");
        }else{
            if(codigo_mp == null || codigo_mp == ""){
                alertify.alert("Aviso", "No se ha ingresado el código de materia prima"); 
            }else{
                // Nada vacío -----

                flag = true;
                if(flag == true){
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
                        success: function(returning){
                            if(returning == "si"){
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


                            }else{
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
function AgregarOrden(){
    
    let fecha_inicio = $("#Fecha_inicio")[0].value;
    let fecha_limite = $("#Fecha_final")[0].value;
    let orden_compra = $("#Orden_de_compra")[0].value;
    let cliente = $("#lst_Clientes")[0].value;
    let noDiseno = $("#No_diseno")[0].value;
    let noPiezas = $("#Numero_de_piezas")[0].value;

    let flag = false;

    if(fecha_inicio == null || fecha_inicio == ""){
        alertify.alert("Error", "Fecha de inicio de la orden no se ha ingresado");
    }else{
        if(fecha_limite == null || fecha_limite == ""){
            alertify.alert("Error", "Fecha límite de la orden no se ha ingresado");
        }else{
            if(orden_compra == null || orden_compra == ""){
                alertify.alert("Error", "No se ha ingresado el identificador de la orden de compra");
            }else{
                if(cliente == null || cliente == ""){
                    alertify.alert("Error", "No se ha seleccionado un cliente de compra válido");
                }else{
                    if(noDiseno == null || noDiseno == ""){
                        alertify.alert("Eror", "No se ha ingresado un número de diseño");
                    }else{
                        if(noPiezas == null || noPiezas == ""){
                            alertify.alert("Error", "No se ha ingresado la cantidad de piezas para la orden de compra");
                        }else{
                            if(noPiezas<=0){
                                alertify.alert("Error", "La cantidad de piezas para la orden no puede ser menor a cero");
                            }else{
                                flag = true;
                            }
                            if(flag == true){
                               
                                if(Date.parse(fecha_limite) < Date.parse(fecha_inicio)){
                                    alertify.alert("Error", "La fecha límite no puede ser menor a la fecha de inicio de la orden de compra, intenta de nuevo");
                                }else{
                                     // Todo correcto

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
                                        success: function(returning){
                                            if(returning=="si"){
                                                alertify.alert("¡Exito!", "Se ha registrado la nueva orden de compra correctamente");
                                                $("#Fecha_inicio")[0].value = "";
                                                $("#Fecha_final")[0].value = "";
                                                $("#Orden_de_compra")[0].value = "";
                                                $("#lst_Clientes")[0].value = "";
                                                $("#No_diseno")[0].value = "";
                                                $("#Numero_de_piezas")[0].value = "";
                                            }else{
                                                alertify.alert("Error", "No se ha podido agregar la orden de compra, revisa los datos ingresados e intenta de nuevo");
                                            }
                                        }                                     
                                     });

                                }

                            }else{
                                if(noPiezas<=0){
                                    alertify.alert("Error", "La cantidad de piezas para la orden no puede ser menor a cero");
                                }else{
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

function OrdenesResFull(Seleccion){

    document.getElementById("Cuerpo_tabla").innerText="";

    let fechaInf = $("#De_fecha")[0].value;
    let fechaSup = $("#Hasta_fecha")[0].value;
    let ordenC = $("#Orden_c")[0].value;
    let noDiseno = $("#Nodiseno")[0].value;
    let cliente = $("#Cliente")[0].value;

    if(fechaInf == "" && fechaSup == "" && ordenC == "" && noDiseno == "" && cliente == ""){
        let parametros = {
            "tipoVista": Seleccion
        };
        $.ajax({
            type: 'POST',
            url: '../Php_forms/Get_Ordenes.php',
            data: parametros,
            success: function(returning){
                if(Seleccion == "Resumida"){
                    $("#Head_completa").hide();
                    $("#Head_resumida").show();
                }else{
                    $("#Head_completa").show();
                    $("#Head_resumida").hide();
                }
                if(returning!="Nada"){
                    document.getElementById("Cuerpo_tabla").innerHTML=returning;
                }else{
                    alertify.alert("¡Oops!", "No se han podido recopilar los datos, intente más tarde");
                }
            }
        });
    }else{
        var banderaF = false;
        if(fechaInf!=""){
            if(fechaSup == ""){
                alertify.alert("Error", "Se necesita una fecha límite (Hasta el día) para filtrar la búsqueda")
                // alert("Error");
            }else{
                if(Date.parse(fechaInf) > Date.parse(fechaSup)){
                    alertify.alert("Error", "La fecha superior no puede ser menor a la fecha de inicio, intenta de nuevo");
                    // alert("error__");
                    banderaF = false;
                }else{
                    banderaF = true;

                    if(banderaF == true){
            
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
                            success: function(returning){
                                // alert(returning);
                                if(Seleccion == "Resumida"){
                                    $("#Head_completa").hide();
                                    $("#Head_resumida").show();
                                }else{
                                    $("#Head_completa").show();
                                    $("#Head_resumida").hide();
                                }
                                if(returning!="Nada"){
                                    document.getElementById("Cuerpo_tabla").innerHTML=returning;
                                }else{
                                    alertify.alert("¡Oops!", "No se han encontrado ordenes de compra con los datos proporcionados");
                                }
                            }
                        });
                    }
                }
                
            }
        }else{
            if(fechaSup == ""){
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
                    success: function(returning){
                        // alert(returning);
                        if(Seleccion == "Resumida"){
                            $("#Head_completa").hide();
                            $("#Head_resumida").show();
                        }else{
                            $("#Head_completa").show();
                            $("#Head_resumida").hide();
                        }
                        if(returning!="Nada"){
                            document.getElementById("Cuerpo_tabla").innerHTML=returning;
                        }else{
                            alertify.alert("¡Oops!", "No se han podido recopilar los datos, intente nuevamente");
                        }
                    }
                });
            }else{
                alertify.alert("Error", "Falta una fecha por asignar");

            }
        }
        
    }
}

// -------------------------------- Busqueda para editar --------------------------------
var NoOrdenGlobal;
var PRealizadasGlobal;

function Buscar_Orden_Filtro(){
    let ordenB = $("#B_orden")[0].value;
    let disenoB = $("#B_Diseno")[0].value;

    if(ordenB == ""){
        alertify.alert("¡Oops!", "Parece que no se ha llenado el campo de 'Orden' para la búsqueda");
    }else{
        if(disenoB == ""){
         alertify.alert("¡Oops!", "Parece que no se ha llenado el campo de 'diseño' para la búsqueda");
        }else{
            // Correcto
            let parametros = {
                "ordenBuscar": ordenB,
                "disenoBuscar": disenoB
            };

            $.ajax({
                type: 'POST',
                url: '../Php_forms/Search_Orden_Editar.php',
                data: parametros,
                success: function(returning){

                    if(returning!="no"){
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
                    }else{
                        alertify.alert("¡Oops!", "Parece que no se ha encontrado ninguna orden de compra con los datos proporcionados, verifique sus datos");
                    }
                }});

        }
    }
}

function Editar_Orden(){
    let flag = false;
    let RazonCambio;
    alertify.prompt('Ingrese un motivo del cambio en la orden de compra:\nAmpliación/Reducción/Datos', ''
               , function(evt, value) { RazonCambio = value;
                if(RazonCambio == "Ampliación" || RazonCambio == "Reducción" || RazonCambio == "Datos"){
                    flag = true;
                    alertify.success('Motivo de cambio agregado');

                    if(flag == true){

                        //Mandamos a llamar el editar

                        let ordenB = $("#B_orden")[0].value;
                        let disenoB = $("#B_Diseno")[0].value;


                        let fechaF = $("#Fecha_final")[0].value;
                        let ordenC = $("#Orden_de_compra")[0].value;
                        let noDiseno = $("#No_diseno")[0].value;
                        let cantidadP = $("#Numero_de_piezas")[0].value;
                        let cliente = $("#Cliente")[0].value;
                
                        if(fechaF == "" || ordenC == "" || noDiseno == "" || cantidadP == "" || cliente == ""){
                            alertify.alert("Error", "Vaya, parece que uno o más campos están vacíos, revise sus datos");
                        }else{
                            if(RazonCambio == "Datos"){
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
                                success: function(returning){
                                    if(returning!="no"){
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
                                        alert(Restantes);

                                        P_restantes = {
                                            "NoOrden":NoOrdenGlobal,
                                            "Restantes": Restantes
                                        };

                                        $.ajax({
                                            type: 'POST',
                                            url: '../Php_forms/Actualiza_restantes.php',
                                            data: P_restantes,
                                            async: false,
                                            success: function(res){
                                                if(res=="si"){
                                                    alert("Cantidad de piezas restantes actualizada");
                                                }else{
                                                    alert("No se ha podido actualizar la cantidad restante");
                                                }
                                            }
                                        });

                                    }else{
                                        alertify.alert("Error", "No se ha podido actualizar la orden de compra, revise sus datos e intente nuevamente");
                                    }
                                }
                            });
                        }
                
                    }else{
                        alertify.alert("Aviso", "No se puede continuar con el proceso hasta que se agregue un motivo de cambio válido");
                    }

                }else{
                    alertify.alert("Aviso", "No se puede continuar con el proceso hasta que se agregue un motivo de cambio válido");
                    alertify.error('Ingrese un motivo válido');
                }
            });
}
// -------------------------------- FIN ORDENES DE COMPRA -------------------------------- //

// ------------------------------- INICIAN REGISTRO DE ENTRADAS --------------------------------//
function RegistrarEntrada(){
    let fecha_Entrada = $("#Fecha_de_ingreso")[0].value;
    let ordenCompra = $("#Orden_de_compra")[0].value;
    let noDiseno = $("#Numero_de_pieza")[0].value;
    let cantidadPiezas = $("#Cantidad_de_piezas")[0].value;

    if(fecha_Entrada == "" || ordenCompra == "" || noDiseno == "" || cantidadPiezas == ""){
        alertify.alert("Aviso", "Faltan por llenar uno o más campos, revise sus datos");
        // alert("Faltan datos");
    }else{
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
            success: function(returning){
               if(returning == "notFound"){
                alertify.alert("Error", "Parece que no hay ninguna orden de compra con dicha pieza, revise sus datos");
                // alert("No orden existente");
               }else if(returning.includes("Fatal Error")){
                alertify.alert("Error", "Se ha producido un error, revise su conexión a internet");
                // alert("Error de conexión");
               }else{
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
                    success: function(returningEntrada){
                        alert(returningEntrada);
                        if(returningEntrada!="no" && !returningEntrada.includes("Cantidad de entrada supera a las restantes")){
                            alertify.alert("¡Exito!", "Se ha registrado una entrada en el almacén");
                            // alert(returningEntrada);
                            $("#Fecha_de_ingreso")[0].value = "";
                            $("#Orden_de_compra")[0].value = "";
                            $("#Numero_de_pieza")[0].value = "";
                            $("#Cantidad_de_piezas")[0].value = "";
                        }else{
                            if(returningEntrada.includes("Cantidad de entrada supera a las restantes")){
                                alertify.alert("Error", "Cantidad de entrada supera a las restantes");
                            }else{
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

function BuscarEntradas(){
    let fechaSa = $("#FechaEn")[0].value;
    let ordenSa = $("#Orden_compraEn")[0].value;
    let noDisenoSa = $("#No_diseñoEn")[0].value;
    if (fechaSa=="" && ordenSa=="" && noDisenoSa==""){
        alertify.alert("Aviso", "No se han ingresado alguno de los datos");
    }else{
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
            success: function(returning){
                if(returning == "Nada"){
                    alertify.alert("Error","No se encontraron datos");
                }else{
                    document.getElementById("cuerpoTabla").innerHTML=returning;
                }
            }
        });
    }
}
// -------------------------------- FIN REGISTRO DE ENTRADAS ---------------------------------//

// ------------------------------- INICIAN REGISTRO DE SALIDAS --------------------------------//
function RegistrarSalida(){
    let fecha_Salida = $("#Fecha_de_salida")[0].value;
    let ordenCompra = $("#Orden_de_compra")[0].value;
    let noDiseno = $("#Numero_de_pieza")[0].value;
    let cantidadPiezas = $("#Cantidad_de_piezas")[0].value;

    if(fecha_Salida == "" || ordenCompra == "" || noDiseno == "" || cantidadPiezas == ""){
        // alertify.alert("Aviso", "Faltan por llenar uno o más campos, revise sus datos");
        alert("Faltan datos");
    }else{
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
            success: function(returning){
               if(returning == "notFound"){
                alertify.alert("Error", "Parece que no hay orden o stock existente, revise sus datos");
                
               }else if(returning.includes("Fatal Error")){
                alertify.alert("Error", "Se ha producido un error, revise su conexión a internet");
                // alert("Error de conexión");
               }else{
                
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
                    success: function(returningSalida){
                        // alert(returningSalida);
                        if(returningSalida.includes("SQLSTATE[45000]")){
                            alertify.alert("Error", "La cantidad de stock para esta orden de compra supera a la cantidad de salida");
                            // alert("cantidad de salida supera al stock");
                        }
                        else{
                            if(returningSalida.includes("OK")){
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
                                    success: function(cantidad){
                                        if(cantidad == 0){
                                            if(confirm("Se ha detectado que las existencias para esta orden de compra ha llegado a cero, ¿deseas cerrar esta orden de compra?")){
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '../Php_forms/CerrarOrden_Auto.php',
                                                    data: p_cerrarCompra,
                                                    async: false,
                                                    success: function(bandera){
                                                        if(bandera == "Hecho"){
                                                            alert("Orden cerrada correctamente");
                                                        }else{
                                                            alert(bandera);
                                                            alert("Se ha producido un error al cerrar la compra, revise su conexión a internet");
                                                        }
                                                    }
                                                });
                                            }
                                        }else{
                                           alert(cantidad);
                                        }
                                    }
                                });

                            }else{
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

function BuscarSalidas(){
    let fechaSa = $("#FechaSa")[0].value;
    let ordenSa = $("#Orden_compraSa")[0].value;
    let noDisenoSa = $("#No_diseñoSa")[0].value;
    if (fechaSa=="" && ordenSa=="" && noDisenoSa==""){
        alert("datos vacios");
    }else{
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
            success: function(returning){
                if(returning == "Nada"){
                    alertify.alert("Error", "No se encontraron datos");
                }else{
                    document.getElementById("cuerpoTabla").innerHTML=returning;
                }
            }
        });
    }
}
// -------------------------------- FIN REGISTRO DE SALIDAS ---------------------------------

// --------------------------------- INICIO STOCK ---------------------------------

function buscarStock(){
   let disenoF = $("#No_disenoSt")[0].value;
   let EstatusF = $("#EstatusSt")[0].value;
   
   if(disenoF == "" && EstatusF == ""){
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
            success: function(returning){
                if(returning == "Nada"){
                    alertify.alert("Error", "No se encontraron datos");
                }else{
                    document.getElementById("cuerpoTabla").innerHTML=returning;
                }
            }
        });
   }else{
    document.getElementById("headTable").innerHTML = '<tr> <th scope="col" data-type="string">No. diseño</th> <th scope="col">Orden de compra</th> <th scope="col">Cantidad de piezas</th> <th scope="col">Estatus</th> </tr>'
    let parametros = {
        "disenoBusqueda" : disenoF,
        "estatusBusqueda": EstatusF
    };
    $.ajax({
            type: 'POST',
            url: '../Php_forms/Search_filtro_stock.php',
            data: parametros,
            async: false,
            success: function(returning){
                if(returning == "Nada"){
                    alertify.alert("Error", "No se encontraron datos");
                }else{
                    document.getElementById("cuerpoTabla").innerHTML=returning;
                }
            }
        });

   }
}
// --------------------------------- FIN BUSQUEDAS STOCK ---------------------------------

// --------------------------------- INICIO TURNOS/CORTE TURNO ---------------------------------
function Insert_Turno(){
    let flag = false; 
    let FechaT = $("#FechaT")[0].value;
    let TurnoT = $("#TurnoT")[0].value;
    let MaquinasT = $("#MaquinasT")[0].value;
    let OperadorT = $("#OperadorT")[0].value;
    let Proceso_piezaT = $("#Proceso_piezaT")[0].value;
    let Folio_mpT = $("#Folio_mpT")[0].value;
    let Cantidad_NESTT = $("#Cantidad_NESTT")[0].value;
    let Cantidad_reportadaT = $("#Cantidad_reportadaT")[0].value;
    let Piezas_FalloT = $("#Piezas_FalloT")[0].value;
    let Placa_solicitadaT = $("#Placa_solicitadaT")[0].value;
    let Placa_cortadaT = $("#Placa_cortadaT")[0].value;
    let Orden_de_compraT = $("#Orden_de_compraT")[0].value;
    let HorasT = $("#HorasT")[0].value;

    if(FechaT == null || FechaT == ""){
        alertify.alert("Error", "Fecha de inicio de la orden no se ha ingresado");
    }else{
        if(TurnoT == null || TurnoT == ""){
            alertify.alert("Error", "Fecha límite de la orden no se ha ingresado");
        }else{
            if(MaquinasT == null || MaquinasT == ""){
                alertify.alert("Error", "No se ha ingresado el identificador de la orden de compra");
            }else{
                if(OperadorT == null || OperadorT == ""){
                    alertify.alert("Error", "No se ha seleccionado un cliente de compra válido");
                }else{
                    if(Proceso_piezaT == null || Proceso_piezaT == ""){
                        alertify.alert("Eror", "No se ha ingresado un número de diseño");
                    }else{
                        if(Folio_mpT == null || Folio_mpT == ""){
                            alertify.alert("Error", "No se ha ingresado la cantidad de piezas para la orden de compra");
                        }else{
                            if(Cantidad_NESTT<=0){
                                alertify.alert("Error", "La cantidad de piezas para la orden no puede ser menor a cero");
                            }else{
                                flag = true;
                            }
                            if(flag == true){
                                
                            }
                        }
                    }
                }
            }
        }
    }
}

function AgregarProceso(){

    let P_diseno = $("#P_Diseno")[0].value;
    let P_orden = $("#P_orden")[0].value;
    let cantidadProd = $("#P_cantidad")[0].value;
    
    if(P_diseno == null || P_diseno == ""){
        alertify.alert("Aviso", "No se ha ingresado un diseño");
    }else{
        if(P_orden == null || P_orden == ""){
            alertify.alert("Aviso", "No se ha ingresado una orden de compra");
        }else{
            if(cantidadProd == null || cantidadProd == "" || cantidadProd <=0){
                alertify.alert("Aviso", "No se ha ingresado una cantidad de producción o no es válida");
            }else{
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
                    success: function(returning){
                        if(returning == "Nada"){
                            alertify.alert("Error", "No se encontraron para la orden de compra y diseño ingresado, revise su información");
                        }else{
                            var today = new Date();
                            var date = today.toISOString().slice(0,10);
                            var time;

                            var horas = today.getHours();
                            horas < 10 ? horas = '0'+horas : 0;
                            var minutos = today.getMinutes();
                            minutos < 10 ? minutos = '0'+minutos : 0;
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
                                success: function(returningInsert){
                                    if(returningInsert == "si"){
                                        alertify.alert("¡Correcto!", "Proceso iniciado correctamente, verifique la información en el seguimiento de procesos");
                                        $("#P_Diseno")[0].value = "";
                                        $("#P_orden")[0].value = "";
                                        $("#P_cantidad")[0].value = "";
                                    }else{
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
// --------------------------------- FIN TURNOS/CORTE TURNO ---------------------------------