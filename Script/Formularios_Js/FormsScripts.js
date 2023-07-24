

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