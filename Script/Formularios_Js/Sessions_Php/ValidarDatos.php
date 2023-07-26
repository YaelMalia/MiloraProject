<?php
    if(isset($_POST["user"])){
        $usuario = $_POST["user"];
        $pass = $_POST["pass"];

        require_once("../../../conexionBD/Consultas.php");
        $miloraObj = MiloraClass::singleton();
        $data = $miloraObj->CheckLogin($usuario, $pass);
        if(count($data)>0){
            
            echo "check";
        }else{
            echo "non-checked";
            header("Location:index.html");
        }
    }
?>