<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Usuario.php';

$Funciones = new Funciones();

$rut = $Funciones->limpiarNumeroEntero($_REQUEST['txt_rut_usuario']);
$dv = $_REQUEST['txt_dv_usuario'];
$nombre = $Funciones->limpiarTexto($_REQUEST['txt_nombre_usuario']);
$correo = $Funciones->limpiarTexto($_REQUEST['txt_correo_usuario']);

$estado = $Funciones->limpiarTexto($_REQUEST['select_estado_usuario']);
$privilegio = $Funciones->limpiarTexto($_REQUEST['select_privilegio_usuario']);

$clave;

if($privilegio==3){
  $clave = "";
}else{
  $clave = $Funciones->limpiarTexto($_REQUEST['txt_contrasenia_usuario']);
}

$Usuario = new Usuario();
$Usuario->setRun($rut);
$Usuario->setDv($dv);
$Usuario->setNombre($nombre);
$Usuario->setCorreo($correo);
$Usuario->setEstado($estado);
$Usuario->setPrivilegio($privilegio);
$Usuario->setClave($clave);

if($Usuario->crearUsuario()){
   echo "1";

   //registro de actividad
   @session_start();
   $registro = new RegistroActividad();
   $registro->setRutUsuario($_SESSION['run']);
   $registro->setNombreUsuario($_SESSION['nombre']);
   $registro->setAccion("Crea Usuario");
   $registro->setDetalleAccion('Crea al Usuario: '.$rut."; ".$nombre);
   $registro->setIdOrden(0);
   $registro->guardarRegistroActividad();
   //fin registro actividad

}else{
   echo "2";
}

 ?>
