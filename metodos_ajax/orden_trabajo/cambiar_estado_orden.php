<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';
require_once '../../clases/RegistroActividad.php';

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

      //registro de actividad
      @session_start();
      $registro = new RegistroActividad();
      $registro->setRutUsuario($_SESSION['run']);
      $registro->setNombreUsuario($_SESSION['nombre']);
      if($nuevo_estado==2){
        $registro->setAccion("Ingresa Orden");
        $registro->setDetalleAccion('Cambia a "En Proceso"');
      }else if($nuevo_estado==3){
        $registro->setAccion("Modifica estado Orden");
        $registro->setDetalleAccion('Cambia a "Por Pagar"');
      }else if($nuevo_estado==3){
        $registro->setAccion("Modifica estado Orden");
        $registro->setDetalleAccion('Cambia a "Pagado"');
      }
      $registro->setIdOrden($txt_id_orden);
      $registro->guardarRegistroActividad();
      //fin registro actividad

   }else{
      echo "2";
   }



?>
