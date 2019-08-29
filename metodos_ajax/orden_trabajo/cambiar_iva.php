<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();


$txt_id_orden = $Funciones->limpiarNumeroEntero($_REQUEST['id_orden']);
$iva = $Funciones->limpiarTexto($_REQUEST['iva']);

// echo "el iva que llega es: ".$iva;

$iva = ($iva=="true") ? 19 : 0;

// echo "el iva es: ".$iva;

$OrdenTrabajo = new OrdenTrabajo();
$OrdenTrabajo->setIdOrden($txt_id_orden);
$OrdenTrabajo->setIva($iva);


   if($OrdenTrabajo->cambiarIva()){
      echo "1";
   }else{
     echo "2";
   }



?>
