<?php
class InsumosClass
{
    private static $instancia;
    private $dbh;

    private function __construct(){
        try {
            $servidor = "localhost";
            $base = "milorabd";
            $usuario = "root";
            $contrasenia = "";
            $this->dbh = new PDO('mysql:host=' . $servidor . ';dbname=' . $base, $usuario, $contrasenia);
            $this->dbh->exec("SET CHARACTER SET utf8");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    public static function singleton(){
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }


    //--------------
}
?>