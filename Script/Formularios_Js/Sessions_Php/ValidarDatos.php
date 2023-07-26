<?php
    if(isset($_POST["user"])){
        $usuario = $_POST["user"];
        $pass = $_POST["pass"];

        require_once("../../../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->CheckLogin($usuario, $pass);
        if(count($data)>0){
            session_start();
            foreach($data as $fila){
                $_SESSION["Nombres"] = $fila["nombre"];
                $_SESSION["APaterno"] = $fila["a_paterno"];
                $_SESSION["AMaterno"] = $fila["a_materno"];
                $_SESSION["Usuario"] = $fila["usuario"];
                $_SESSION["TipoUser"] = $fila["tipo_usuario"];
            }
            echo "check";
        }else{
            echo "non-checked";
            header("Location:index.html");
        }
    }
?>