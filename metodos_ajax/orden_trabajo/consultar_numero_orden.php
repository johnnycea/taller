<?php
require_once '../../clases/OrdenTrabajo.php';


$OrdenTrabajo = new OrdenTrabajo();
$numero_orden;

$consulta_orden = $OrdenTrabajo->consultarUltimaOrdenPendiente();

 if($consulta_orden->num_rows>0){
     //recibe el id de esa ORDEN
     $consulta_orden = $consulta_orden->fetch_array();
     $numero_orden = $consulta_orden['id_orden'];
 }
 else{
  $numero_orden = $OrdenTrabajo->ObtenerCodigoNuevaOrden();
 }


 echo $numero_orden;
?>
