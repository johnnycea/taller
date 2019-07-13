<?php
require_once 'Conexion.php';

class Trabajador{

 private $id_orden;
 private $rut_trabajador;

 public function setIdOrden($id_orden){
   $this->id_orden = $id_orden;
 }
 public function setRutTrabajador($rut_trabajador){
   $this->rut_trabajador = $rut_trabajador;
 }



 // function obtenerTrabajador($texto_buscar,$condiciones){
 //     $conexion = new Conexion();
 //     $conexion = $conexion->conectar();
 //
 //     if($texto_buscar=="" || $texto_buscar==" "){
 //       $consulta= "select * from tb_trabajadores_orden ".$condiciones."";
 //     }else{
 //       $consulta= "select * from tb_trabajadores_orden
 //                   where id_orden like '%".$texto_buscar."%'
 //                   or rut_trabajador like '%".$texto_buscar."%'";
 //     }
 //     $resultado= $conexion->query($consulta);
 //     if($resultado){
 //        return $resultado;
 //     }else{
 //       return false;
 //     }
 // }

 public function obtenerTrabajador(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_trabajadores_orden where rut_trabajador=".$this->rut_trabajador);
    return $resultado_consulta;
 }

 public function obtener_cmb_Trabajador(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_trabajadores_orden".$this->rut_trabajador);
    return $resultado_consulta;
 }

 public function crearProveedor(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert INTO tb_proveedores (`rut_proveedor`,`dv`,`razon_social`,`direccion`,`telefono`,`giro`,`correo`) VALUES ('".$this->rut_proveedor."', '".$this->dv."', '".$this->razon_social."', '".$this->direccion."', '".$this->telefono."', '".$this->giro."', '".$this->correo."')";
   $resultado= $conexion->query($consulta);
   return $resultado;
 }

   public function modificarProveedor(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="update tb_proveedores SET
       razon_social = '".$this->razon_social."',
       direccion = '".$this->direccion."',
       telefono = '".$this->telefono."',
       giro = '".$this->giro."',
       correo = '".$this->correo."'
        WHERE (rut_proveedor = '".$this->rut_proveedor."');";

       $resultado= $conexion->query($consulta);
       return $resultado;
   }

   public function eliminarProveedor(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     //CONSULTA SI EL PROVEEDOR TIENE FACTURAS EN EL SISTEMA
     $consultaFacturasProveedor = $Conexion->query("select * from tb_facturas where id_proveedor=".$this->rut_proveedor);
     if($consultaFacturasProveedor->num_rows==0){
       //entra si el proveedor no tiene facturas, por lo tanto se elimina
           if($Conexion->query("DELETE FROM tb_proveedores where rut_proveedor=".$this->rut_proveedor)){
               return true;
           }else{
               return false;
           }
     }else{
       //entra si el proveedor SI TIENE facturas, SE CAMBIA ESTADO A "ELIMINADO"
           if($Conexion->query("Update tb_proveedores set estado_proveedor=3 where rut_proveedor=".$this->rut_proveedor)){
               return true;
           }else{
               return false;
           }
     }

   }


}
 ?>
