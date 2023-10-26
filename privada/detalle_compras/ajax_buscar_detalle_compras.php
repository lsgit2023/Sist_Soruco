<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$cantidad = $_POST["cantidad"];
$nombre = $_POST["nombre"];
$precio = $_POST["precio"];

//$db->debug=true;
if($cantidad or $nombre or $precio){
    $sql3 = $db->Prepare("SELECT pr.*, det.*
                        FROM productos pr
                        INNER JOIN detalle_compras det ON det.id_producto=pr.id_producto
                        WHERE det.cantidad LIKE ?
                        AND pr.nombre LIKE ?
                        AND pr.precio LIKE ?
                        AND det.estado <> 'X' 
                        AND pr.estado <> 'X'
                        ");
    $rs3 = $db->GetAll($sql3, array($cantidad."%",$nombre."%", $precio."%"));
if($rs3){
    echo"<center>
        <table class='listado'>
            <tr>
                <th>CANTIDAD</th><th>NOMBRE</th><th>PRECIO</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>

                </tr>";
    foreach ($rs3 as $k => $fila){
        $str = $fila["cantidad"];
        $str1 = $fila["nombre"];
        $str2 = $fila["precio"];

        echo"<tr>
            <td align='center'>".resaltar($cantidad, $str)."</td>
            <td>".resaltar($nombre, $str1)."</td>
            <td>".resaltar($precio, $str2)."</td>
            <td align='center'>
                <form name=''formModif".$fila["id_detalle_compra"]."' method='post' action='detalle_compramodificar.php'>
                    <input type='hidden' name='id_detalle_compra' value='".$fila['id_detalle_compra']."'>
                    <a href='javascript:document.formModif".$fila['id_detalle_compra'].".submit();' title='Modificar detalle_compra Sistema'>
                    Modificar>>
                    </a>
                    </form>
                    </td>
                    <td align='center'>
                        <form name='formElimi".$fila["id_detalle_compra"]."' method='post' action='detalle_compra_eliminar.php'>
                            <input type='hidden' name='id_detalle_compra' value='".$fila["id_detalle_compra"]."'>
                            <a href='javascript:document.formElimi".$fila['id_detalle_compra'].".submit();' title='Eliminar detalle_compra Sistema'
                            location.href='detalle_compraeliminar.php''>
                            Eliminar>>
                            </a>
                        </form>
                    </td>
                </tr>";
    }
    echo"</table>
    </center>";
}else{
    echo"<center><b>EL DETALLE DE LA COMPRA NO EXISTE!!</b></center><br>";
}
}
?>