<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Vehiculo.php';


$Funciones = new Funciones();
$txt_patente = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);



$Vehiculo = new Vehiculo();
$Vehiculo->setPatente($txt_patente);
$listadoVehiculo = $Vehiculo->obtenerVehiculo();


$vehiculo_encontrado = array();

  while($filas = $listadoVehiculo->fetch_array()){
     $vehiculo_encontrado['marca'] = $filas['marca'];
     $vehiculo_encontrado['modelo'] = $filas['modelo'];
     $vehiculo_encontrado['anio'] = $filas['anio'];
   }


 echo json_encode($vehiculo_encontrado);


// echo '{"marca":"TOYOTA","modelo":"CORONA","anio":"1991"}';
 ?>
