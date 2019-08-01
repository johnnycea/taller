<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Cliente.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$txt_rut_cliente = $Funciones->limpiarTexto($_REQUEST['txt_rut_cliente']);
$txt_nombre = $Funciones->limpiarTexto($_REQUEST['txt_nombre']);
$txt_direccion = $Funciones->limpiarTexto($_REQUEST['txt_direccion']);
$txt_comuna= $Funciones->limpiarTexto($_REQUEST['txt_comuna']);
$txt_giro= $Funciones->limpiarTexto($_REQUEST['txt_giro']);
$txt_telefono = $Funciones->limpiarNumeroEntero($_REQUEST['txt_telefono']);

$posicionGuion = strpos($txt_rut_cliente,'-');
$soloRut = substr($txt_rut_cliente,0,$posicionGuion);
$digito_verificador = substr($txt_rut_cliente,$posicionGuion+1,$posicionGuion+2);


$Cliente = new Cliente();
$Cliente->setRutCliente($soloRut);
$Cliente->setDv($digito_verificador);
$Cliente->setNombre($txt_nombre);
$Cliente->setDireccion($txt_direccion);
$Cliente->setComuna($txt_comuna);
$Cliente->setGiro($txt_giro);
$Cliente->setTelefono($txt_telefono);

$consultaExisteCliente = $Cliente->obtenerCliente();
//
if($consultaExisteCliente->num_rows==0){
//Si no devuelve nada, se debe crear nuevo producto
   if($Cliente->crearCliente()){
      echo "1";
   }else{
      echo "2";
   }
}
else{
//si deveulve filas, el producto existe en bd, por lo tato se modifca
  if($Cliente->modificarCliente()){
    echo "1";
  }else{
    echo "2";
  }

 }


?>
