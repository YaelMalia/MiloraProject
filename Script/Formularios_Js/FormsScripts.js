
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

function busqueda_Filtrada(){
    
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
                                
                                $("#No_disenoFD")[0].value = "";
                                document.getElementById("No_disenoFD").disabled = false;
                                document.getElemen2tById("btn_Buscar").disabled = false;

                                $("#Descripcion_MP")[0].value = "";
                                document.getElementById("Descripcion_MP").disabled = true;
                                $("#Codigo_MP")[0].value = "";
                                document.getElementById("Codigo_MP").disabled = true;
                                $("#Dobles")[0].value = "No";
                                document.getElementById("Dobles").disabled = true;
                                $("#Rolado")[0].value = "No";
                                document.getElementById("Rolado").disabled = true;
                                $("#Bisel")[0].value = "No";
                                document.getElementById("Bisel").disabled = true;
                                $("#Taladro")[0].value = "No";
                                document.getElementById("Taladro").disabled = true;
                                $("#Prensa")[0].value = "No";
                                document.getElementById("Prensa").disabled = true;

                                document.getElementById("btn-update").disabled = true;


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