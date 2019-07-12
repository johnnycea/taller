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
$listadoCliente = $Cliente->obtenerClienteRegistrados();

$cliente_encontrado = array();

  while($filas = $listadoCliente->fetch_array()){
     $cliente_encontrado['nombre'] = $filas['nombre'];
     $cliente_encontrado['apellidos'] = $filas['apellidos'];
     $cliente_encontrado['calle'] = $filas['calle'];
     $cliente_encontrado['numero_calle'] = $filas['numero_calle'];
     $cliente_encontrado['comuna'] = $filas['comuna'];
     $cliente_encontrado['giro'] = $filas['giro'];
     $cliente_encontrado['telefono'] = $filas['telefono'];
  }


 echo json_encode($cliente_encontrado);

 ?>
