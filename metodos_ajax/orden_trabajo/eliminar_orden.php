<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';
require_once '../../clases/RegistroActividad.php';

$Funciones = new Funciones();

$id_orden = $Funciones->limpiarNumeroEntero($_REQUEST['id_orden']);

$OrdenTrabajo = new OrdenTrabajo();
$OrdenTrabajo->setIdOrden($id_orden);

 $resultado_comprobacion = $OrdenTrabajo->consultarExisteDetalleOrden();

 if($resultado_comprobacion->num_rows>0){//si tiene detalle orden no eliminamos el registro, solo cambiamos el estado
     if($OrdenTrabajo->eliminarOrdenTrabajo(1)){
        echo "1";

     }else{
        echo "2";
     }
 }else{ // si no tiene registro, solo se elimina
     if($OrdenTrabajo->eliminarOrdenTrabajo(2)){
        echo "1";
     }else{
        echo "2";
     }
 }

 //registro de actividad
 @session_start();
 $registro = new RegistroActividad();
 $registro->setRutUsuario($_SESSION['run']);
 $registro->setNombreUsuario($_SESSION['nombre']);
 $registro->setAccion("Elimina orden");
 $registro->setDetalleAccion('Elimina la orden N: '.$id_orden);
 $registro->setIdOrden($id_orden);
 $registro->guardarRegistroActividad();
 //fin registro actividad

?>
