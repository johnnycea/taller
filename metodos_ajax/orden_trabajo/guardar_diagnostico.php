<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/Conexion.php';
require_once '../../clases/OrdenTrabajo.php';

$Funciones = new Funciones();

$txt_rut_cliente = $Funciones->limpiarTexto($_REQUEST['txt_rut_cliente']);
$posicion_guion = strpos($txt_rut_cliente,'-');
$txt_rut_cliente = substr($txt_rut_cliente,0,$posicion_guion);

$txt_patente = $Funciones->limpiarTexto($_REQUEST['txt_patente']);

$txt_id_orden = $Funciones->limpiarTexto($_REQUEST['txt_id_orden']);
$txt_descripcion = $Funciones->limpiarTexto($_REQUEST['txt_descripcion']);
$txt_kilometraje = $Funciones->limpiarNumeroEntero($_REQUEST['txt_kilometraje']);
$cmb_trabajador = $Funciones->limpiarNumeroEntero($_REQUEST['cmb_trabajador']);

//if operador ternario
$txt_kilometraje = ($txt_kilometraje=="") ? 0 : $txt_kilometraje;
$cmb_trabajador = ($cmb_trabajador=="") ? 0 : $cmb_trabajador;


$OrdenTrabajo = new OrdenTrabajo();
$OrdenTrabajo->setRutCliente($txt_rut_cliente);
$OrdenTrabajo->setPatente($txt_patente);

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
