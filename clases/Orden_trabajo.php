<?php
require_once 'Conexion.php';

class Orden_trabajo{

 private $id_orden;
 private $descripcion_diagnostico;
 private $patente;
 private $rut_cliente;
 private $fecha_recepcion;
 private $fecha_entrega;
 private $id_estado;
 private $id_tipo_facturacion;
 private $iva_venta;
 private $porcentaje_descuento;
 private $usuario_creador;

 public function setIdOrden($id_orden){
   $this->id_orden = $id_orden;
 }
 public function setDescripcionDiagnostico($descripcion_diagnostico){
   $this->descripcion_diagnostico = $descripcion_diagnostico;
 }
 public function setPatente($patente){
   $this->patente = $patente;
 }
 public function setRutCliente($rutCliente){
   $this->rutCliente = $rutCliente;
 }
 public function setfechaRecepcion($recepcion){
   $this->recepcion = $recepcion;
 }
 public function setfechaEntrega($entrega){
   $this->entrega = $entrega;
 }
 public function setIdEstado($id_estado){
   $this->id_estado = $id_estado;
 }
 public function setIdTipoFacturacion($id_tipo_facturacion){
   $this->id_tipo_facturacion = $id_tipo_facturacion;
 }
 public function setIva($iva_venta){
   $this->iva_venta = $iva_venta;
 }
 public function setPorcentajeDescuento($porcentaje_descuento){
   $this->porcentaje_descuento = $porcentaje_descuento;
 }
 public function setUsuarioCreador($usuario_creador){
   $this->usuario_creador = $usuario_creador;
 }

 public function consultarUltimaOrdenPendiente(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_orden_trabajo where id_estado = 1 order by fecha desc limit 1");
    return $resultado_consulta;
 }

 function obtenerPedido($texto_buscar,$condiciones){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

     if($texto_buscar=="" || $texto_buscar==" "){
       $consulta= "select * from tb_pedidos ".$condiciones."";
     }else{
       $consulta= "select * from tb_pedidos
                   where id_pedido like '%".$texto_buscar."%'
                   or id_venta like '%".$texto_buscar."%'
                   or rut_cliente like '%".$texto_buscar."%'
                   or estado_pedido like '%".$texto_buscar."%'
                   or id_usuario_repartidor like '%".$texto_buscar."%'";
     }
     $resultado= $conexion->query($consulta);
     if($resultado){
        return $resultado;
     }else{
       return false;
     }
 }

 public function crearPedido(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("insert into tb_pedidos(id_venta,id_usuario_repartidor) values(".$this->id_venta.",".$this->repartidor.");");
    return $resultado_consulta;
 }
 public function obtenerPedidos(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from vista_pedidos");
    // echo $resultado_consulta;
    return $resultado_consulta;
 }

 public function obtener_cmb_Proveedor(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_proveedores".$this->rut_proveedor);
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
