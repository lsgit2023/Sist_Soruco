<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript'>
         function buscar_detalle_compras() {
          var d1, d2, d3, ajax, url, param, contenedor;
              contenedor = document.getElementById('detalle1');
              d1 = document.formu.cantidad.value;
              d2 = document.formu.nombre.value;
              d3 = document.formu.precio.value;
              //alert(d1);
              ajax = nuevoAjax();
              url = 'ajax_buscar_detalle_compras.php'
              param = 'cantidad='+d1+'&nombre='+d2+'&precio='+d3;
              //alert(param)
              ajax.open('POST', url, true);
              ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
              ajax.onreadystatechange = function() {
                  if(ajax.readyState == 4){
                      contenedor.innerHTML = ajax.responseText;
                  }
              }
              ajax.send(param);
      }

       </script>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='detalle_compras_nuevo.php'>Nueva detalle_compras</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       /*echo"<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo"ROL: ".$_SESSION["sesion_rol"]."</h3>";  */
        echo"<h1>LISTADO DE DETALLE COMPRAS</h1>";
        $sql = $db->Prepare ("SELECT cantidad
                        FROM detalle_compras
                        WHERE estado <> 'X'
                        ");

      $rs = $db->GetAll($sql);
  
echo"
<!------INICIO BUSCADOR------->
    <center>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
      <tr>
        <th>
          <b>CANTIDAD</b><br />
          <select name='cantidad'>";
          foreach($rs as $k =>$fila){
            echo"<option value='".$fila['cantidad']."'>".$fila['cantidad']."</option>";
           
          }
          
        echo"</select>
        </th>
    
        <th>
          <b>NOMBRE</b><br />
          <input type='text' name='nombre' value='' size='10' onkeyUp='buscar_detalle_compras()'>
        </th>
        <th>
          <b>PRECIO</b><br />
          <input type='text' name='precio' value='' size='10' onkeyUp='buscar_detalle_compras()'>
        </th>
        
      </tr>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR------>";
    echo"<div id='detalle1'>";
    

$sql = $db->Prepare("SELECT pr.*, pr.nombre, pr.precio, det.cantidad
                     FROM productos pr
                     INNER JOIN detalle_compras det ON det.id_producto=pr.id_producto
                     WHERE pr.estado <> 'X' AND det.estado <> 'X' 
                     GROUP BY(det.cantidad)
                     ORDER BY id_detalle_compra DESC                 
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>CANTIDAD</th><th>NOMBRE</th><th>PRECIO</th>

                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['cantidad']."</td>
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['precio']."</td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
    }
echo"</div>";
echo "</body>
      </html> ";

 ?>