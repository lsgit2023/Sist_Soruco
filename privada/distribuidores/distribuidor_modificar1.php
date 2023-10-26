<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
     
       $id_distribuidor = $_POST["id_distribuidor"];
       $nombre = $_POST["nombre"];
       $nit = $_POST["nit"];
       $direccion = $_POST["direccion"];

if(($nombre!="") and ($nit!="") and ($direccion!="")){
   $reg = array();
   $reg["nombre"] = $nombre;
   $reg["nit"] = $nit;
   $reg["direccion"] = $direccion;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 =$db->AutoExecute("distribuidores", $reg, "UPDATE","id_distribuidor='".$id_distribuidor."'"); 
   header("Location: distribuidores.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL DISTRIBUIDOR";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='distribuidor_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?>
