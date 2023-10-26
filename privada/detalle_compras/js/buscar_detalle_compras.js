"use strict"
function buscar_personas() {
    var d1, d2, d3, d4, ajax, url, param, contenedor;
        contenedor = document.getElementById('detalle1');
        d1 = document.formu.cantidad.value;
        d2 = document.formu.nombre.value;
        d3 = document.formu.precio.value;
        ajax = nuevoAjax();
        url = "ajax_buscar_detalle_compras.php"
        param = 'cantidad='+d1+'&nombre='+d2+'&precio='+d3;
        //alert(param)
        ajax.open("POST", url, true);
        ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        ajax.onreadystatechange = function() {
            if(ajax.readyState == 4){
                contenedor.innerHTML = ajax.responseText;
            }
        }
        ajax.send(param);
}