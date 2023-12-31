﻿<?php
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
    public function CheckLogin($usuario, $pass)
    {
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
            $query = $this->dbh->prepare("INSERT INTO ordenes_compras (Fecha_realizacion, Fecha_finalizacion, Orden_compra, No_diseno, Piezas_solicitadas, Cliente, ) VALUES (?, ?, ?, ?, ?, ?)");
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
            $query = $this->dbh->prepare("SELECT * FROM piezas WHERE piezas.No_diseno LIKE ?");
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
            $query = $this->dbh->prepare("SELECT * FROM piezas WHERE piezas.Codigo_MP LIKE ?");
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
            $query = $this->dbh->prepare("SELECT * FROM piezas;");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    // -------------------------------- ORDENES DE COMPRA --------------------------------
    public function insert_orden($fechaInicio, $fechaLimite, $Orden, $Cliente, $No_Dis, $CantidadP)
    {
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

    public function GetAllOrdenes()
    {
        try {
            $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras ORDER BY Estatus_orden ASC, DiasRestantes ASC;");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function GetOrdenesFilter($fI, $fS, $orden, $dis, $cliente)
    {
        try {
            if (($fI != "" && $fS != "")) {
                if (($orden == "" && $dis == "" && $cliente == "")) {
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE Fecha_realizacion BETWEEN ? AND ? ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS);
                }
                //Orden con algo
                if (($orden != "") && ($dis == "" && $cliente == "")) {
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND Orden_compra LIKE ? ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS);
                    $query->bindParam(3, $orden);
                }
                if (($orden != "") && ($dis != "" && $cliente == "")) {
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND (Orden_compra LIKE ?) AND (No_diseno LIKE ?) ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS);
                    $query->bindParam(3, $orden);
                    $query->bindParam(4, $dis);
                }
                if (($orden != "") && ($dis != "" && $cliente != "")) { // TODO ESTÁ LLENO
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND (Orden_compra LIKE ?) AND (No_diseno LIKE ?) AND (Cliente LIKE ?) ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS);
                    $query->bindParam(3, $orden);
                    $query->bindParam(4, $dis);
                    $query->bindParam(5, $cliente);
                }
                //Orden vacía, iniciamos con el diseño
                if (($dis != "") && ($orden == "" && $cliente == "")) {
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND No_diseno LIKE ? ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS);
                    $query->bindParam(3, $dis);
                }
                if (($dis != "") && ($orden == "" && $cliente != "")) {
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND (No_diseno LIKE ?) AND (Cliente LIKE ?) ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS);
                    $query->bindParam(3, $dis);
                    $query->bindParam(4, $cliente);
                }
                //Cliente lleno y resto vacío
                if (($cliente != "") && ($dis == "" && $orden == "")) {
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND Cliente LIKE ? ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS);
                    $query->bindParam(3, $cliente);
                }
                if (($cliente != "") && ($orden != "" && $dis == "")) {
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Fecha_realizacion BETWEEN ? AND ?) AND (Cliente LIKE ?) AND (Orden_compra LIKE ?) ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $fI);
                    $query->bindParam(2, $fS);
                    $query->bindParam(3, $cliente);
                    $query->bindParam(4, $orden);
                }
                // Cuando las fechas están vacías
            } else {
                //Orden con algo
                if (($orden != "") && ($dis == "" && $cliente == "")) {
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE Orden_compra LIKE ? ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $orden);
                }
                if (($orden != "") && ($dis != "" && $cliente == "")) {
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Orden_compra LIKE ?) AND (No_diseno LIKE ?) ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $orden);
                    $query->bindParam(2, $dis);
                }
                if (($orden != "") && ($dis != "" && $cliente != "")) { // TODO ESTÁ LLENO
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Orden_compra LIKE ?) AND (No_diseno LIKE ?) AND (Cliente LIKE ?) ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $orden);
                    $query->bindParam(2, $dis);
                    $query->bindParam(3, $cliente);
                }
                //Orden vacía, iniciamos con el diseño
                if (($dis != "") && ($orden == "" && $cliente == "")) {
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE No_diseno LIKE ? ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $dis);
                }
                if (($dis != "") && ($orden == "" && $cliente != "")) {
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (No_diseno LIKE ?) AND (Cliente LIKE ?) ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $dis);
                    $query->bindParam(2, $cliente);
                }
                //Cliente lleno y resto vacío
                if (($cliente != "") && ($dis == "" && $orden == "")) {
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE Cliente LIKE ? ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $cliente);
                }
                if (($cliente != "") && ($orden != "" && $dis == "")) {
                    $query = $this->dbh->prepare("SELECT *, DATEDIFF(Fecha_limite, CURRENT_DATE()) as DiasRestantes FROM ordenes_compras WHERE (Cliente LIKE ?) AND (Orden_compra LIKE ?) ORDER BY DiasRestantes ASC;");
                    $query->bindParam(1, $cliente);
                    $query->bindParam(2, $orden);
                }
            }
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }

    }

    public function Search_Orden_Editar($orden, $diseno)
    {
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

    public function Update_Orden($fechaL, $OrdenC, $Nodis, $CantP, $Estatus, $Cliente, $fOrden, $fDiseno)
    {
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

    public function Actualiza_Restantes($Norden, $restantes)
    {
        try {
            $query = $this->dbh->prepare("UPDATE ordenes_compras SET Piezas_restantes=? WHERE Numero_orden LIKE ?");
            $query->bindParam(1, $restantes);
            $query->bindParam(2, $Norden);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    // --------------------------------  Entradas  ----------------------------------------//
    public function Get_noOrden_Entradas($disenoR, $ordenR)
    {
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

    public function CountOrden($disenoR, $ordenR)
    {
        try {
            $query = $this->dbh->prepare("SELECT COUNT(Numero_orden) AS Cantidad FROM ordenes_compras WHERE No_diseno LIKE ? AND Orden_compra LIKE ?");
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

    public function Insertar_Entrada($disenoI, $NordenI, $ordenCI, $fechaEI, $cantidadEI)
    {
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

    public function GetAllEntradas()
    {
        try {
            $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE 1");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function GetEntradaFilter($fechaEn, $ordenEn, $disEn)
    {
        try {
            if (($fechaEn != "")) {
                if (($ordenEn == "" && $disEn == "")) {
                    $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE Fecha_entrada LIKE ?;");
                    $query->bindParam(1, $fechaEn);
                }
                //Orden llena
                if (($ordenEn != "") && ($disEn == "")) {
                    $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE (Fecha_entrada LIKE ?) AND Orden_compra LIKE ?;");
                    $query->bindParam(1, $fechaEn);
                    $query->bindParam(2, $ordenEn);
                }
                if (($ordenEn != "") && ($disEn != "")) {
                    $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE (Fecha_entrada LIKE ?) AND (Orden_compra LIKE ?) AND (No_diseno LIKE ?);");
                    $query->bindParam(1, $fechaEn);
                    $query->bindParam(2, $ordenEn);
                    $query->bindParam(3, $disEn);
                }
                //Orden vacía
                if (($disEn != "") && ($ordenEn == "")) {
                    $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE (Fecha_entrada LIKE ?) AND No_diseno LIKE ?;");
                    $query->bindParam(1, $fechaEn);
                    $query->bindParam(2, $disEn);
                }
                // Cuando las fechas están vacías
            } else {
                if (($ordenEn != "") && ($disEn == "")) {
                    $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE Orden_compra LIKE ?;");
                    $query->bindParam(1, $ordenEn);
                }
                if (($ordenEn != "") && ($disEn != "")) {
                    $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE (Orden_compra LIKE ?) AND (No_diseno LIKE ?);");
                    $query->bindParam(1, $ordenEn);
                    $query->bindParam(2, $disEn);
                }
                //Orden vacía
                if (($disEn != "") && ($ordenEn == "")) {
                    $query = $this->dbh->prepare("SELECT * FROM entradas_almacen WHERE No_diseno LIKE ?;");
                    $query->bindParam(1, $disEn);
                }
            }
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    // ------------------------- SALIDAS --------------------------------- //
    public function Get_noStock_Salidas($disenoR, $ordenR)
    {
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

    public function GetAllSalidas()
    {
        try {
            $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE 1");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function GetSalidaFilter($fechaSa, $ordenSa, $disSa)
    {
        try {
            if (($fechaSa != "")) {
                if (($ordenSa == "" && $disSa == "")) {
                    $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE Fecha_salida LIKE ?;");
                    $query->bindParam(1, $fechaSa);
                }
                //Orden llena
                if (($ordenSa != "") && ($disSa == "")) {
                    $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE (Fecha_salida LIKE ?) AND Orden_compra LIKE ?;");
                    $query->bindParam(1, $fechaSa);
                    $query->bindParam(2, $ordenSa);
                }
                if (($ordenSa != "") && ($disSa != "")) {
                    $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE (Fecha_salida LIKE ?) AND (Orden_compra LIKE ?) AND (No_diseno LIKE ?);");
                    $query->bindParam(1, $fechaSa);
                    $query->bindParam(2, $ordenSa);
                    $query->bindParam(3, $disSa);
                }
                //Orden vacía
                if (($disSa != "") && ($ordenSa == "")) {
                    $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE (Fecha_salida LIKE ?) AND No_diseno LIKE ?;");
                    $query->bindParam(1, $fechaSa);
                    $query->bindParam(2, $disSa);
                }
                // Cuando las fechas están vacías
            } else {
                if (($ordenSa != "") && ($disSa == "")) {
                    $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE Orden_compra LIKE ?;");
                    $query->bindParam(1, $ordenSa);
                }
                if (($ordenSa != "") && ($disSa != "")) {
                    $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE (Orden_compra LIKE ?) AND (No_diseno LIKE ?);");
                    $query->bindParam(1, $ordenSa);
                    $query->bindParam(2, $disSa);
                }
                //Orden vacía
                if (($disSa != "") && ($ordenSa == "")) {
                    $query = $this->dbh->prepare("SELECT * FROM salidas_almacen WHERE No_diseno LIKE ?;");
                    $query->bindParam(1, $disSa);
                }
            }
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function Insertar_Salida($disenoI, $NoStock, $ordenCI, $fechaSI, $cantidadSI)
    {
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

    public function Cantidad_stock($disenoStock, $ordenStock)
    {
        try {
            $query = $this->dbh->prepare("SELECT Cantidad_actual FROM stock_almacen WHERE No_diseno LIKE ? AND Orden_compra LIKE ?");
            $query->bindParam(1, $disenoStock);
            $query->bindParam(2, $ordenStock);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function Cerrar_Orden_Auto($disenoCerrar, $ordenCerrar)
    {
        try {
            $inactiva = "Inactiva";
            $query = $this->dbh->prepare("UPDATE stock_almacen SET Estatus=? WHERE Orden_compra LIKE ? AND No_diseno LIKE ?;");
            $query->bindParam(1, $inactiva);
            $query->bindParam(2, $ordenCerrar);
            $query->bindParam(3, $disenoCerrar);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;

        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function Cerrar_Stock($disenoCerrar, $ordenCerrar)
    {
        try {
            $cerrado = "Cerrada";
            $query = $this->dbh->prepare("UPDATE ordenes_compras SET Estatus_orden=? WHERE Orden_compra LIKE ? AND No_diseno LIKE ?;");
            $query->bindParam(1, $cerrado);
            $query->bindParam(2, $ordenCerrar);
            $query->bindParam(3, $disenoCerrar);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;

        } catch (\Throwable $e) {
            $e->getMessage();
            echo $e;
        }
    }

    // --------------------------- CONSULTAS DE ALMACEN ------------------------ //

    public function GetAllStock()
    {
        try {
            $query = $this->dbh->prepare("SELECT * FROM stock_almacen WHERE 1");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function Stock_Filter($stockDiseno, $stockEstatus)
    {
        try {
            if ($stockDiseno != "" && $stockEstatus != "") {
                $query = $this->dbh->prepare("SELECT * FROM stock_almacen WHERE No_diseno LIKE ? AND Estatus LIKE ?");
                $query->bindParam(1, $stockDiseno);
                $query->bindParam(2, $stockEstatus);
            } else {
                if ($stockDiseno != "" && $stockEstatus == "") {
                    $query = $this->dbh->prepare("SELECT * FROM stock_almacen WHERE No_diseno LIKE ?");
                    $query->bindParam(1, $stockDiseno);
                }
                if ($stockDiseno == "" && $stockEstatus != "") {
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

    public function Ordenar_Stock()
    {
        try {
            $query = $this->dbh->prepare("SELECT No_diseno, (SELECT SUM(Cantidad_actual)) AS totalAlmacen, Estatus FROM stock_almacen GROUP BY No_diseno;");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    // ------------------ PROCESOS ---------------------------------------------- //

    public function Agregar_proceso($Norden, $ProcActual, $Cantidad, $responsable, $Estado_proc, $Proc_restantes, $InicioFH)
    {
        try {
            $query = $this->dbh->prepare("INSERT INTO procesos_produccion (No_orden, Proceso_actual, Cantidad, Responsable, Estado_proceso, Procesos_restantes, Inicio_FH) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $query->bindParam(1, $Norden);
            $query->bindParam(2, $ProcActual);
            $query->bindParam(3, $Cantidad);
            $query->bindParam(4, $responsable);
            $query->bindParam(5, $Estado_proc);
            $query->bindParam(6, $Proc_restantes);
            $query->bindParam(7, $InicioFH);

            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function Get_noOrdenProc($noProc)
    {
        try {
            $query = $this->dbh->prepare("SELECT No_orden FROM procesos_produccion WHERE no_proceso LIKE ?;");
            $query->bindParam(1, $noProc);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function Get_noOrdenCarga($noCarga)
    {
        try {
            $query = $this->dbh->prepare("SELECT No_orden FROM reporte_corte WHERE no_reporte LIKE ?;");
            $query->bindParam(1, $noCarga);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function Get_noOrdenCargaDetallado($noCarga)
    {
        try {
            $query = $this->dbh->prepare("SELECT No_orden FROM reporte_detallado WHERE No_reporte LIKE ?;");
            $query->bindParam(1, $noCarga);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function GetProcesos()
    {
        try {
            $query = $this->dbh->prepare("SELECT * FROM procesos_produccion INNER JOIN ordenes_compras ON procesos_produccion.No_orden = ordenes_compras.Numero_orden WHERE Inicio_FH LIKE CONCAT('%', CURRENT_DATE, '%') ORDER BY Estado_proceso DESC;");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function GetAllProcesos()
    {
        try {
            $query = $this->dbh->prepare("SELECT * FROM procesos_produccion INNER JOIN ordenes_compras ON procesos_produccion.No_orden = ordenes_compras.Numero_orden;");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function Filtrar_Proceso($DisenoBuscar, $OrdenBuscar, $FechaProceso)
    {
        try {
            if ($DisenoBuscar == "" && $OrdenBuscar == "" && $FechaProceso == "") {
                $query = $this->dbh->prepare("SELECT * FROM procesos_produccion INNER JOIN ordenes_compras ON procesos_produccion.No_orden = ordenes_compras.Numero_orden;");
            } else {
                if ($DisenoBuscar != "" && $OrdenBuscar == "" && $FechaProceso == "") {
                    $query = $this->dbh->prepare("SELECT * FROM procesos_produccion INNER JOIN ordenes_compras ON procesos_produccion.No_orden = ordenes_compras.Numero_orden WHERE ordenes_compras.No_diseno LIKE ?");
                    $query->bindParam(1, $DisenoBuscar);
                }
                if ($DisenoBuscar != "" && $OrdenBuscar != "" && $FechaProceso == "") {
                    $query = $this->dbh->prepare("SELECT * FROM procesos_produccion INNER JOIN ordenes_compras ON procesos_produccion.No_orden = ordenes_compras.Numero_orden WHERE ordenes_compras.No_diseno LIKE ? AND ordenes_compras.Orden_compra LIKE ?");
                    $query->bindParam(1, $DisenoBuscar);
                    $query->bindParam(2, $OrdenBuscar);
                }
                if ($DisenoBuscar != "" && $OrdenBuscar != "" && $FechaProceso != "") {
                    $query = $this->dbh->prepare("SELECT * FROM procesos_produccion INNER JOIN ordenes_compras ON procesos_produccion.No_orden = ordenes_compras.Numero_orden WHERE ordenes_compras.No_diseno LIKE ? AND ordenes_compras.Orden_compra LIKE ? AND procesos_produccion.Inicio_FH LIKE '%$FechaProceso%'");
                    $query->bindParam(1, $DisenoBuscar);
                    $query->bindParam(2, $OrdenBuscar);
                    // $query->bindParam(3, $FechaProceso);
                }
                if ($DisenoBuscar == "" && $OrdenBuscar != "" && $FechaProceso == "") {
                    $query = $this->dbh->prepare("SELECT * FROM procesos_produccion INNER JOIN ordenes_compras ON procesos_produccion.No_orden = ordenes_compras.Numero_orden WHERE ordenes_compras.Orden_compra LIKE ?");
                    $query->bindParam(1, $OrdenBuscar);
                }
                if ($DisenoBuscar == "" && $OrdenBuscar != "" && $FechaProceso != "") {
                    $query = $this->dbh->prepare("SELECT * FROM procesos_produccion INNER JOIN ordenes_compras ON procesos_produccion.No_orden = ordenes_compras.Numero_orden WHERE ordenes_compras.Orden_compra LIKE ? AND procesos_produccion.Inicio_FH LIKE '%$FechaProceso%'");
                    $query->bindParam(1, $OrdenBuscar);
                    // $query->bindParam(2, $FechaProceso);
                }
                if ($DisenoBuscar == "" && $OrdenBuscar == "" && $FechaProceso != "") {
                    $query = $this->dbh->prepare("SELECT * FROM procesos_produccion INNER JOIN ordenes_compras ON procesos_produccion.No_orden = ordenes_compras.Numero_orden WHERE procesos_produccion.Inicio_FH LIKE '%$FechaProceso%' ");
                    // $query->bindParam(1, $FechaProceso);
                }
                if ($DisenoBuscar != "" && $OrdenBuscar == "" && $FechaProceso != "") {
                    $query = $this->dbh->prepare("SELECT * FROM procesos_produccion INNER JOIN ordenes_compras ON procesos_produccion.No_orden = ordenes_compras.Numero_orden WHERE ordenes_compras.No_diseno LIKE ? AND procesos_produccion.Inicio_FH LIKE '%$FechaProceso%'");
                    $query->bindParam(1, $DisenoBuscar);
                    // $query->bindParam(2, $FechaProceso);
                }
            }
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function Actualiza_ProcesoEstado($NoProceso, $estadoProceso, $Prealizados, $Prestantes, $TerminoFH)
    {
        try {
            $cerrado = "Cerrada";
            $query = $this->dbh->prepare("UPDATE procesos_produccion SET Estado_proceso=?, Procesos_realizados=?, Procesos_restantes=?, Termino_FH=? WHERE no_proceso LIKE ?;");
            $query->bindParam(1, $estadoProceso);
            $query->bindParam(2, $Prealizados);
            $query->bindParam(3, $Prestantes);
            $query->bindParam(4, $TerminoFH);
            $query->bindParam(5, $NoProceso);

            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;

        } catch (\Throwable $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function NuevoProceso_Upd($Norden, $ProcActual, $Cantidad, $responsable, $PrealizadosU, $Estado_proc, $Proc_restantes, $InicioFH)
    {
        try {
            $query = $this->dbh->prepare("INSERT INTO procesos_produccion (No_orden, Proceso_actual, Cantidad, Responsable, Procesos_realizados, Estado_proceso, Procesos_restantes, Inicio_FH) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $query->bindParam(1, $Norden);
            $query->bindParam(2, $ProcActual);
            $query->bindParam(3, $Cantidad);
            $query->bindParam(4, $responsable);
            $query->bindParam(5, $PrealizadosU);
            $query->bindParam(6, $Estado_proc);
            $query->bindParam(7, $Proc_restantes);
            $query->bindParam(8, $InicioFH);

            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function GetOrden_P($disenoBus, $ordenBus)
    {
        try {
            $query = $this->dbh->prepare("SELECT ordenes_compras.Numero_orden, piezas.Corte, piezas.Dobles, piezas.Rolado, piezas.Bisel, piezas.Taladro, piezas.Prensa FROM ordenes_compras INNER JOIN piezas on ordenes_compras.No_diseno = piezas.No_diseno WHERE ordenes_compras.No_diseno LIKE ? AND ordenes_compras.Orden_compra LIKE ?;");
            $query->bindParam(1, $disenoBus);
            $query->bindParam(2, $ordenBus);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    //-------------------------------- Turnos --------------------------------
    public function Get_noOrden_Detallado($ordenR, $no_diseno)
    {
        try {
            $query = $this->dbh->prepare("SELECT Numero_orden FROM ordenes_compras WHERE Orden_compra LIKE ? and No_diseno LIKE ?");
            $query->bindParam(1, $ordenR);
            $query->bindParam(2, $no_diseno);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function Insertar_Proceso_Detallado($Fecha, $FechaLim, $Turno, $Operador, $TipoDetallado, $No_orden, $CantidadyCalidad)
    {
        try {
            $query = $this->dbh->prepare("INSERT INTO reporte_detallado (Fecha, FechaLimite, Turno, Operador, TipoDetallado, No_orden, CantidadSolicitada) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $query->bindParam(1, $Fecha);
            $query->bindParam(2, $FechaLim);
            $query->bindParam(3, $Turno);
            $query->bindParam(4, $Operador);
            $query->bindParam(5, $TipoDetallado);
            $query->bindParam(6, $No_orden);
            $query->bindParam(7, $CantidadyCalidad);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;

        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function Insertar_Detallado_Resago($Estatus, $fechaInicio, $fechaLimite, $Turno, $Operador, $TipoDetalle, $No_orden, $CantidadyCalidad)
    {
        try {
            $query = $this->dbh->prepare("INSERT INTO reporte_detallado (Estatus, Fecha, FechaLimite, Turno, Operador, TipoDetallado, No_orden, CantidadSolicitada) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $query->bindParam(1, $Estatus);
            $query->bindParam(2, $fechaInicio);
            $query->bindParam(3, $fechaLimite);
            $query->bindParam(4, $Turno);
            $query->bindParam(5, $Operador);
            $query->bindParam(6, $TipoDetalle);
            $query->bindParam(7, $No_orden);
            $query->bindParam(8, $CantidadyCalidad);
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;

        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function Actualiza_ReporteD($Estatus, $Cantreport, $HorasTD, $Observaciones, $PorcentajeCumD, $NoReporte)
    {
        try {
            $query = $this->dbh->prepare("UPDATE reporte_detallado SET Estatus=?, CantidadEntregada=?, Horas_trabajadas=?, Observaciones=?, Porcentaje_cumplimiento=? WHERE No_reporte LIKE ?");

            $query->bindParam(1, $Estatus);
            $query->bindParam(2, $Cantreport);
            $query->bindParam(3, $HorasTD);
            $query->bindParam(4, $Observaciones);
            $query->bindParam(5, $PorcentajeCumD);
            $query->bindParam(6, $NoReporte);

            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;

        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function CargaCorte($fecha, $fechalimite, $turno, $operador, $maquina, $no_orden, $espesor, $foliomp, $nestSolic, $placasnest, $horasProyectadas)
    {
        try {
            $query = $this->dbh->prepare("INSERT INTO reporte_corte (Fecha, FechaLimite, Turno, Operador, Maquina, No_orden, Espesor, Vale_MP, NEST_Solicitado, Placas_NEST, HorasProyectadas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $query->bindParam(1, $fecha);
            $query->bindParam(2, $fechalimite);
            $query->bindParam(3, $turno);
            $query->bindParam(4, $operador);
            $query->bindParam(5, $maquina);
            $query->bindParam(6, $no_orden);
            $query->bindParam(7, $espesor);
            $query->bindParam(8, $foliomp);
            $query->bindParam(9, $nestSolic);
            $query->bindParam(10, $placasnest);
            $query->bindParam(11, $horasProyectadas);


            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;

        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function CargaCorteResago($fecha, $estatus, $fechalimite, $turno, $operador, $maquina, $no_orden, $espesor, $foliomp, $nestSolic, $placasnest, $HorasProy)
    {
        try {
            $query = $this->dbh->prepare("INSERT INTO reporte_corte (Estatus, Fecha, FechaLimite, Turno, Operador, Maquina, No_orden, Espesor, Vale_MP, NEST_Solicitado, Placas_NEST, HorasProyectadas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $query->bindParam(1, $estatus);
            $query->bindParam(2, $fecha);
            $query->bindParam(3, $fechalimite);
            $query->bindParam(4, $turno);
            $query->bindParam(5, $operador);
            $query->bindParam(6, $maquina);
            $query->bindParam(7, $no_orden);
            $query->bindParam(8, $espesor);
            $query->bindParam(9, $foliomp);
            $query->bindParam(10, $nestSolic);
            $query->bindParam(11, $placasnest);
            $query->bindParam(12, $HorasProy);

            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;

        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }

    public function Get_Cargas_Corte()
    {
        try {
            $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno ORDER BY ordenes_compras.No_diseno;");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function Actualiza_Reporte($NoReporte, $Estatus, $Cant_rep, $Placas_cort, $HorasTrabajadas, $Observaciones, $PorcentajeCum)
    {
        try {
            $query = $this->dbh->prepare("UPDATE reporte_corte SET Estatus=?, Cantidad_reportada=?, PlacasCortadas=?, Horas_trabajadas=?, Observaciones=?, Porcentaje_cumplimiento=? WHERE No_reporte LIKE ?");

            $query->bindParam(1, $Estatus);
            $query->bindParam(2, $Cant_rep);
            $query->bindParam(3, $Placas_cort);
            $query->bindParam(4, $HorasTrabajadas);
            $query->bindParam(5, $Observaciones);
            $query->bindParam(6, $PorcentajeCum);
            $query->bindParam(7, $NoReporte);

            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;

        } catch (PDOException $e) {
            $e->getMessage();
            echo $e;
        }
    }
    public function Get_Cargas_Detallado()
    {
        try {
            $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte , reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, reporte_detallado.No_orden, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden ORDER BY ordenes_compras.No_diseno;");
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function FiltrarCarga($fechaBusqueda, $filtroBusqueda)
    {
        try {
            if ($fechaBusqueda == "" && $filtroBusqueda == "0") {
                $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno ORDER BY ordenes_compras.No_diseno;");
            } else if ($fechaBusqueda != "" && $filtroBusqueda == "0") {
                $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_corte.Fecha LIKE ? ORDER BY ordenes_compras.No_diseno;");
                $query->bindParam(1, $fechaBusqueda);
            } else {
                //fecha vacía, solo se usan filtros
                if ($fechaBusqueda == "") {
                    if ($filtroBusqueda == "1") {
                        $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_corte.Estatus LIKE 'Terminado' ORDER BY ordenes_compras.No_diseno;");
                    } else if ($filtroBusqueda == "12") {
                        $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_corte.Estatus LIKE 'Terminado' OR reporte_corte.Estatus LIKE 'Restante'  ORDER BY ordenes_compras.No_diseno;");
                    } else if ($filtroBusqueda == "123") {
                        $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_corte.Estatus LIKE 'Terminado' OR reporte_corte.Estatus LIKE 'Restante' OR reporte_corte.Estatus LIKE 'En proceso'  ORDER BY ordenes_compras.No_diseno;");
                    } else if ($filtroBusqueda == "2") {
                        $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_corte.Estatus LIKE 'Restante' ORDER BY ordenes_compras.No_diseno;");
                    } else if ($filtroBusqueda == "23") {
                        $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_corte.Estatus LIKE 'Restante' OR reporte_corte.Estatus LIKE 'En proceso'  ORDER BY ordenes_compras.No_diseno;");
                    } else if ($filtroBusqueda == "3") {
                        $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_corte.Estatus LIKE 'En proceso' ORDER BY ordenes_compras.No_diseno;");
                    } else {
                        $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_corte.Estatus LIKE 'Terminado' OR reporte_corte.Estatus LIKE 'En proceso'  ORDER BY ordenes_compras.No_diseno;");
                    }
                } else {
                    // Combinados
                    if ($filtroBusqueda == "1") {
                        $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_corte.Fecha LIKE ? AND reporte_corte.Estatus LIKE 'Terminado' ORDER BY ordenes_compras.No_diseno;");
                        $query->bindParam(1, $fechaBusqueda);

                    } else if ($filtroBusqueda == "12") {
                        $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE (reporte_corte.Fecha LIKE ?) AND (reporte_corte.Estatus LIKE 'Terminado' OR reporte_corte.Estatus LIKE 'Restante') ORDER BY ordenes_compras.No_diseno;");
                        $query->bindParam(1, $fechaBusqueda);

                    } else if ($filtroBusqueda == "123") {
                        $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_corte.Fecha LIKE ? AND (reporte_corte.Estatus LIKE 'Terminado' OR reporte_corte.Estatus LIKE 'Restante' OR reporte_corte.Estatus LIKE 'En proceso') ORDER BY ordenes_compras.No_diseno;");
                        $query->bindParam(1, $fechaBusqueda);

                    } else if ($filtroBusqueda == "2") {
                        $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_corte.Fecha LIKE ? AND reporte_corte.Estatus LIKE 'Restante' ORDER BY ordenes_compras.No_diseno;");
                        $query->bindParam(1, $fechaBusqueda);

                    } else if ($filtroBusqueda == "23") {
                        $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE (reporte_corte.Fecha LIKE ?) AND (reporte_corte.Estatus LIKE 'Restante' OR reporte_corte.Estatus LIKE 'En proceso') ORDER BY ordenes_compras.No_diseno;");
                        $query->bindParam(1, $fechaBusqueda);

                    } else if ($filtroBusqueda == "3") {
                        $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_corte.Fecha LIKE ? AND reporte_corte.Estatus LIKE 'En proceso' ORDER BY ordenes_compras.No_diseno;");
                        $query->bindParam(1, $fechaBusqueda);

                    } else {
                        $query = $this->dbh->prepare("SELECT reporte_corte.No_reporte, reporte_corte.Fecha, reporte_corte.Estatus, reporte_corte.FechaLimite, reporte_corte.Turno, reporte_corte.Operador, ordenes_compras.No_diseno, piezas.Codigo_MP, reporte_corte.Espesor, reporte_corte.Vale_MP, reporte_corte.NEST_Solicitado, reporte_corte.Cantidad_reportada, reporte_corte.Placas_NEST, reporte_corte.PlacasCortadas, reporte_corte.HorasProyectadas, ordenes_compras.Orden_compra, reporte_corte.Horas_trabajadas, reporte_corte.Observaciones, reporte_corte.Porcentaje_cumplimiento FROM reporte_corte INNER JOIN ordenes_compras ON reporte_corte.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE (reporte_corte.Fecha LIKE ?) AND (reporte_corte.Estatus LIKE 'Terminado' OR reporte_corte.Estatus LIKE 'En proceso') ORDER BY ordenes_compras.No_diseno;");
                        $query->bindParam(1, $fechaBusqueda);

                    }
                }
            }
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function FiltrarCargaDetallado($fechaBusqueda, $filtroBusqueda)
    {
        try {
            if ($fechaBusqueda == "" && $filtroBusqueda == "0") {
                if ($filtroBusqueda == "1") {
                    $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Estatus LIKE 'Terminado' ORDER BY ordenes_compras.No_diseno;");
                } else if ($filtroBusqueda == "12") {
                    $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Estatus LIKE 'Terminado' OR reporte_detallado.Estatus LIKE 'Restante'  ORDER BY ordenes_compras.No_diseno;");
                } else if ($filtroBusqueda == "123") {
                    $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Estatus LIKE 'Terminado' OR reporte_detallado.Estatus LIKE 'Restante' OR reporte_detallado.Estatus LIKE 'En proceso'  ORDER BY ordenes_compras.No_diseno;");
                } else if ($filtroBusqueda == "2") {
                    $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Estatus LIKE 'Restante' ORDER BY ordenes_compras.No_diseno;");
                } else if ($filtroBusqueda == "23") {
                    $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Estatus LIKE 'Restante' OR reporte_detallado.Estatus LIKE 'En proceso'  ORDER BY ordenes_compras.No_diseno;");
                } else if ($filtroBusqueda == "3") {
                    $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Estatus LIKE 'En proceso' ORDER BY ordenes_compras.No_diseno;");
                } else {
                    $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Estatus LIKE 'Terminado' OR reporte_detallado.Estatus LIKE 'En proceso'  ORDER BY ordenes_compras.No_diseno;");
                }
            }else if ($fechaBusqueda != "" && $filtroBusqueda == "0") {
                $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Fecha LIKE ? ORDER BY ordenes_compras.No_diseno;");
                $query->bindParam(1, $fechaBusqueda);
            }else{
                if ($fechaBusqueda == "") {
                    if ($filtroBusqueda == "1") {
                        $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Estatus LIKE 'Terminado' ORDER BY ordenes_compras.No_diseno;");
                    } else if ($filtroBusqueda == "12") {
                        $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Estatus LIKE 'Terminado' OR reporte_detallado.Estatus LIKE 'Restante'  ORDER BY ordenes_compras.No_diseno;");
                    } else if ($filtroBusqueda == "123") {
                        $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Estatus LIKE 'Terminado' OR reporte_detallado.Estatus LIKE 'Restante' OR reporte_detallado.Estatus LIKE 'En proceso'  ORDER BY ordenes_compras.No_diseno;");
                    } else if ($filtroBusqueda == "2") {
                        $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Estatus LIKE 'Restante' ORDER BY ordenes_compras.No_diseno;");
                    } else if ($filtroBusqueda == "23") {
                        $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Estatus LIKE 'Restante' OR reporte_detallado.Estatus LIKE 'En proceso'  ORDER BY ordenes_compras.No_diseno;");
                    } else if ($filtroBusqueda == "3") {
                        $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Estatus LIKE 'En proceso' ORDER BY ordenes_compras.No_diseno;");
                    } else {
                        $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Estatus LIKE 'Terminado' OR reporte_detallado.Estatus LIKE 'En proceso'  ORDER BY ordenes_compras.No_diseno;");
                    }
                } else {
                    // Combinados
                    if ($filtroBusqueda == "1") {
                        $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Fecha LIKE ? AND reporte_detallado.Estatus LIKE 'Terminado' ORDER BY ordenes_compras.No_diseno;");
                        $query->bindParam(1, $fechaBusqueda);

                    } else if ($filtroBusqueda == "12") {
                        $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE (reporte_detallado.Fecha LIKE ?) AND (reporte_detallado.Estatus LIKE 'Terminado' OR reporte_detallado.Estatus LIKE 'Restante') ORDER BY ordenes_compras.No_diseno;");
                        $query->bindParam(1, $fechaBusqueda);

                    } else if ($filtroBusqueda == "123") {
                        $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Fecha LIKE ? AND (reporte_detallado.Estatus LIKE 'Terminado' OR reporte_detallado.Estatus LIKE 'Restante' OR reporte_detallado.Estatus LIKE 'En proceso') ORDER BY ordenes_compras.No_diseno;");
                        $query->bindParam(1, $fechaBusqueda);

                    } else if ($filtroBusqueda == "2") {
                        $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Fecha LIKE ? AND reporte_detallado.Estatus LIKE 'Restante' ORDER BY ordenes_compras.No_diseno;");
                        $query->bindParam(1, $fechaBusqueda);

                    } else if ($filtroBusqueda == "23") {
                        $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE (reporte_detallado.Fecha LIKE ?) AND (reporte_detallado.Estatus LIKE 'Restante' OR reporte_detallado.Estatus LIKE 'En proceso') ORDER BY ordenes_compras.No_diseno;");
                        $query->bindParam(1, $fechaBusqueda);

                    } else if ($filtroBusqueda == "3") {
                        $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE reporte_detallado.Fecha LIKE ? AND reporte_detallado.Estatus LIKE 'En proceso' ORDER BY ordenes_compras.No_diseno;");
                        $query->bindParam(1, $fechaBusqueda);

                    } else {
                        $query = $this->dbh->prepare("SELECT reporte_detallado.No_reporte, reporte_detallado.Estatus, reporte_detallado.Fecha, reporte_detallado.FechaLimite, reporte_detallado.Turno, reporte_detallado.Operador, reporte_detallado.TipoDetallado, ordenes_compras.Orden_compra, ordenes_compras.No_diseno, reporte_detallado.CantidadSolicitada, reporte_detallado.CantidadEntregada, reporte_detallado.Horas_trabajadas, reporte_detallado.Observaciones, reporte_detallado.Porcentaje_cumplimiento FROM reporte_detallado INNER JOIN ordenes_compras ON reporte_detallado.No_orden = ordenes_compras.Numero_orden INNER JOIN piezas ON ordenes_compras.No_diseno = piezas.No_diseno WHERE (reporte_detallado.Fecha LIKE ?) AND (reporte_detallado.Estatus LIKE 'Terminado' OR reporte_detallado.Estatus LIKE 'En proceso') ORDER BY ordenes_compras.No_diseno;");
                        $query->bindParam(1, $fechaBusqueda);
                    }
            }
            }
            $query->execute();
            return $query->fetchAll();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}

/*-----------------------------------------------------------------------------------------------------*/