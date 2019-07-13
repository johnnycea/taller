<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/Conexion.php';
require_once '../../clases/OrdenTrabajo.php';

$Funciones = new Funciones();

$txt_id_orden = $Funciones->limpiarTexto($_REQUEST['txt_id_orden']);
$txt_descripcion = $Funciones->limpiarTexto($_REQUEST['txt_descripcion']);
$txt_kilometraje = $Funciones->limpiarNumeroEntero($_REQUEST['txt_kilometraje']);
$cmb_trabajador = $Funciones->limpiarNumeroEntero($_REQUEST['cmb_trabajador']);

//if operador ternario
$txt_kilometraje = ($txt_kilometraje=="") ? 0 : $txt_kilometraje;
$cmb_trabajador = ($cmb_trabajador=="") ? 0 : $cmb_trabajador;


$OrdenTrabajo = new OrdenTrabajo();
$OrdenTrabajo->setIdOrden($txt_id_orden);
$OrdenTrabajo->setDescripcionDiagnostico($txt_descripcion);
$OrdenTrabajo->setKilometraje($txt_kilometraje);
$OrdenTrabajo->setTrabajador($cmb_trabajador);




   if($OrdenTrabajo->actualizarDatosOrden()){
      echo "1";
   }else{
      echo "2";
   }



?>
