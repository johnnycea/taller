<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();


$txt_id_orden = $Funciones->limpiarTexto($_REQUEST['txt_id_orden']);
$txt_descripcion_detalle_orden = $Funciones->limpiarTexto($_REQUEST['txt_descripcion_detalle_orden']);
$cmb_tipo_detalle_orden = $Funciones->limpiarNumeroEntero($_REQUEST['cmb_tipo_detalle_orden']);
$txt_valor_unitario_detalle = $Funciones->limpiarNumeroEntero($_REQUEST['txt_valor_unitario_detalle']);
$txt_cantidad_detalle_orden = $Funciones->limpiarNumeroEntero($_REQUEST['txt_cantidad_detalle_orden']);


$OrdenTrabajo = new OrdenTrabajo();
$OrdenTrabajo->setIdOrden($txt_id_orden);
$OrdenTrabajo->setDescripcionDetalle($txt_descripcion_detalle_orden);
$OrdenTrabajo->setTipoDetalle($cmb_tipo_detalle_orden);
$OrdenTrabajo->setValorUnitario($txt_valor_unitario_detalle);
$OrdenTrabajo->setCantidad($txt_cantidad_detalle_orden);

// if($txt_id_factura=="" || $txt_id_factura==" "){
//Si no tiene id de factura se debe crear nuevo factura
   if($OrdenTrabajo->crearDetalleOrden()){
      echo "1";
   }else{
     echo "2";
   }
// }else{
// //si tiene id se modifca
//   if($Factura->modificarFactura()){
//     echo "1";
//   }else{
//     echo "2";
//   }
//
// }


?>
