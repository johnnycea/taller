<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Orden_trabajo.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
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
                  <h4>Orden de trabajo</h4>
                </div>

                <div><hr></div>

                <div class="container">
                    <div class="row">

                        <div id="" class="col-12 col-md-4 " >
                          <button type="button" onclick="limpiarFormularioOrden();" class="btn btn-block btn-info" data-target="#modal_orden" data-toggle="modal" name="button">Crear nueva Orden</button>
                        </div>
                        <div id="" class="col-12 col-md-4" >
                              <input placeholder="Buscar factura" onkeyup="listarOrden(this.value)" class="form-control" type="text" name="txt_buscar_orden" id="txt_buscar_orden" value="">
                        </div>

                    </div>
                </div>

                <div><hr></div>

                <div id='contenedor_listado_orden' class="table-responsive"></div>

            </div>
        </div>

  </div>



  <!-- MODAL ORDEN-->
  <div class="modal fade" id="modal_orden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Orden de trabajo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">



        <form id="formulario_modal_orden" class="" action="javascript:CrearOrden()" method="post">

           <!-- <input type="hidden" name="txt_id_orden" id="txt_id_orden" value=""> -->
           <div class="form-group col-4 col-md-12">
               <label for="title" class="control-label">N° Orden:</label>
               <input readonly value="" class="form-control col-6" type="text" id="txt_id_orden" name="txt_id_orden">
           </div>

           <div class=" ">
             <div class="modal-header">
               <h5 class="modal-title" id="myModalLabel">Cliente</h5>
             </div>

              <div class="row">
                         <div class="col-md-4" >
                             <label for="title" class="col-12 control-label">Rut:</label>
                            <input type="text" placeholder="Ej: 11222333-0" max="10" onkeyup="cargarInformacionClientes(this.value)" class="form-control" id="txt_rut_cliente" name="txt_rut_cliente">
                         </div>

                         <div class="col-md-4" >
                             <label for="title" class="col-12 control-label">Nombre:</label>
                            <input type="text" class="form-control" id="txt_nombre" name="txt_nombre">
                         </div>


                         <div class="col-md-4" >
                             <label for="title" class="col-12 control-label">Apellidos:</label>
                            <input type="text" class="form-control" id="txt_apellido" name="txt_apellido">
                         </div>

                         <div class="col-md-4" >
                           <label for="title" class="col-12 control-label">Calle:</label>
                           <input type="text" class="form-control" id="txt_calle" name="txt_calle">
                         </div>

                         <div class="col-md-4" >
                           <label for="title" class="col-12 control-label">Número:</label>
                           <input type="text" class="form-control" id="txt_numero" name="txt_numero">
                         </div>

                         <div class="col-md-4" >
                             <label for="title" class="col-12 control-label">Comuna:</label>
                            <input type="text" class="form-control" id="txt_comuna" name="txt_comuna">
                         </div>
                         <div class="col-md-4" >
                             <label for="title" class="col-12 control-label">Giro:</label>
                            <input type="text" class="form-control" id="txt_giro" name="txt_giro">
                         </div>
                         <div class="col-md-4" >
                             <label for="title" class="col-12 control-label">Telefono:</label>
                            <input type="text" class="form-control" id="txt_telefono" name="txt_telefono">
                         </div>

             </div>


              <div><hr></div>

              <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Vehiculo</h5>
              </div>

               <div class="form-group col-12" >

                      <label for="title" class="col-12 control-label">Patente:</label>
                      <input type="text"  required class="form-control" onkeyup="cargarVehiculo(this.value)" name="txt_patente" id="txt_patente" value="">
               </div>

               <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Marca:</label>
                       <input type="text" required class="form-control" name="txt_marca" id="txt_marca" value="">

               </div>
               <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Modelo:</label>
                       <input type="text" required class="form-control" name="txt_modelo" id="txt_modelo" value="">

               </div>
               <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Año:</label>
                       <input type="text" required class="form-control" name="txt_anio" id="txt_anio" value="">

               </div>

          </div>

                <div class="form-group" >
                  <div class="col-12">
                    <button class="btn btn-success btn-block" type="submit" name="button">Guardar</button>
                  </div>
                </div>


        </form>
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
