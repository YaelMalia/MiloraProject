<?php
    session_start();
    $_SESSION["Nombres"] = null;
    $_SESSION["APaterno"] = null;
    $_SESSION["AMaterno"] = null;
    $_SESSION["Usuario"] = null;
    $_SESSION["TipoUser"] = null;
    session_destroy();

?>