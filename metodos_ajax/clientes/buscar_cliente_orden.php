<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Cliente.php';


$Funciones = new Funciones();
$texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

$posicionGuion = strpos($texto_buscar,'-');
$soloRut = substr($texto_buscar,0,$posicionGuion);
$digito_verificador = substr($texto_buscar,$posicionGuion+1,$posicionGuion+2);


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
       $cliente_encontrado['quepaso'] = "lo_encontro";

    }

}else{
  $cliente_encontrado['nombre'] = "";
  $cliente_encontrado['direccion'] = "";
  $cliente_encontrado['comuna'] = "";
  $cliente_encontrado['giro'] = "";
  $cliente_encontrado['telefono'] = "";

  //AQUI HAY QUE CREAR LA FUNCION QUE AGREGUE EL CLIENTE EN BD SOLO CON SU RUT Y DV
  $conexion = new Conexion();
  $conexion = $conexion->conectar();

  if($conexion->query("insert into tb_clientes(rut_cliente, dv) values(".$soloRut.",".$digito_verificador.")")){
      $cliente_encontrado['quepaso'] = "se_agrego";
  }else{
      $cliente_encontrado['quepaso'] = "no_se_agrego";
  }

}


 echo json_encode($cliente_encontrado);

 ?>
