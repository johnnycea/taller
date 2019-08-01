<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Cliente.php';


$Funciones = new Funciones();
$texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

$posicionGuion = strpos($texto_buscar,'-');
$soloRut = substr($texto_buscar,0,$posicionGuion);


$Cliente = new Cliente();
$Cliente->setRutCliente($soloRut);
$listadoCliente = $Cliente->obtenerCliente();

$cliente_encontrado = array();

if($listadoCliente->num_rows != 0){

    while($filas = $listadoCliente->fetch_array()){
       $cliente_encontrado['nombre'] = $filas['nombre'];
       $cliente_encontrado['direccion'] = $filas['direccion'];
       $cliente_encontrado['comuna'] = $filas['comuna'];
       $cliente_encontrado['giro'] = $filas['giro'];
       $cliente_encontrado['telefono'] = $filas['telefono'];
    }

}else{
  $cliente_encontrado['nombre'] = "hay que crear";
  $cliente_encontrado['direccion'] = "hay que crear";
  $cliente_encontrado['comuna'] = "hay que crear";
  $cliente_encontrado['giro'] = "hay que crear";
  $cliente_encontrado['telefono'] = "hay que crear";
}


 echo json_encode($cliente_encontrado);

 ?>
