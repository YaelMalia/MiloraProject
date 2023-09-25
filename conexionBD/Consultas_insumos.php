<?php
class InsumosClass
{
    private static $instancia;
    private $dbh;

    private function __construct(){
        try {
            $servidor = "localhost";
            $base = "bodega";
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


    public function InsertarInsumo(){
        try {
            $query = $this->dbh->prepare("INSERT INTO productos (Nombre_insumo, Descripcion, Especificaciones, Id_categoria) VALUES (?, ?, ?, ?)");
            $query->bindParam(1, $IdCate);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    //-------------- INSUMOS
    public function GetAllInsumos()
    {
        try {
            $query = $this->dbh->prepare("SELECT productos.Nombre_insumo, productos.Descripcion, productos.Cantidad, productos.Especificaciones, categorias.TipoCategoria FROM productos INNER JOIN categorias ON productos.Id_categoria = categorias.Id_categoria;");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function GetCategoria($IdCat){
        try {
            $query = $this->dbh->prepare("SELECT ");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    //--------------
    // public function AgregarEntradaInsumo($){
    //     try {
    //         $query = $this->dbh->prepare("SELECT ");
    //         $query->bindParam(1, $); 
    //         $query->execute();
    //         return $query->fetchAll();
    //         $this->dbh = null;
    //     } catch (PDOException $e) {
    //         $e->getMessage();
    //     }
    // }
    //--------------
    // public function AgregarSalidaInsumo($){
    //     try {
    //         $query = $this->dbh->prepare("SELECT ");
    //         $query->bindParam(1, $);
    //         $query->execute();
    //         return $query->fetchAll();
    //         $this->dbh = null;
    //     } catch (PDOException $e) {
    //         $e->getMessage();
    //     }
    // }
    //--------------
}
?>