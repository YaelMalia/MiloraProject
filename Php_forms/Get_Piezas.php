<?php
    if(isset($_POST["dato-Rbt"])){
        $tipo = $_POST["dato-Rbt"];
        $id = $_POST["ID"];
            require_once("../conexionBD/Consultas.php");
            $miloraObj = MiloraClass::singleton();
            $data;
        if(($id == "" || $id == null)){
            $data= $miloraObj->GetAllPiezas();
        }
        else if($tipo == "noDiseno"){
            $data = $miloraObj->selectPieza($id);
        }else if($tipo == "Codemp"){
            $data = $miloraObj->selectByCode($id);
        }

        if(count($data)>0){
            foreach($data as $fila){
                ?>
                <tr style="max-height: 10px;">
                                <th scope="row">  <?php echo $fila['No_diseno']; ?>  </th>
                                <td style="max-width: 15px;">  <?php echo $fila['Descripcion_MP']; ?> </td>
                                <td>  <?php echo $fila['Codigo_MP']; ?>  </td>
                                
                                <td>  <?php echo $fila['Corte']; ?>  </td>
                                <td>  <?php echo $fila['Dobles']; ?>  </td>
                                <td>  <?php echo $fila['Rolado']; ?>  </td>
                                <td>  <?php echo $fila['Bisel']; ?>  </td>
                                <td>  <?php echo $fila['Taladro']; ?>  </td>
                                <td>  <?php echo $fila['Prensa']; ?>  </td>
                <?php
               }
        }else{
            echo "No";
        }
        
    }
?>
