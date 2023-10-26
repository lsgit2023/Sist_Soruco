<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");
//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";
       
       
         echo"<h1>LISTADO DE DISTRIBUIDORES</h1>";
         echo"<div id='distribuidor1'>"; 
         contarRegistros($db, "distribuidores");
         paginacion("distribuidores.php?");
/*$sql = $db->Prepare("SELECT *
                     FROM distribuidores
                     WHERE estado <> 'X' 
                     ORDER BY id_distribuidor DESC                      
                        ");
$rs = $db->GetAll($sql);*/
$sql3 = $db->Prepare("SELECT *
                     FROM distribuidores
                     WHERE estado <> 'x'
                     AND id_distribuidor > 1
                     ORDER BY id_distribuidor DESC LIMIT ? OFFSET ?
                     ");
$rs = $db->GetAll($sql3, array($nElem, $regIni));

   if ($rs) {
        echo"<center>
        
        <b><a href='distribuidor_nuevo.php'>Nuevo Distribuidor>>>></a></b>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>NOMBRE</th><th>NIT</th><th>DIRECCION</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=0;
                $total= $pag-1;
                $a = $nElem*$total;
                $b= $b+1+$a;

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
       echo"</div>";   
       echo"<!--PAGINACION------------------------------------------->";
       echo"<table border='0' align='center'>
            <tr>
            <td>";
            if(!empty($urlback)){
              echo"<a href=".$urlback." style='font-family:Verdana;font-size:9px;cursor:pointer'; >&laquo;Anterior</a>";  
            }
            if(!empty($paginas)) {
             foreach ($paginas as $k => $pagg){
               if ($pagg["npag"]== $pag){
                 if($pag != '1'){
                   echo"|";
                 }
                 echo"<b style='color:#FB992F;font-size: 12px;'>";
       
               }else
            echo"</b> | <a href=".$pagg["pagV"]." style='cursor:pointer;'>";echo $pagg["npag"]; echo"</a>";
           }
         }
           if(($nPags > $nBotones) and (!empty($urlnext)) and ($pag < $nPags)){
       
           
           echo" |<a href=".$urlnext." style='font-family: Verdana;font-size: 9px;cursor:pointer'>siguiente&raquo;</a>";
            }
       echo"</td>
         </tr>
         </table>";
         echo"<!--PAGINACION------------------------------->";    
       echo "</body>
             </html> ";
       
        ?>