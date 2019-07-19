<?php
require_once 'Conexion.php';

class TipoDetalle{

 private $id_tipo_detalle;
 private $descripcion_tipo_detalle;

 public function setTipoDetalle($parametro){
   $this->id_tipo_detalle  = $parametro;
 }
 public function setDescripcionTipoDetalle($parametro){
   $this->descripcion = $parametro;
 }

 public function obtenerTipoDetalle(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_tipo_detalle");
    return $resultado_consulta;
 }



}
 ?>
