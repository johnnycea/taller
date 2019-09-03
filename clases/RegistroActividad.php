<?php
require_once 'Conexion.php';

class RegistroActividad{


 private $rut_usuario;
 private $nombre_usuario;
 private $accion;
 private $detalle_acccion;
 private $id_orden;


 public function setRutUsuario($parametro){
   $this->rut_usuario  = $parametro;
 }
 public function setNombreUsuario($parametro){
   $this->nombre_usuario  = $parametro;
 }
 public function setAccion($parametro){
   $this->accion  = $parametro;
 }
 public function setDetalleAccion($parametro){
   $this->detalle_accion  = $parametro;
 }
 public function setIdOrden($parametro){
   $this->id_orden  = $parametro;
 }



 public function guardarRegistroActividad(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("insert into tb_registro_actividad(accion,detalle_accion,rut_usuario,nombre_usuario,id_orden)
    values ('".$this->accion."','".$this->detalle_accion."',".$this->rut_usuario.",'".$this->nombre_usuario."',".$this->id_orden.");");
    return $resultado_consulta;
 }

 public function obtenerRegistroActividadOrden(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_registro_actividad where id_orden = ".$this->id_orden);
    // echo $resultado_consulta;
    return $resultado_consulta;
 }



}
 ?>
