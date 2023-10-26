<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='distribuidor_nuevo.php'>Nuevo distribuidor</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar 
       Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 
       25px;' class='boton_cerrar'></a>";
       echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo"ROL: ".$_SESSION["sesion_rol"]."</h3>";
         echo"<h1>LISTADO DE DISTRIBUIDORES</h1>";

$sql = $db->Prepare("SELECT *
                     FROM distribuidores
                     WHERE estado <> 'X' 
                     ORDER BY id_distribuidor DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>NOMBRE</th><th>NIT</th><th>DIRECCION</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['nit']."</td>
                        <td>".$fila['direccion']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_distribuidor"]."'method='post' 
                          action='distribuidor_modificar.php'>
                            <input type='hidden' name='id_distribuidor' value='".$fila['id_distribuidor']."'>
                            <a href='javascript:document.formModif".$fila['id_distribuidor'].".submit();' 
                            title='Modificar Distribuidor del Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_distribuidor"]."' method='post' action='distribuidor_eliminar.php'>
                            <input type='hidden' name='id_distribuidor' value='".$fila["id_distribuidor"]."'>
                            <a href='javascript:document.formElimi".$fila['id_distribuidor'].".submit();' title='Eliminar Distribuidor del Sistema' 
                            onclick='javascript:return(confirm(\"Desea realmente Eliminar al Distribuidor ".$fila["nombre"]." ".$fila["nit"]." ".$fila["direccion"]." ?\"))'; location.href='distribuidor_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
    }

echo "</body>
      </html> ";

 ?>