<?php
    if(isset($_POST["noDiseno"])){

        $noDisenophp = $_POST["noDiseno"];
        $descripcion_mpphp = $_POST["descripcion_mp"];
        $codigo_mpphp = $_POST["codigo_mp"];
        $cortephp = $_POST["corte"];
        $doblesphp = $_POST["dobles"];
        $roladophp = $_POST["rolado"];
        $biselphp = $_POST["bisel"];
        $taladrophp = $_POST["taladro"];
        $prensaphp = $_POST["prensa"];
        
        require_once("../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->insertPieza($noDisenophp, $descripcion_mpphp, $codigo_mpphp, $cortephp, $doblesphp,
        $roladophp, $biselphp, $taladrophp, $prensaphp);

        echo "si";
    }else{
        echo "no";
        header("Location:../Paginas/Formulario_Diseños.html");
    }
?>