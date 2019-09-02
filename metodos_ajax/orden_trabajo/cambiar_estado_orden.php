<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';

$Funciones = new Funciones();


$txt_id_orden = $Funciones->limpiarNumeroEntero($_REQUEST['id_orden']);
$nuevo_estado = $Funciones->limpiarNumeroEntero($_REQUEST['nuevo_estado']);
$fecha_pago = $Funciones->limpiarTexto($_REQUEST['fecha_pago']);
$fecha_entrega = $Funciones->limpiarTexto($_REQUEST['fecha_entrega']);

$OrdenTrabajo = new OrdenTrabajo();
$OrdenTrabajo->setIdOrden($txt_id_orden);
$OrdenTrabajo->setIdEstado($nuevo_estado);
$OrdenTrabajo->setFechaPago($fecha_pago);
$OrdenTrabajo->setFechaEntrega($fecha_entrega);


   if($OrdenTrabajo->cambiarEstadoOrden()){
      echo "1";
   }else{
      echo "2";
   }



?>
