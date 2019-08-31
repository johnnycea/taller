<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();


$txt_id_orden = $Funciones->limpiarNumeroEntero($_REQUEST['id_orden']);
$nuevo_estado = $Funciones->limpiarNumeroEntero($_REQUEST['nuevo_estado']);
$fecha_pago = $Funciones->limpiarTexto($_REQUEST['fecha_pago']);

$OrdenTrabajo = new OrdenTrabajo();
$OrdenTrabajo->setIdOrden($txt_id_orden);
$OrdenTrabajo->setIdEstado($nuevo_estado);
$OrdenTrabajo->setFechaPago($fecha_pago);


   if($OrdenTrabajo->cambiarEstadoOrden()){
      echo "1";
   }else{
     echo "2";
   }



?>