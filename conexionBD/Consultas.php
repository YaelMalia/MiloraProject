<?php
//singleton
class MiloraClass
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

    public function insertOrden($FechaI, $FechaF, $OrdenCompra, $Cliente, $NoPieza, $CantidadPieza){
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
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function insertPieza($noDis, $descripcion, $codigomp, $corte, $dobles, $rolado, $bisel, $taladro, $prensa){
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

    public function selectPieza($noDis){
        try {
            $query = $this->dbh->prepare("SELECT piezas.No_diseno, Descripcion_MP, Codigo_MP, ordenes_compras.Orden_compra, ordenes_compras.Cliente, Corte, Dobles, Rolado, Bisel, Taladro, Prensa FROM piezas INNER JOIN ordenes_compras ON piezas.No_diseno = ordenes_compras.No_diseno WHERE piezas.No_diseno LIKE ?");
            $query->bindParam(1, $noDis);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function selectByCode($codeMp){
        try {
            $query = $this->dbh->prepare("SELECT piezas.No_diseno, Descripcion_MP, Codigo_MP, ordenes_compras.Orden_compra, ordenes_compras.Cliente, Corte, Dobles, Rolado, Bisel, Taladro, Prensa FROM piezas INNER JOIN ordenes_compras ON piezas.No_diseno = ordenes_compras.No_diseno WHERE piezas.Codigo_MP LIKE ?");
            $query->bindParam(1, $codeMp);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function updatePieza($noDis, $descripcion, $codigomp, $corte, $dobles, $rolado, $bisel, $taladro, $prensa){
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

    public function GetAllPiezas(){
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
            $query = $this->dbh->prepare("INSERT INTO ordenes_compras (Fecha_realizacion, Fecha_limite, Orden_compra, No_diseno, Piezas_solicitadas, Piezas_restantes, Cliente) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $query->bindParam(1, $fechaInicio);
            $query->bindParam(2, $fechaLimite);
            $query->bindParam(3, $Orden);
            $query->bindParam(4, $No_Dis);
            $query->bindParam(5, $CantidadP);
            $query->bindParam(6, $CantidadP);
            $query->bindParam(7, $Cliente);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function GetAllOrdenes(){
        try {
            $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras ORDER BY DiasRestantes ASC;");
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
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE Fecha_realizacion BETWEEN ? AND ? ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                }
                //Orden con algo
                if(($orden!="") && ($dis == "" && $cliente == "")){
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND Orden_compra LIKE ? ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                    $query->bindParam(3, $orden);
                }
                if(($orden!="") && ($dis!="" && $cliente == "")){
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND (Orden_compra LIKE ?) AND (No_diseno LIKE ?) ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                    $query->bindParam(3, $orden);
                    $query->bindParam(4, $dis);
                }
                if(($orden!="") && ($dis!="" && $cliente!="")){ // TODO ESTÁ LLENO
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND (Orden_compra LIKE ?) AND (No_diseno LIKE ?) AND (Cliente LIKE ?) ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                    $query->bindParam(3, $orden);
                    $query->bindParam(4, $dis);
                    $query->bindParam(5, $cliente);
                }
                //Orden vacía, iniciamos con el diseño
                if(($dis!="") && ($orden == "" && $cliente == "")){
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND No_diseno LIKE ? ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                    $query->bindParam(3, $dis);
                }
                if(($dis!="") && ($orden  == "" && $cliente!="")){
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND (No_diseno LIKE ?) AND (Cliente LIKE ?) ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                    $query->bindParam(3, $dis);
                    $query->bindParam(4, $cliente);
                }
                //Cliente lleno y resto vacío
                if(($cliente!="") && ($dis == "" && $orden == "")){
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND Cliente LIKE ? ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                    $query->bindParam(3, $cliente);
                }
                if(($cliente!="") && ($orden!="" && $dis == "")){
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND (Cliente LIKE ?) AND (Orden_compra LIKE ?) ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS); 
                    $query->bindParam(3, $cliente);
                    $query->bindParam(4, $orden);
                }
                // Cuando las fechas están vacías
            }else{
                //Orden con algo
                if(($orden!="") && ($dis == "" && $cliente == "")){
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE Orden_compra LIKE ? ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $orden);
                }
                if(($orden!="") && ($dis!="" && $cliente == "")){
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Orden_compra LIKE ?) AND (No_diseno LIKE ?) ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $orden);
                    $query->bindParam(2, $dis);
                }
                if(($orden!="") && ($dis!="" && $cliente!="")){ // TODO ESTÁ LLENO
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Orden_compra LIKE ?) AND (No_diseno LIKE ?) AND (Cliente LIKE ?) ORDER BY DiasRestantes ASC;"); 
                    $query->bindParam(1, $orden);
                    $query->bindParam(2, $dis);
                    $query->bindParam(3, $cliente);
                }
                //Orden vacía, iniciamos con el diseño
                if(($dis!="") && ($orden == "" && $cliente == "")){
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE No_diseno LIKE ? ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $dis);
                }
                if(($dis!="") && ($orden  == "" && $cliente!="")){
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (No_diseno LIKE ?) AND (Cliente LIKE ?) ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $dis);
                    $query->bindParam(2, $cliente);
                }
                //Cliente lleno y resto vacío
                if(($cliente!="") && ($dis == "" && $orden == "")){
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE Cliente LIKE ? ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $cliente);
                }
                if(($cliente!="") && ($orden!="" && $dis == "")){
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Cliente LIKE ?) AND (Orden_compra LIKE ?) ORDER BY DiasRestantes ASC;"); 
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

    public function Search_Orden_Editar($orden, $diseno){
        try {
            $query = $this->dbh->prepare("SELECT * FROM ordenes_compras WHERE Orden_compra LIKE ? AND No_diseno LIKE ?");
            $query->bindParam(1, $orden);
            $query->bindParam(2, $diseno);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function Update_Orden($fechaL, $OrdenC, $Nodis, $CantP, $Estatus, $Cliente, $fOrden, $fDiseno){
        try {
            $query = $this->dbh->prepare("UPDATE ordenes_compras SET Fecha_limite=?, Orden_compra=?, No_diseno=?, Piezas_solicitadas=?, Estatus_orden=?, Cliente=? WHERE Orden_compra LIKE ? AND No_diseno LIKE ?");
            $query->bindParam(1, $fechaL);
            $query->bindParam(2, $OrdenC);
            $query->bindParam(3, $Nodis);
            $query->bindParam(4, $CantP);
            $query->bindParam(5, $Estatus);
            $query->bindParam(6, $Cliente);
            $query->bindParam(7, $fOrden);
            $query->bindParam(8, $fDiseno);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }
    // --------------------------------  Entradas  ----------------------------------------//
    public function Get_noOrden_Entradas($disenoR, $ordenR){
        try {
            $query = $this->dbh->prepare("SELECT Numero_orden FROM ordenes_compras WHERE No_diseno LIKE ? AND Orden_compra LIKE ?");
            $query->bindParam(1, $disenoR);
            $query->bindParam(2, $ordenR);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function Insertar_Entrada($disenoI, $NordenI, $ordenCI, $fechaEI, $cantidadEI){
        try {
            $query = $this->dbh->prepare("INSERT INTO entradas_almacen (No_diseno, Numero_orden, Orden_compra, Fecha_entrada, Cantidad_entrada) VALUES (?, ?, ?, ?, ?)");
            $query->bindParam(1, $disenoI);
            $query->bindParam(2, $NordenI);
            $query->bindParam(3, $ordenCI);
            $query->bindParam(4, $fechaEI);
            $query->bindParam(5, $cantidadEI);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function GetAllEntradas(){
        try {
            $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE 1");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function GetEntradaFilter($fechaEn, $ordenEn, $disEn){
        try{
            if(($fechaEn !="")){
                if(($ordenEn == "" && $disEn == "")){
                    $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE Fecha_entrada LIKE ?;");
                    $query->bindParam(1, $fechaEn);
                }
                //Orden llena
                if(($ordenEn!="") && ($disEn == "")){
                    $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE (Fecha_entrada LIKE ?) AND Orden_compra LIKE ?;");
                    $query->bindParam(1, $fechaEn);
                    $query->bindParam(2, $ordenEn); 
                }
                if(($ordenEn!="") && ($disEn!="")){
                    $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE (Fecha_entrada LIKE ?) AND (Orden_compra LIKE ?) AND (No_diseno LIKE ?);");
                    $query->bindParam(1, $fechaEn);
                    $query->bindParam(2, $ordenEn); 
                    $query->bindParam(3, $disEn);
                }
                //Orden vacía
                if(($disEn!="") && ($ordenEn == "")){
                    $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE (Fecha_entrada LIKE ?) AND No_diseno LIKE ?;");
                    $query->bindParam(1, $fechaEn);
                    $query->bindParam(2, $disEn); 
                }
                // Cuando las fechas están vacías
            }else{
                if(($ordenEn!="") && ($disEn == "")){
                    $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE Orden_compra LIKE ?;");
                    $query->bindParam(1, $ordenEn);
                }
                if(($ordenEn!="") && ($disEn!="")){
                    $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE (Orden_compra LIKE ?) AND (No_diseno LIKE ?);");
                    $query->bindParam(1, $ordenEn); 
                    $query->bindParam(2, $disEn);
                }
                //Orden vacía
                if(($disEn!="") && ($ordenEn == "")){
                    $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE No_diseno LIKE ?;");
                    $query->bindParam(1, $disEn); 
                }
            }
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        }catch(PDOException $e){
            $e->getMessage();
        }
    }
// ------------------------- SALIDAS --------------------------------- //
public function Get_noStock_Salidas($disenoR, $ordenR){
    try {
        $query = $this->dbh->prepare("SELECT cve_ai FROM stock_almacen WHERE No_diseno LIKE ? AND Orden_compra LIKE ?");
        $query->bindParam(1, $disenoR);
        $query->bindParam(2, $ordenR);
        $query->execute();
        return $query->fetchAll();
        $this->dbh = null;
    } catch (PDOException $e) {
        $e->getMessage();
        echo $e;
    }
}

public function GetAllSalidas(){
    try {
        $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE 1");
        $query->execute();
        return $query->fetchAll();
        $this->dbh = null;
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

public function GetSalidaFilter($fechaSa, $ordenSa, $disSa){
    try{
        if(($fechaSa !="")){
            if(($ordenSa == "" && $disSa == "")){
                $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE Fecha_salida LIKE ?;");
                $query->bindParam(1, $fechaSa);
            }
            //Orden llena
            if(($ordenSa!="") && ($disSa == "")){
                $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE (Fecha_salida LIKE ?) AND Orden_compra LIKE ?;");
                $query->bindParam(1, $fechaSa);
                $query->bindParam(2, $ordenSa); 
            }
            if(($ordenSa!="") && ($disSa!="")){
                $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE (Fecha_salida LIKE ?) AND (Orden_compra LIKE ?) AND (No_diseno LIKE ?);");
                $query->bindParam(1, $fechaSa);
                $query->bindParam(2, $ordenSa); 
                $query->bindParam(3, $disSa);
            }
            //Orden vacía
            if(($disSa!="") && ($ordenSa == "")){
                $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE (Fecha_salida LIKE ?) AND No_diseno LIKE ?;");
                $query->bindParam(1, $fechaSa);
                $query->bindParam(2, $disSa); 
            }
            // Cuando las fechas están vacías
        }else{
            if(($ordenSa!="") && ($disSa == "")){
                $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE Orden_compra LIKE ?;");
                $query->bindParam(1, $ordenSa);
            }
            if(($ordenSa!="") && ($disSa!="")){
                $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE (Orden_compra LIKE ?) AND (No_diseno LIKE ?);");
                $query->bindParam(1, $ordenSa); 
                $query->bindParam(2, $disSa);
            }
            //Orden vacía
            if(($disSa!="") && ($ordenSa == "")){
                $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE No_diseno LIKE ?;");
                $query->bindParam(1, $disSa); 
            }
        }
        $query->execute();
        return $query->fetchAll();
        $this->dbh = null;
    }catch(PDOException $e){
        $e->getMessage();
    }
}

public function Insertar_Salida($disenoI, $NoStock, $ordenCI, $fechaSI, $cantidadSI){
    try {
        $query = $this->dbh->prepare("INSERT INTO salidas_almacen (cve_stock, No_diseno, Orden_compra, Fecha_Salida, Cantidad_salida) VALUES (?, ?, ?, ?, ?)");
        $query->bindParam(1, $NoStock);
        $query->bindParam(2, $disenoI);
        $query->bindParam(3, $ordenCI);
        $query->bindParam(4, $fechaSI);
        $query->bindParam(5, $cantidadSI);
        $query->execute();
        return $query->fetchAll();
        $this->dbh = null;
    } catch (PDOException $e) {
        $e->getMessage();
        echo $e;
    }
}



// --------------------------- CONSULTAS DE ALMACEN ------------------------ //

public function GetAllStock(){
    try {
        $query = $this->dbh->prepare("SELECT * FROM stock_almacen WHERE 1");
        $query->execute();
        return $query->fetchAll();
        $this->dbh = null;
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

public function Stock_Filter($stockDiseno, $stockEstatus){
    try {
        if($stockDiseno != "" && $stockEstatus != ""){
        $query = $this->dbh->prepare("SELECT * FROM stock_almacen WHERE No_diseno LIKE ? AND Estatus LIKE ?");
        $query->bindParam(1, $stockDiseno);
        $query->bindParam(2, $stockEstatus);
        }else{
            if($stockDiseno!="" && $stockEstatus == ""){
                $query = $this->dbh->prepare("SELECT * FROM stock_almacen WHERE No_diseno LIKE ?");
                $query->bindParam(1, $stockDiseno);
            }
            if($stockDiseno == "" && $stockEstatus !=""){
                $query = $this->dbh->prepare("SELECT * FROM stock_almacen WHERE Estatus LIKE ?");
                $query->bindParam(1, $stockEstatus);
            }
        }
        $query->execute();
        return $query->fetchAll();
        $this->dbh = null;
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

public function Ordenar_Stock(){
    try {
        $query = $this->dbh->prepare("SELECT No_diseno, (SELECT SUM(Cantidad_actual)) AS totalAlmacen, Estatus FROM stock_almacen GROUP BY No_diseno;");
        $query->execute();
        return $query->fetchAll();
        $this->dbh = null;
    } catch (PDOException $e) {
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
