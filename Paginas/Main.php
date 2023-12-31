<?php require_once("../Script/Formularios_Js/Sessions_Php/CheckSession.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Estilos/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="../alertify/alertify.js"></script>
    <link rel="stylesheet" href="../alertify/alertify.css">

    <!--  JS -->
    <script src="../Script/jquery.js"></script>
    <script src="../Script/jquery-3.5.1.min.js"></script>
    <script src="../Script/Formularios_Js/FormsScripts.js"></script>
    <title>Panel de control</title>

    
</head>
<body>
  
      <header class="headerSuperior">
        <div id="main">
          <button class="openbtn" onclick="openNav()">☰ Áreas</button>  
        </div>
        <div id="right-side" class="right-side">Panel de control</div>
      </header>

     <!--Main Navigation-->
     <div id="mySidebar" class="sidebar">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
      <!--  -->
      <button class="dropdown-btn Prod-Nav">Cargas de trabajo
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a id="Nuevo-Carga-Corte" class="enlace">Carga para corte</a>
        <a id="Consulta-Carga-Corte" class="enlace OnlyRead">Consulta carga corte</a>
        <a id="Detallado" class="enlace">Otras cargas</a>
        <a id="Consulta-Carga-Detallado" class="enlace OnlyRead">Consulta carga detallado</a>
      </div>
      <!--  -->
      <!-- <button class="dropdown-btn Prod-Nav">Procesos
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a id="Nuevo-proceso" class="enlace">Inicio de procesos</a>
        <a id="Seguimiento-Procesos" class="enlace">Procesos activos</a>
        <a id="Consulta-procesos" class="enlace">Historial de procesos</a>
      </div> -->
      <!--  -->
      <button class="dropdown-btn Prod-Nav">Diseños/piezas
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a id="Nuevo-diseno" class="enlace">Nuevo diseño de pieza</a>
        <a id="Editar-diseno" class="enlace">Editar diseño de pieza</a>
        <!-- <a href="#">Eliminar diseño de pieza</a> -->
        <a id="Consultar-diseno" class="enlace OnlyRead">Consultar diseños</a>
      </div>
      <!--  -->
      <button class="dropdown-btn Prod-Nav">Ordenes de compra
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a id="Nueva-orden" class="enlace">Nueva orden</a>
        <a id="Editar-orden" class="enlace">Editar orden</a>
        <a id="Consultar-orden" class="enlace OnlyRead">Consultar ordenes</a>
        <!-- <a href="#">Archivar orden</a> -->
      </div>
      <!--  -->
      <button class="dropdown-btn" id="almacen">Almacén existencias
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a id="Nueva-entrada" class="enlace">Registrar entrada</a>
        <a id="Consulta-entrada" class="enlace OnlyRead">Consultar entradas</a>
        <a id="Nueva-salida" class="enlace">Registrar salida</a>
        <a id="Consulta-salida" class="enlace OnlyRead" OnlyRead>Consultar salidas</a>
        <a id="Consulta-existencias" class="enlace OnlyRead">Consultar existencias</a>
      </div>
      <button class="dropdown-btn" id="AlmacenHerramientas">Almacen herramientas
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a id="Inventario-Insumo" class="enlace BodYComp">Inventario</a>
        <a id="Consulta-Insumo" class="enlace BodYComp">Consultar inventario</a>

        <a id="Entrada-Insumo" class="enlace BodYComp">Entradas de insumo</a>
        <a id="Salida-Insumo" class="enlace BodYComp">Salidas de insumo</a>
      </div>
      <!--  -->
     
      <!--  -->
      <!-- <button class="dropdown-btn" id="cInterna">Calidad interna
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a href="#">Cosas de calidad interna</a>
      </div> -->
      <!--  -->
      <!-- <button class="dropdown-btn" id="cExterna">Calidad externa
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a href="#">Cosas de calidad externa</a>
      </div> -->
      <!--  -->
      <!-- <button class="dropdown-btn" id="facturacion">Facturación
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a href="#">Cosas de facturación</a>
      </div> -->
      <a class="EndSession" id="EndSession" style="margin-top:95%;">Cerrar Sesión</a>
    </div>
    
    <!-- Bienvenida -->
    <div class="bienvenido" id="bienvenido" style="widt:100%; text-align:center; margin-top:15px;">
    <img src="../Images/user.png" alt="Usuario Gota de Angel" width = "40" height = "40" style=" margin-left:-100px;">
    <span style="position:absolute; margin-left:8px; margin-top:15px;"><?php echo $_SESSION["Nombres"].' '.$_SESSION["APaterno"] ?></span>
    </div>
    <!-- Fin bienvenida -->

    <main class="ControlCentral" id="ControlCentral">
      
      <div class="Principal" id="Principal">
        <!--  -->
        <div class="left-img" id="left-img">
          <img style="margin: 0 auto; max-width: max-content;" width="200px;" height="200px" src="../Images/LogoMilora.png" alt="" id="milLogo">
        </div>
        
        <div class="right-img" id="right-img">
          <img style="margin: 0 auto; margin-top:15%; max-width: max-content;" width="260px" height="130px" src="../Images/logo-tec_original.png" alt="" id="itesaLogo">
        </div>
        <!--  -->
        <div class="bottom-info" id="bottom-info">
          <h3 style="color: rgb(77, 75, 75);">Control de gestión general | 2023 ©</h3>
          <br>
          <h4 style="color: rgb(76, 78, 236);"> ISC <font style="color: rgb(77, 75, 75); margin-left: 8px; margin-right: 8px;">l</font> ITESA</h4>
        </div>
        <br>
      </div>
    </main>
    
    <script>
      
      window.onload = function(){
        
        <?php
          if($_SESSION["TipoUser"]!="Admin"){
            ?>
            var ArrP = document.getElementsByClassName("enlace");
            Array.from(ArrP).forEach((elmnt) =>{
                elmnt.style.display = "None";
            });

            var ArrProd2 = document.getElementsByClassName("OnlyRead");
            Array.from(ArrProd2).forEach((elmnt) =>{
                elmnt.style.display = "block";
            });
            
            <?php
            // Limitar accesos
            if($_SESSION["TipoUser"] == "Producción2"){
              ?>
              document.getElementById("Nuevo-Carga-Corte").style.display = "block";
              document.getElementById("Detallado").style.display = "block";
              <?php
            }else if($_SESSION["TipoUser"] == "Almacén"){
              ?>
              document.getElementById("Nueva-entrada").style.display = "block";
              document.getElementById("Nueva-salida").style.display = "block";
              <?php
            }else if($_SESSION["TipoUser"] == "Facturación"){
              ?>
              document.getElementById("Nueva-orden").style.display = "block";
              document.getElementById("Editar-orden").style.display = "block";
              <?php
            }else if($_SESSION["TipoUser"] == "Ingeniería"){
              ?>
              document.getElementById("Nuevo-diseno").style.display = "block";
              document.getElementById("Editar-diseno").style.display = "block";
              <?php
            }else if($_SESSION["TipoUser"] == "Compras" || $_SESSION["TipoUser"] == "Bodega"){
              ?>
              var BodYComp = document.getElementsByClassName("BodYComp");
                Array.from(BodYComp).forEach((elmnt) =>{
                elmnt.style.display = "block";
            });
              <?php
            }
          }
        ?>
      }
    function openNav() {
      var Window_with;
      document.getElementById("mySidebar").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
      Window_with = window.innerWidth;
        if(Window_with<=768){
            document.getElementById("right-side").style.display="none";
        }
     }
    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft= "0";
      Window_with = window.innerWidth;
        if(Window_with<=768){
            document.getElementById("right-side").style.display="block";
        }
    }

    //* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
