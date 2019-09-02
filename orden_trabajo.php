<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/OrdenTrabajo.php';
require_once './clases/Trabajador.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();

$OrdenTrabajo = new OrdenTrabajo();
$numero_orden;

$consulta_orden = $OrdenTrabajo->consultarUltimaOrdenPendiente();

 if($consulta_orden->num_rows>0){
     //recibe el id de esa ORDEN
     $consulta_orden = $consulta_orden->fetch_array();
     $numero_orden = $consulta_orden['id_orden'];
 }
 else{
  $numero_orden = $OrdenTrabajo->ObtenerCodigoNuevaOrden();
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>

<style>


</style>
   <title>Orden de trabajo</title>
   <?php cargarHead(); ?>

  <script src="./js/script_orden_trabajo.js"></script>

</head>
<body>

  <?php cargarMenuPrincipal(); ?>


  <div class="container contenedor-principal" >

       <div class="row">

          <div class="col-3">

                <div class="container">

                  <div class="card bg-dark text-white">
                      <div class="card-header">
                        <h5><i class="fas fa-file-alt"></i> Buscar Ordenes</h5>
                      </div>
                      <div class="card-body fondo_gris">

                          <div class="row">

                            <form id="formulario_buscar_ordenes" name="formulario_buscar_ordenes" method="post">

                                 <div class="col-12" >
                                     <label for="title" class="col-12 control-label">Codigo:</label>
                                    <input type="text" class="form-control form-control-sm" onchange="listarOrden()" id="txt_codigo_orden_buscar" name="txt_codigo_orden_buscar">
                                 </div>
                                 <div class="col-12" >
                                     <label for="title" class="col-12 control-label">Desde la fecha:</label>
                                    <input type="date" class="form-control form-control-sm" onchange="listarOrden()" id="txt_fecha_inicio_buscar" name="txt_fecha_inicio_buscar">
                                 </div>
                                 <div class="col-12" >
                                     <label for="title" class="col-12 control-label">Hasta la fecha:</label>
                                     <input type="date" class="form-control form-control-sm" onchange="listarOrden()" id="txt_fecha_fin_buscar" name="txt_fecha_fin_buscar">
                                 </div>
                                 <div class="col-12" >
                                   <label for="title" class="col-12 control-label">Cliente:</label>
                                   <input type="text" class="form-control form-control-sm" placeholder="Rut Cliente" onchange="listarOrden()" id="txt_rut_cliente_buscar" name="txt_rut_cliente_buscar">
                                 </div>
                                 <div class="col-12" >
                                   <label for="title" class="col-12 control-label">Patente:</label>
                                   <input type="text" class="form-control form-control-sm" onchange="listarOrden()" id="txt_patente_buscar" name="txt_patente_buscar">
                                 </div>
                                 <div class="col-12" >
                                   <label for="title" class="col-12 control-label">Estado:</label>
                                   <select class="form-control form-control-sm" onchange="listarOrden()" id="txt_estado_orden_buscar" name="txt_estado_orden_buscar">
                                      <option value="">Todas</option>
                                      <option value="2">En proceso</option>
                                      <option value="3">Por pagar</option>
                                      <option value="4">Pagado</option>
                                   </select>
                                 </div>
                                 <div class="col-12" >
                                   <label for="title" class="col-12 control-label">Trabajador:</label>
                                   <select class="form-control form-control-sm" onchange="listarOrden()"  id="txt_rut_trabajador_buscar" name="txt_rut_trabajador_buscar">
                                      <option value="">Todos</option>
                                      <?php
                                          require_once './clases/Usuario.php';
                                          $trabajadores= new Usuario();
                                          $filasTrabajadores= $trabajadores->obtener_Trabajadores();

                                          foreach($filasTrabajadores as $trabajador){
                                              echo '<option value="'.$trabajador['rut'].'" >'.$trabajador['nombre'].'</option>';
                                          }
                                       ?>
                                   </select>
                                 </div>

                             </form>

                          </div>

                      </div>
                    </div><!-- cierre de card general de busqueda-->
                </div>


            </div>

            <div class="col-9">
              <div class="card bg-dark text-white">
                  <div class="card-header">
                    <div class="row">

                      <div class="col-9">
                        <h5><i class="fas fa-file-alt"></i> Ordenes de Trabajo</h5>
                      </div>
                      <div class="col-3 " >
                        <button type="button" onclick="boton_nueva_orden()" class="btn btn-block btn-info" data-target="#modal_orden" data-toggle="modal" id="btn_nueva_orden">Crear nueva Orden</button>
                      </div>

                    </div>
                  </div>
                  <div class="card-body fondo_gris">

                     <div id='contenedor_listado_orden' class="table-responsive"></div>

                  </div>
              </div>
            </div>

        </div>

  </div>

<style>

.fondo_gris{
  background: #656565;
}
.fondo_negro{
  background: #000000;
}
</style>

  <!-- MODAL ORDEN-->
  <div class="modal fade " id="modal_orden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" >
    <div class="modal-content fondo_negro">

      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="myModalLabel">Orden de trabajo N° <span id="span_codigo_orden"><?php echo $numero_orden; ?> </span></h4></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">



           <div class="row">

              <div class="col-5">

                  <div class="card bg-dark text-white">
                      <div class="card-header">
                        <h5><i class="fas fa-user"></i> Cliente</h5>
                      </div>
                      <div class="card-body fondo_gris">

                        <form id="formulario_modal_cliente" class="" action="javascript:crearCliente()" method="post">

                                <div class="row">

                                     <div class="col-md-6" >
                                         <label for="title" class="col-12 control-label">Rut:</label>
                                        <input type="text" class="form-control form-control-sm"  placeholder="11222333-0" max="10" onblur="guardarDatosOrden()" onchange="cargarInformacionClientes(this.value)" id="txt_rut_cliente" name="txt_rut_cliente">
                                     </div>

                                     <div class="col-md-6" >
                                         <label for="title" class="col-12 control-label">Nombre:</label>
                                        <input type="text" onblur="guardarDatosCliente()" class="form-control form-control-sm" id="txt_nombre" name="txt_nombre">
                                     </div>
            <!--
                                     <div class="col-md-12" >
                                         <label for="title" class="col-12 control-label">Apellidos:</label>
                                        <input type="text" class="form-control form-control-sm" id="txt_apellido" name="txt_apellido">
                                     </div> -->

                                     <div class="col-md-6" >
                                         <label for="title" class="col-12 control-label">Telefono:</label>
                                        <input type="text" onblur="guardarDatosCliente()" class="form-control form-control-sm" id="txt_telefono" name="txt_telefono">
                                     </div>

                                     <div class="col-md-6" >
                                         <label for="title" class="col-12 control-label">Comuna:</label>
                                        <input type="text" onblur="guardarDatosCliente()" class="form-control form-control-sm" id="txt_comuna" name="txt_comuna">
                                     </div>

                                     <div class="col-md-12" >
                                       <label for="title" class="col-12 control-label">Direccion:</label>
                                       <input type="text" onblur="guardarDatosCliente()" class="form-control form-control-sm" id="txt_direccion" name="txt_direccion">
                                     </div>

                                     <!-- <div class="col-md-12" >
                                       <label for="title" class="col-12 control-label">Número:</label>
                                       <input type="text" class="form-control form-control-sm" id="txt_numero" name="txt_numero">
                                     </div> -->

                                     <div class="col-md-12" >
                                         <label for="title" class="col-12 control-label">Giro:</label>
                                        <input type="text" onblur="guardarDatosCliente()" class="form-control form-control-sm" id="txt_giro" name="txt_giro">
                                     </div>

                                </div>
                              </form>
                        </div>
                   </div>

             </div>

              <div class="col-3">

                      <div class="card bg-dark text-white">
                            <div class="card-header">
                              <h5><i class="fas fa-car"></i> Vehiculo</h5>
                            </div>
                            <div class="card-body fondo_gris">

                                  <div class="row">
                                      <div class=" col-md-12" >
                                        <label for="title" class="col-12 control-label">Patente:</label>
                                        <input type="text"  required class="form-control form-control-sm" onblur="guardarDatosOrden()"  onkeyup="cargarVehiculo(this.value)" name="txt_patente" id="txt_patente" value="">
                                      </div>

                                      <div class=" col-md-12" >
                                        <label for="title" class="col-12 control-label">Marca:</label>
                                        <input type="text" onblur="guardarDatosVehiculo()"  class="form-control form-control-sm" name="txt_marca" id="txt_marca" value="">
                                      </div>

                                      <div class=" col-md-12" >
                                        <label for="title" class="col-12 control-label">Modelo:</label>
                                        <input type="text" onblur="guardarDatosVehiculo()"  class="form-control form-control-sm" name="txt_modelo" id="txt_modelo" value="">
                                      </div>

                                      <div class=" col-md-12" >
                                        <label for="title" class="col-12 control-label">Año:</label>
                                        <input type="number" onblur="guardarDatosVehiculo()"  class="form-control form-control-sm" name="txt_anio" id="txt_anio" value="">
                                      </div>

                                  </div>
                             </div>
                        </div>

                </div>


                  <div class="col-4">

                          <div  class="card bg-dark text-white">
                                <div class="card-header">
                                  <h5><i class="fas fa-file-alt"></i> Ingreso</h5>
                                </div>
                                <div class="card-body fondo_gris">

                                      <div class="row">
                                            <div class=" col-12" >
                                              <label for="title" class="col-12 control-label">Diagnostico:</label>
                                              <!-- <input type="text" onblur="guardarDatosOrden()" required class="form-control" name="txt_descripcion" id="txt_descripcion" value=""> -->
                                              <textarea type="text" rows="4" onblur="guardarDatosOrden()" required class="form-control form-control-sm" name="txt_descripcion" id="txt_descripcion" value=""></textarea>
                                            </div>

                                            <div class=" col-12" >
                                              <label for="title" class="col-12 control-label">Kilometraje:</label>
                                              <input type="number" onblur="guardarDatosOrden()" required class="form-control form-control-sm" name="txt_kilometraje" id="txt_kilometraje" value="">
                                            </div>

                                            <div class=" col-12" >
                                              <label for="estado">Realizado por:</label>
                                                   <select onChange="guardarDatosOrden()" class="form-control form-control-sm" required name="cmb_trabajador" id="cmb_trabajador">
                                                     <option value="" selected disabled>Trabajador:</option>
                                                      <?php
                                                          require_once './clases/Usuario.php';
                                                          $trabajadores= new Usuario();
                                                          $filasTrabajadores= $trabajadores->obtener_Trabajadores();

                                                          foreach($filasTrabajadores as $tipo){
                                                              echo '<option value="'.$tipo['rut'].'" >'.$tipo['nombre'].'</option>';
                                                          }
                                                       ?>
                                                  </select>
                                            </div>

                                      </div>

                                 </div>
                            </div>

                      </div>


                      <div class="col-12">

                              <div style="margin-top:10px;" class="card bg-dark text-white">
                                    <div class="card-header">
                                      <h5><i class="far fa-list-alt"></i> Detalle Orden de Trabajo</h5>
                                    </div>
                                    <div class="card-body fondo_gris">

                                          <div class="row">

                                              <div class="col-12">

                                                      <div class="card bg-dark text-white">
                                                            <!-- <div class="card-header">
                                                              <label><i class="fas fa-plus"></i> Detalle</label>
                                                            </div> -->
                                                            <div class="card-body fondo_negro">

                                                              <form id="formulario_modal_detalle_orden" class="" action="javascript:crearDetalleOrden()" method="post">
                                                                  <div class="row">


                                                                          <input type="hidden" id="txt_id_orden" name="txt_id_orden" value="<?php echo $numero_orden; ?>">

                                                                          <div class=" col-md-12" >
                                                                            <label for="title" class="col-12 control-label">Detalle:</label>
                                                                            <input type="text"  required class="form-control form-control-sm" name="txt_descripcion_detalle_orden" id="txt_descripcion_detalle_orden" value="">
                                                                          </div>

                                                                          <div class=" col-md-4" >
                                                                             <label for="title" class="col-12 control-label">Tipo:</label>
                                                                                 <select onChange="guardarDatosOrden()" class="form-control form-control-sm" required name="cmb_tipo_detalle_orden" id="cmb_tipo_detalle_orden">
                                                                                   <option value="" selected disabled>Tipo Detalle:</option>
                                                                                    <?php
                                                                                        require_once './clases/TipoDetalle.php';
                                                                                        $tipo_detalle= new TipoDetalle();
                                                                                        $filasTipoDetalle= $tipo_detalle->obtenerTipoDetalle();

                                                                                        foreach($filasTipoDetalle as $tipo){
                                                                                            echo '<option value="'.$tipo['id_tipo_detalle'].'" >'.$tipo['descripcion_tipo_detalle'].'</option>';
                                                                                        }
                                                                                     ?>
                                                                                </select>
                                                                          </div>

                                                                          <div class=" col-md-3" >
                                                                            <label for="title" class="col-12 control-label">Valor:</label>
                                                                            <input type="number"  required class="form-control form-control-sm" name="txt_valor_unitario_detalle" id="txt_valor_unitario_detalle" value="0">
                                                                          </div>

                                                                          <div class=" col-md-3" >
                                                                            <label for="title" class="col-12 control-label">Cantidad:</label>
                                                                            <input type="number"  required class="form-control form-control-sm" name="txt_cantidad_detalle_orden" id="txt_cantidad_detalle_orden" value="0">
                                                                          </div>

                                                                          <div class=" col-md-2" >
                                                                            <label for="title" class="col-12 control-label">&nbsp;</label>
                                                                            <button class="btn btn-success btn-block btn-sm" style="font-size:20px; padding:0px;"><i class="far fa-save"></i></button>
                                                                          </div>

                                                                  </div>
                                                                  </form>
                                                             </div>
                                                        </div>

                                                </div>


                                              <div class="col-12">

                                                <div><hr></div>

                                                  <div id='contenedor_detalle_orden' class="table-responsive"></div>

                                                <div><hr></div>

                                                </div>


                                                <div class="col-12">
                                                  <button type="button" id="btn_confirmar_orden" onclick="cambiarEstadoOrden(2)" class="btn btn-success col-12 btn-block"><i class="fas fa-check-circle"></i> Guardar Orden</button>
                                                </div>

                                                <div class="col-12 ">

                                                  <div id="contenedor_opciones_orden" class="card bg-dark text-white d-none">
                                                        <div class="card-header">
                                                          <h5><i class="fas fa-file-alt"></i> Opciones</h5>
                                                        </div>
                                                        <div class="card-body fondo_gris">

                                                            <div class="row">

                                                                    <div class="col-md-6">
                                                                        <div class="col-12">
                                                                          <label for="estado">Estado de Orden:</label>
                                                                          <select class="form-control" onchange="cambiarEstadoOrden(this.value)" id="select_estado_orden" name="select_estado_orden">
                                                                            <option value="2">En Proceso</option>
                                                                            <option value="3">Pendiente de Pago</option>
                                                                            <option value="4">Pagada</option>
                                                                          </select>
                                                                        </div>

                                                                        <div id="contenedor_fecha_entrega" class="col-12">
                                                                          <label for="estado">Fecha de Entrega:</label>
                                                                          <input type="date" class="form-control" onblur="cambiarEstadoOrden(3)" name="txt_fecha_entrega" id="txt_fecha_entrega" value="">
                                                                        </div>

                                                                        <div id="contenedor_fecha_pago" class="col-12">
                                                                          <label for="estado">Fecha de Pago:</label>
                                                                          <input type="date" class="form-control" onblur="cambiarEstadoOrden(4)" name="txt_fecha_pago" id="txt_fecha_pago" value="">
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-6">
                                                                      <label for="estado">&nbsp;</label>
                                                                      <button type="button"  class="btn btn-success btn-block" id="btn_imprimir_orden" onclick="imprimeComprobante()" ><i class="fas fa-check-circle"></i> Imprimir</button>
                                                                    </div>

                                                            </div>

                                                         </div>
                                                    </div>


                                                </div>





                                          </div>
                                     </div>
                                </div>

                        </div>


      </div>

    </div>
    </div>
  </div>
<!-- FIN DE MODAL -->


<!-- <script type="text/javascript">
    listarFacturas("");
</script> -->

</body>
</html>
