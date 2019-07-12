<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/Vehiculo.php';

$Funciones = new Funciones();

$txt_patente = $Funciones->limpiarTexto($_REQUEST['id']);

$Vehiculo = new Vehiculo();
$Vehiculo->setPatente($txt_patente);

  if($Vehiculo->eliminarVehiculo()){
     echo "1";
  }else{
     echo "2";
  }

?>
