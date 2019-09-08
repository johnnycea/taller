<?php
require_once 'Conexion.php';

class OrdenTrabajo{

 private $id_orden;
 private $descripcion_diagnostico;
 private $kilometraje;
 private $patente;
 private $rut_cliente;
 private $fecha_recepcion;
 private $id_estado;
 private $id_tipo_facturacion;
 private $iva_venta;
 private $porcentaje_descuento;
 private $usuario_creador;
 private $trabajador;
 private $fecha_pago;
 private $fecha_entrega;
 private $fecha_facturacion;
 private $tipo_pago;

 // detalle OrdenTrabajo

 private $id_detalle;
 private $descripcion;
 private $cantidad;
 private $valor_unitario;
 private $valor_total;
 private $tipo_detalle;
 private $usuarioCreadorDetalle;

//set Orden de trabajo
 public function setIdOrden($id_orden){
   $this->id_orden = $id_orden;
 }
 public function setDescripcionDiagnostico($descripcion_diagnostico){
   $this->descripcion_diagnostico = $descripcion_diagnostico;
 }
 public function setKilometraje($kilometraje){
   $this->kilometraje = $kilometraje;
 }
 public function setPatente($patente){
   $this->patente = $patente;
 }
 public function setRutCliente($rutCliente){
   $this->rut_cliente = $rutCliente;
 }
 public function setfechaRecepcion($recepcion){
   $this->recepcion = $recepcion;
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
 public function setTrabajador($parametro){
   $this->trabajador = $parametro;
 }
 public function setFechaPago($parametro){
   $this->fecha_pago = $parametro;
 }
 public function setFechaEntrega($parametro){
   $this->fecha_entrega = $parametro;
 }
 public function setFechaFacturacion($parametro){
   $this->fecha_facturacion = $parametro;
 }
 public function setTipoPago($parametro){
   $this->tipo_pago = $parametro;
 }

// set Detalle Orden de trabajo
 public function setIdDetalle($parametro){
   $this->id_detalle = $parametro;
 }
 public function setDescripcionDetalle($parametro){
   $this->descripcion_detalle = $parametro;
 }
 public function setCantidad($parametro){
   $this->cantidad = $parametro;
 }
 public function setValorUnitario($parametro){
   $this->valor_unitario = $parametro;
 }
 public function setValorTotal($parametro){
   $this->valor_total = $parametro;
 }
 public function setTipoDetalle($parametro){
   $this->tipo_detalle = $parametro;
 }
 public function consultarUltimaOrdenPendiente(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_orden_trabajo where id_estado = 1 order by fecha_recepcion desc limit 1");
    return $resultado_consulta;
 }

 public function crearDetalleOrden(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();
   @session_start();
   $consulta = "insert INTO tb_detalle_orden (`id_orden`, `descripcion`, `cantidad`, `valor_unitario`, `tipo_detalle`, `usuario_creador`)
                  VALUES (".$this->id_orden.", '".$this->descripcion_detalle."',
                   ".$this->cantidad.", ".$this->valor_unitario.",".$this->tipo_detalle.", ".$_SESSION['run'].")";
   // echo $consulta;
   $resultado= $conexion->query($consulta);
   return $resultado;
 }

 public function vistaDetalleOrden(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $consulta ="select * from vista_detalle_orden where id_orden=".$this->id_orden;
    // echo $consulta;
    $resultado_consulta = $Conexion->query($consulta);
    return $resultado_consulta;
 }

 public function mostrarOrdenesTrabajo($cantidad_registros,$codigo,$fecha_inicio,$fecha_fin,$cliente,$patente,$estado,$trabajador){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $condiciones="";

    $condiciones = ($codigo!="") ? $condiciones." and (id_orden = ".$codigo.")" : $condiciones;
    $condiciones = ($fecha_inicio!="" and $fecha_fin!="") ? $condiciones." and (fecha_recepcion between '".$fecha_inicio." 00:00:00' and '".$fecha_fin." 23:59:59')" : $condiciones;
    $condiciones = ($cliente!="") ? $condiciones." and (cliente = ".$cliente.")" : $condiciones;
    $condiciones = ($patente!="") ? $condiciones." and (patente = '".$patente."')" : $condiciones;
    $condiciones = ($estado!="") ? $condiciones." and (id_estado = ".$estado.")" : $condiciones;
    $condiciones = ($trabajador!="") ? $condiciones." and (trabajador = ".$trabajador.")" : $condiciones;

    $cantidad_registros = ($cantidad_registros*30);
    $consulta ="select * from vista_orden where id_estado <> 1 and id_estado <> 5";

    if($condiciones!=""){
        $consulta = $consulta.$condiciones;
    }


     $consulta=$consulta." limit ".$cantidad_registros;

    // echo $consulta;
    $resultado_consulta = $Conexion->query($consulta);
    return $resultado_consulta;
 }

 public function obtenerOrdenTrabajo(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $consulta ="select * from tb_orden_trabajo where id_orden=".$this->id_orden;
    // echo $consulta;
    $resultado_consulta = $Conexion->query($consulta);
    return $resultado_consulta;
 }

 public function ObtenerCodigoNuevaOrden(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    @session_start();

    if($resultado = $Conexion->query("insert into tb_orden_trabajo(usuario_creador) values(".$_SESSION['run'].");")){

          $resultadoNuevoId = $Conexion->query("SELECT LAST_INSERT_ID() as id_creado");
          $resultadoNuevoId = $resultadoNuevoId->fetch_array();
          return $resultadoNuevoId['id_creado'];
      }else{
        echo "ERROR";
      }

 }

 public function actualizarDatosOrden(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $adicionales = "";

   if($this->patente!=""){
       $adicionales = $adicionales." patente='".$this->patente."', ";
   }
   if($this->rut_cliente!=""){
       $adicionales = $adicionales." rut_cliente=".$this->rut_cliente.", ";
   }

   $consulta = "update tb_orden_trabajo SET ".$adicionales."
               `descripcion_diagnostico` = '".$this->descripcion_diagnostico."',
               `kilometraje` = ".$this->kilometraje.",
               `rut_trabajador` = ".$this->trabajador.",
               `tipo_pago` = ".$this->tipo_pago."
               WHERE (`id_orden` = '".$this->id_orden."');";

   $resultado= $conexion->query($consulta);
   // echo $consulta;
   return $resultado;
 }

 public function cambiarEstadoOrden(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "update tb_orden_trabajo SET
                id_estado=".$this->id_estado.",
                fecha_pago='".$this->fecha_pago."',
                fecha_entrega='".$this->fecha_entrega."',
                fecha_facturacion='".$this->fecha_facturacion."'
                WHERE (`id_orden` = '".$this->id_orden."');";
   $resultado= $conexion->query($consulta);
   // echo $consulta;
   return $resultado;
 }

 public function cambiarIva(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "update tb_orden_trabajo SET
                iva_venta=".$this->iva_venta."
                WHERE (`id_orden` = '".$this->id_orden."');";

   $resultado= $conexion->query($consulta);
   // echo $consulta;
   return $resultado;
 }


   public function eliminarDetalleOrden(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     $consulta = "delete from tb_detalle_orden where (`id_detalle` = ".$this->id_detalle.") and (`id_orden` = ".$this->id_orden.")";
     // echo $consulta;
     if($Conexion->query($consulta)){
         return true;
     }else{
         echo $consulta;
         // return false;
     }

   }
   public function consultarExisteDetalleOrden(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();
     $consulta = "select id_orden from tb_detalle_orden where id_orden =".$this->id_orden;
     // echo $consulta;
     $resultado_consulta = $Conexion->query($consulta);
     return $resultado_consulta;

   }

   public function eliminarOrdenTrabajo($tipo){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();
     $consulta;
     if($tipo==1){

       $consulta = "update tb_orden_trabajo SET `id_estado` = '5' WHERE (`id_orden` = ".$this->id_orden.");";
     }else{
       $consulta = "delete from tb_orden_trabajo WHERE (`id_orden` = ".$this->id_orden.");";

     }

     // update tb_orden_trabajo SET `id_estado` = '5' WHERE (`id_orden` = '17');

     // echo $consulta;
     if($Conexion->query($consulta)){
         return true;
     }else{
         echo $consulta;
         // return false;
     }

   }

 }
 ?>
