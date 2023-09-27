<?php
class InsumosClass
{
    private static $instancia;
    private $dbh;

    private function __construct(){
        try {
            $servidor = "localhost";
            $base = "almaceninsumos";
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


    public function InsertarInsumo($Identificador, $NombreIns, $DescripcionIns, $EspecificacionesIns, $IdCatIns){
        try {
            $query = $this->dbh->prepare("INSERT INTO productos (IdentificadorInsumo, Nombre_insumo, Descripcion, Especificaciones, Id_categoria) VALUES (?, ?, ?, ?, ?)");
            $query->bindParam(1, $Identificador);
            $query->bindParam(2, $NombreIns);
            $query->bindParam(3, $DescripcionIns);
            $query->bindParam(4, $EspecificacionesIns);
            $query->bindParam(5, $IdCatIns);
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

    public function GetCategoria($TipoCat){
        try {
            $query = $this->dbh->prepare("SELECT Id_categoria FROM categorias WHERE TipoCategoria LIKE ?");
            $query->bindParam(1, $TipoCat);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function GetNoInsumo($Identificador, $Nombre){
        try {
            $query = $this->dbh->prepare("SELECT Id_producto FROM productos WHERE IdentificadorInsumo  LIKE ? AND Nombre_insumo LIKE ?");
            $query->bindParam(1, $Identificador);
            $query->bindParam(2, $Nombre);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    // --------------
    public function InsertEntradaInsumo($Fecha, $IdProd, $Cantidad){
        try {
            $query = $this->dbh->prepare("INSERT INTO entradas (Fecha_entrada, Id_producto, Cantidad) VALUES (?, ?, ?)");
            $query->bindParam(1, $Fecha);
            $query->bindParam(2, $IdProd); 
            $query->bindParam(3, $Cantidad); 

            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function InsertSalidaInsumo($Fecha, $IdProd, $Cantidad){
        try {
            $query = $this->dbh->prepare("INSERT INTO salidas (Fecha_salida, Id_producto, Cantidad) VALUES (?, ?, ?)");
            $query->bindParam(1, $Fecha);
            $query->bindParam(2, $IdProd); 
            $query->bindParam(3, $Cantidad); 

            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
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