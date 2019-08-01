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

       <div class="col-12">
          <div class="col-12">

                <div>
                  <h4>Ordenes de trabajo</h4>
                </div>

                <div><hr></div>

                <div class="container">
                    <div class="row">

                        <div id="" class="col-12 col-md-4 " >
                          <button type="button" onclick="" class="btn btn-block btn-info" data-target="#modal_orden" data-toggle="modal" name="button">Crear nueva Orden</button>
                        </div>
                        <div id="" class="col-12 col-md-4" >
                              <input placeholder="" onkeyup="listarOrden(this.value)" class="form-control" type="text" name="txt_buscar_orden" id="txt_buscar_orden" value="">
                        </div>

                    </div>
                </div>

                <div><hr></div>

                <div id='contenedor_listado_orden' class="table-responsive"></div>

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
        <h5 class="modal-title" id="myModalLabel">Orden de trabajo N° <span><?php echo $numero_orden; ?> </span></h4></h5>
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
                                        <input type="text" class="form-control form-control-sm"  placeholder="11222333-0" max="10" onkeyup="cargarInformacionClientes(this.value)" id="txt_rut_cliente" name="txt_rut_cliente">
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
                                        <input type="text"  required class="form-control form-control-sm" onkeyup="cargarVehiculo(this.value)" name="txt_patente" id="txt_patente" value="">
                                      </div>

                                      <div class=" col-md-12" >
                                        <label for="title" class="col-12 control-label">Marca:</label>
                                        <input type="text" required class="form-control form-control-sm" name="txt_marca" id="txt_marca" value="">
                                      </div>

                                      <div class=" col-md-12" >
                                        <label for="title" class="col-12 control-label">Modelo:</label>
                                        <input type="text" required class="form-control form-control-sm" name="txt_modelo" id="txt_modelo" value="">
                                      </div>

                                      <div class=" col-md-12" >
                                        <label for="title" class="col-12 control-label">Año:</label>
                                        <input type="number" required class="form-control form-control-sm" name="txt_anio" id="txt_anio" value="">
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
                                              <input type="text" onblur="guardarDatosOrden()" required class="form-control form-control-sm" name="txt_kilometraje" id="txt_kilometraje" value="">
                                            </div>

                                            <div class=" col-12" >
                                              <label for="estado">Realizado:</label>
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
                                                  <!-- <script type="text/javascript">

                                                  listarDetalleOrden();
                                                  </script> -->

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
