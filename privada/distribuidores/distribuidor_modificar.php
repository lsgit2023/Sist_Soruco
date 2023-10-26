<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

$id_distribuidor=$_POST["id_distribuidor"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";  
       
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo"ROL: ".$_SESSION["sesion_rol"]."</h3>";
         echo"<h1>MODIFICAR DISTRIBUIDOR</h1>";

$sql = $db->Prepare("SELECT *
                     FROM distribuidores
                     WHERE id_distribuidor= ?
                     AND estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($id_distribuidor));
   if ($rs) {

    foreach($rs as $k => $fila){
        echo"<form action='distribuidor_modificar1.php' method='post' name='formu'>";
        echo"<center>
            <table class='listado'>
                <tr>
                    <th><b>(*)nombre</b></th>
                    <td><input type='text' name='nombre' size='10' value='".$fila["nombre"]."'></td>
                </tr>
                <tr>
                    <th><b>Nit</b></th>
                    <td><input type='text' name='nit' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["nit"]."'></td>
                </tr>

                <tr>
                    <th><b>Dirección</b></th>
                    <td><input type='text' name='direccion' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["direccion"]."'>
                    </td>                    
                </tr> 
                      
              <tr>
                <td align='center' colspan='2'>  
                  <input type='submit' value='MODIFICAR DISTRIBUIDOR'  >
                  <input type='hidden' name='id_distribuidor' value='".$fila["id_distribuidor"]."'>
                </td>
              </tr>

            </table>
            </center>";
      echo"</form>" ;     
                        
  }

    }
                                       
echo "</body>
      </html> ";

 ?>