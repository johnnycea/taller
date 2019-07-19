<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';

$Funciones = new Funciones();

$id_orden = $Funciones->limpiarNumeroEntero($_REQUEST['id_orden']);
$id_detalle = $Funciones->limpiarNumeroEntero($_REQUEST['id_detalle']);

$OrdenTrabajo = new OrdenTrabajo();
$OrdenTrabajo->setIdOrden($id_orden);
$OrdenTrabajo->setIdDetalle($id_detalle);

  if($OrdenTrabajo->eliminarDetalleOrden()){
     echo "1";
  }else{
     echo "2";
  }

?>
