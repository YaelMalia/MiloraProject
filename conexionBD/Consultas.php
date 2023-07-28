<?php
//singleton
class MiloraClass
{
    private static $instancia;
    private $dbh;

    private function __construct()
    {
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

    public static function singleton()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

/*Consultas*/
public function CheckLogin($usuario, $pass){
    try {
        $query = $this->dbh->prepare("SELECT * FROM usuarios WHERE usuario LIKE ? AND pass LIKE ?");
        $query->bindParam(1, $usuario);
        $query->bindParam(2, $pass);
        $query->execute();
        return $query->fetchAll();
        $this->dbh = null;
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

public function insertOrden($FechaI, $FechaF, $OrdenCompra, $Cliente, $NoPieza, $CantidadPieza)
    {
        try {
            $query = $this->dbh->prepare("INSERT INTO  (Fecha_realizacion, Fecha_finalizacion, Orden_compra, No_diseno, Piezas_solicitadas, Cliente, ) VALUES (?, ?, ?, ?, ?, ?)");
            $query->bindParam(1, $FechaI);
            $query->bindParam(2, $FechaF);
            $query->bindParam(3, $OrdenCompra);
            $query->bindParam(4, $NoPieza);
            $query->bindParam(5, $CantidadPieza);
            $query->bindParam(6, $Cliente);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }



    public function insertPieza($noDis, $descripcion, $codigomp, $corte, $dobles, $rolado, $bisel, $taladro, $prensa)
    {
        try {
            $query = $this->dbh->prepare("INSERT INTO piezas (No_diseno, Descripcion_MP, Codigo_MP, Corte, Dobles, Rolado, Bisel, Taladro, Prensa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $query->bindParam(1, $noDis);
            $query->bindParam(2, $descripcion);
            $query->bindParam(3, $codigomp);
            $query->bindParam(4, $corte);
            $query->bindParam(5, $dobles);
            $query->bindParam(6, $rolado);
            $query->bindParam(7, $bisel);
            $query->bindParam(8, $taladro);
            $query->bindParam(9, $prensa);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function selectPieza($noDis)
    {
        try {
            $query = $this->dbh->prepare("SELECT * FROM piezas WHERE No_diseno LIKE ?");
            $query->bindParam(1, $noDis);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function selectByCode($codeMp)
    {
        try {
            $query = $this->dbh->prepare("SELECT * FROM piezas WHERE Codigo_MP LIKE ?");
            $query->bindParam(1, $codeMp);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function updatePieza($noDis, $descripcion, $codigomp, $corte, $dobles, $rolado, $bisel, $taladro, $prensa)
    {
        try {
            $query = $this->dbh->prepare("UPDATE piezas SET Descripcion_MP=?, Codigo_MP=?, Corte=?, Dobles=?, Rolado=?, Bisel=?, Taladro=?, Prensa=? WHERE No_diseno LIKE ?");
            $query->bindParam(1, $descripcion);
            $query->bindParam(2, $codigomp);
            $query->bindParam(3, $corte);
            $query->bindParam(4, $dobles);
            $query->bindParam(5, $rolado);
            $query->bindParam(6, $bisel);
            $query->bindParam(7, $taladro);
            $query->bindParam(8, $prensa);
            $query->bindParam(9, $noDis);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function GetAllPiezas()
    {
        try {
            $query = $this->dbh->prepare("SELECT piezas.No_diseno, Descripcion_MP, Codigo_MP, ordenes_compras.Orden_compra, ordenes_compras.Cliente, Corte, Dobles, Rolado, Bisel, Taladro, Prensa FROM piezas INNER JOIN ordenes_compras ON piezas.No_diseno = ordenes_compras.No_diseno;");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }




    // ------------------- ORDENES DE COMPRA --------------------------------------------------------
    public function insert_orden($fechaInicio, $fechaLimite, $Orden, $Cliente, $No_Dis, $CantidadP){
        try {
            $query = $this->dbh->prepare("INSERT INTO ordenes_compras (Fecha_realizacion, Fecha_limite, Orden_compra, No_diseno, Piezas_solicitadas, Cliente) VALUES (?, ?, ?, ?, ?, ?)");
            $query->bindParam(1, $fechaInicio);
            $query->bindParam(2, $fechaLimite);
            $query->bindParam(3, $Orden);
            $query->bindParam(4, $No_Dis);
            $query->bindParam(5, $CantidadP);
            $query->bindParam(6, $Cliente);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function GetAllOrdenes()
    {
        try {
            $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE 1");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function GetOrdenesFilter($fI, $fS, $orden, $dis, $cliente){
        try{
            if(($fI !="" && $fS !="")){
                if(($orden == "" && $dis == "" && $cliente == "")){
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE Fecha_realizacion BETWEEN ? AND ?;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                }
                //Orden con algo
                if(($orden!="") && ($dis == "" && $cliente == "")){
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND Orden_compra LIKE ?;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                    $query->bindParam(3, $orden);
                }
                if(($orden!="") && ($dis!="" && $cliente == "")){
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND (Orden_compra LIKE ?) AND (No_diseno LIKE ?);");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                    $query->bindParam(3, $orden);
                    $query->bindParam(4, $dis);
                }
                if(($orden!="") && ($dis!="" && $cliente!="")){ // TODO ESTÁ LLENO
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND (Orden_compra LIKE ?) AND (No_diseno LIKE ?) AND (Cliente LIKE ?);");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                    $query->bindParam(3, $orden);
                    $query->bindParam(4, $dis);
                    $query->bindParam(5, $cliente);
                }
                //Orden vacía, iniciamos con el diseño
                if(($dis!="") && ($orden == "" && $cliente == "")){
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND No_diseno LIKE ?;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                    $query->bindParam(3, $dis);
                }
                if(($dis!="") && ($orden  == "" && $cliente!="")){
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND (No_diseno LIKE ?) AND (Cliente LIKE ?);");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                    $query->bindParam(3, $dis);
                    $query->bindParam(4, $cliente);
                }
                //Cliente lleno y resto vacío
                if(($cliente!="") && ($dis == "" && $orden == "")){
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND Cliente LIKE ?;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                    $query->bindParam(3, $cliente);
                }
                if(($cliente!="") && ($orden!="" && $dis == "")){
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND (Cliente LIKE ?) AND (Orden_compra LIKE ?);");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                    $query->bindParam(3, $cliente);
                    $query->bindParam(4, $orden);
                }
                // Cuando las fechas están vacías
            }else{
                //Orden con algo
                if(($orden!="") && ($dis == "" && $cliente == "")){
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE Orden_compra LIKE ?;");
                    $query->bindParam(1, $orden);
                }
                if(($orden!="") && ($dis!="" && $cliente == "")){
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE (Orden_compra LIKE ?) AND (No_diseno LIKE ?);");
                    $query->bindParam(1, $orden);
                    $query->bindParam(2, $dis);
                }
                if(($orden!="") && ($dis!="" && $cliente!="")){ // TODO ESTÁ LLENO
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE (Orden_compra LIKE ?) AND (No_diseno LIKE ?) AND (Cliente LIKE ?);"); 
                    $query->bindParam(1, $orden);
                    $query->bindParam(2, $dis);
                    $query->bindParam(3, $cliente);
                }
                //Orden vacía, iniciamos con el diseño
                if(($dis!="") && ($orden == "" && $cliente == "")){
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE No_diseno LIKE ?;");
                    $query->bindParam(1, $dis);
                }
                if(($dis!="") && ($orden  == "" && $cliente!="")){
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE (No_diseno LIKE ?) AND (Cliente LIKE ?);");
                    $query->bindParam(1, $dis);
                    $query->bindParam(2, $cliente);
                }
                //Cliente lleno y resto vacío
                if(($cliente!="") && ($dis == "" && $orden == "")){
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE Cliente LIKE ?;");
                    $query->bindParam(1, $cliente);
                }
                if(($cliente!="") && ($orden!="" && $dis == "")){
                    $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE (Cliente LIKE ?) AND (Orden_compra LIKE ?);"); 
                    $query->bindParam(1, $cliente);
                    $query->bindParam(2, $orden);
                }
            }
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        }catch(PDOException $e){
            $e->getMessage();
        }

    }

/*-----------------------------------------------------------------------------------------------------*/


/*    public function get_user($correo, $pass)
    {
        try {
            $query = $this->dbh->prepare("SELECT * FROM usuarios WHERE correo LIKE ? AND pass LIKE ?");
            $query->bindParam(1, $correo);
            $query->bindParam(2, $pass);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
*/



/*    public function get_ventas()
    {
        try {
            $query = $this->dbh->prepare("SELECT * FROM ventas WHERE 1");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
*/

/*    public function insertar($name, $correo, $pass)
    {
        try {
            $query = $this->dbh->prepare("INSERT INTO usuarios (nombreCompleto, correo, contra) VALUES (?, ?, ?)");
            $query->bindParam(1, $name);
            $query->bindParam(2, $correo);
            $query->bindParam(3, $pass);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
*/

/*    public function insertarVenta($name, $domicilio, $garrafon)
    {
        try {
            $query = $this->dbh->prepare("INSERT INTO ventas (nameCliente, domicilio, totGarrafones) VALUES (?, ?, ?)");
            $query->bindParam(1, $name);
            $query->bindParam(2, $domicilio);
            $query->bindParam(3, $garrafon);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
*/

/*    public function BorrarVenta($p1)
    {
        try {
            $query = $this->dbh->prepare("DELETE FROM ventas WHERE id_venta LIKE ?");
            $query->bindParam(1, $p1);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
*/

/*    public function Actualizar($p1, $p2)
    {
        try {
            $query = $this->dbh->prepare("UPDATE tabla SET campo1=? WHERE campo2 LIKE ?");
            $query->bindParam(1, $p1);
            $query->bindParam(2, $p2);
            $query->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
*/

/*    public function Actualizarv($p1, $p2, $p3, $p4)
    {
        try {
            $query = $this->dbh->prepare("UPDATE ventas SET nameCliente=?, domicilio=?, totGarrafones=? WHERE id_venta LIKE ?");
            $query->bindParam(1, $p1);
            $query->bindParam(2, $p2);
            $query->bindParam(3, $p3);
            $query->bindParam(4, $p4);
            $query->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
*/

/*    public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }
*/

    // Reseñas
/*    public function insertarResena($name, $resena)
    {
        try {
            $query = $this->dbh->prepare("INSERT INTO resenas (remitente, comentario) VALUES (?, ?)");
            $query->bindParam(1, $name);
            $query->bindParam(2, $resena);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
*/

/*    public function getResenas()
    {
        try {
            $query = $this->dbh->prepare("SELECT * FROM resenas WHERE 1");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
*/
}
