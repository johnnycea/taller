<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Conexion.php';
require_once '../../clases/Vehiculo.php';

$Funciones = new Funciones();
$txt_patente = $Funciones->limpiarTexto($_REQUEST['txt_patente']);
$txt_marca = $Funciones->limpiarTexto($_REQUEST['txt_marca']);
$txt_modelo = $Funciones->limpiarTexto($_REQUEST['txt_modelo']);
$txt_anio = $Funciones->limpiarNumeroEntero($_REQUEST['txt_anio']);

// echo "Patente: " .$txt_patente;

$Vehiculo = new Vehiculo();
$Vehiculo->setPatente($txt_patente);
$Vehiculo->setMarca($txt_marca);
$Vehiculo->setModelo($txt_modelo);
$Vehiculo->setAnio($txt_anio);

$consultaExisteVehiculo = $Vehiculo->obtenerVehiculo();

if($consultaExisteVehiculo->num_rows==0){
// if($txt_patente=="" || $txt_patente==" "){
//Si no tiene id de marca se debe crear nuevo marca
   if($Vehiculo->crearVehiculo()){
      echo "1";
   }else{
     echo "2";
   }
}else{
//si tiene id se modifca
  if($Vehiculo->modificarVehiculo()){
    echo "1: modifica los datos";
  }else{
    echo "2";
  }

}


?>
