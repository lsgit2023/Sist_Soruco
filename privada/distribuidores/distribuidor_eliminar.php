<?php
session_start();
require_once("../../conexion.php");


$id_distribuidor = $_REQUEST["id_distribuidor"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
//$db->debug=true;

/*LAS CONSULTAS SE DEBE HACER CON TODAS LAS TABLAS EN LAS QUE EL ID_PERSONA ESTA CON HERENCIA*/
$sql = $db->Prepare("SELECT *
                     FROM compras
                     WHERE id_distribuidor = ? 
                     AND estado <> 'X'                    
                        ");
$rs = $db->GetAll($sql,array($id_distribuidor));

$sql2 = $db->Prepare("SELECT *
                     FROM productos
                     WHERE id_distribuidor = ? 
                     AND estado <> 'X'                    
                        ");
$rs2 = $db->GetAll($sql2,array($id_distribuidor));  


if((!$rs)and (!$rs2)){
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
    $rs1 =$db->AutoExecute("distribuidores", $reg, "UPDATE","id_distribuidor='".$id_distribuidor."'"); 
    header("Location: distribuidores.php");
    exit();
 } else {
   require_once("../../libreria_menu.php");
    echo"<div class='mensaje'>";
        $mensage = "NO SE ELIMINARON LOS DATOS DEL DISTRIBUIDOR PORQUE TIENE HERENCIA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='distribuidores.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 