// -------------------------------- DROPDOWN CONTAINTERS--------------------------------

// -------------------------------- NUEVOS
$("#Nueva-orden").click(function(){
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Formulario_Orden.html");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Nuevo-diseno").click(function(){
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Formulario_Diseños.html");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Nueva-entrada").click(function(){
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Formulario_Entrada_Almacen.html");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Nueva-salida").click(function(){
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Formulario_Salidas_Almacen.html");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Nuevo-Carga-Corte").click(function(){
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Formulario_Corte.php");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Nuevo-proceso").click(function(){  
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Inicio_corte.html");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Detallado").click(function(){  
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Formulario_Detallado.html");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Inventario-Insumo").click(function(){  
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("../Paginas_insumos/Formulario_Inventario_insumos.php");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Entrada-Insumo").click(function(){  
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("../Paginas_insumos/Formulario_Entrada_insumo.php");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Salida-Insumo").click(function(){  
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("../Paginas_insumos/Formulario_Salida_insumo.php");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

// -------------------------------- EDITAR
$("#Editar-diseno").click(function(){
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Formulario_Diseños_Editar.html");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Editar-orden").click(function(){
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Formulario_Orden_Editar.html");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

// ------------------- CONSULTAS
$("#Consultar-diseno").click(function(){  
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Formulario_Diseños_Consulta.php");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Consultar-orden").click(function(){
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Formulario_Orden_Consulta.php");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});


$("#Consulta-entrada").click(function(){
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Formulario_Entradas_Consulta.php");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});


$("#Consulta-salida").click(function(){
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Formulario_Salidas_Consulta.php");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});


$("#Consulta-existencias").click(function(){
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Formulario_Stock_Consulta.php");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});


$("#Seguimiento-Procesos").click(function(){  
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Seguimiento_Procesos.php");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Consulta-Carga-Corte").click(function(){  
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Consulta_Cargas_Corte.php");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Consulta-Carga-Detallado").click(function(){  
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Consulta_Cargas_Detallado.php");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Consulta-procesos").click(function(){  
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("Historial_Procesos.php");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

$("#Consulta-Insumo").click(function(){  
  document.getElementById("ControlCentral").innerHTML="";
  $("#ControlCentral").load("../Paginas_insumos/Consulta_Inventario.php");
  closeNav();
  const enlaces = document.getElementsByClassName("enlace");
  enlaces.setAttribute('color', 'rgb(129, 129, 129)');
});

// ------------------------------------------------------------- END DROPDOWN CONTAINTERS---------------

$("#EndSession").click(function(){
    $.post("../Script/Formularios_Js/Sessions_Php/EndSession.php");
    window.location.href = "../index.html";
});

    </script>
  </body>
</html>