<?php
require_once 'Conexion.php';

class Vehiculo{

 private $patente;
 private $marca;
 private $modelo;
 private $anio;

 public function setPatente($parametro){
   $this->patente = $parametro;
 }
 public function setMarca($parametro){
   $this->marca = $parametro;
 }
 public function setModelo($parametro){
   $this->modelo = $parametro;
 }
 public function setAnio($parametro){
   $this->anio = $parametro;
 }

 function obtenerVehiculos(){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

       $consulta= "select * from tb_vehiculos";

     $resultado= $conexion->query($consulta);
     if($resultado){
        return $resultado;
     }else{
       return false;
     }
 }
 function obtenerVehiculo(){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

       $consulta= "select * from tb_vehiculos where patente='".$this->patente."'";
       // echo $consulta;
       // $resultado_consulta = $Conexion->query("select * from tb_productos where id_producto=".$this->id_producto);
     $resultado= $conexion->query($consulta);
     if($resultado){
        return $resultado;
     }else{
       return false;
     }
 }

 public function crearVehiculo(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert into tb_vehiculos (`patente`, `marca`, `modelo`, `anio`) VALUES ('".$this->patente."', '".$this->marca."', '".$this->modelo."', '".$this->anio."')";
   // echo $consulta;
   $resultado= $conexion->query($consulta);
   return $resultado;
 }

   public function modificarVehiculo(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="update tb_vehiculos SET
       marca = '".$this->marca."',
       modelo = '".$this->modelo."',
       anio = '".$this->anio."'
        WHERE (patente = '".$this->patente."')";

       $resultado= $conexion->query($consulta);
       return $resultado;
   }

   public function eliminarVehiculo(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     $consulta = "delete from tb_vehiculos where patente='".$this->patente."'";

     if($Conexion->query($consulta)){
         return true;
     }else{
         // echo $consulta;
         return false;
     }

   }


}
 ?>
