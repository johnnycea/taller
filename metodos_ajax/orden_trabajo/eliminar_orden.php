<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';

$Funciones = new Funciones();

$id_orden = $Funciones->limpiarNumeroEntero($_REQUEST['id_orden']);

$OrdenTrabajo = new OrdenTrabajo();
$OrdenTrabajo->setIdOrden($id_orden);

  if($OrdenTrabajo->eliminarOrdenTrabajo()){
     echo "1";
  }else{
     echo "2";
  }

?>
