<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
// require_once './clases/Estado.php';
require_once './clases/Vehiculo.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

   <title>Vehiculos</title>
   <?php cargarHead(); ?>
   <script src="./js/script_vehiculo.js"></script>

</head>
<body>


  <?php cargarMenuPrincipal(); ?>

  <div class="container contenedor-principal" >
      <div  style="" class=" col-12">

              <div>
                <h4>Vehiculo</h4>
              </div>

              <div><hr></div>

              <div class="row">
                   <button type="button" onclick="limpiarFormularioVehiculo();" class="btn btn-info col-12 col-md-4" data-target="#modal_vehiculo" data-toggle="modal" name="button">Crear nuevo vehiculo</button>
                   <input onkeyup="listarVehiculo(this.value)" class="form-control col-12 col-md-4" type="text" name="txt_buscar_vehiculo" id="txt_buscar_vehiculo" value="">
              </div>

              <div class="container">
                <div id='contenedor_listado_vehiculo' class="table-responsive"></div>
              </div>

      </div>
  </div>



  <!-- MODAL Producto-->
  <div class="modal fade" id="modal_vehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Vehiculo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_vehiculo" class="" action="javascript:CrearVehiculo()" method="post">

           <!-- <input type="hidden" name="txt_id_proveedor" id="txt_id_proveedor" value=""> -->

           <div class="form-group card border-info" >

                  <div class="container" >
                      <div class="row" >
                          <div class="form-group col-12 col-md-6" >

                                 <label for="title" class="col-12 control-label">Patente:</label>
                                 <input type="text" required class="form-control" name="txt_patente" id="txt_patente" value="">
                          </div>

                          <div class="form-group col-12 col-md-6" >

                                 <label for="title" class="col-12 control-label">Marca:</label>
                                 <input type="text" required class="form-control" name="txt_marca" id="txt_marca" value="">

                          </div>
                          <div class="form-group col-12 col-md-6" >

                                 <label for="title" class="col-12 control-label">Modelo:</label>
                                 <input type="text" required class="form-control" name="txt_modelo" id="txt_modelo" value="">

                          </div>
                          <div class="form-group col-12 col-md-6" >

                                 <label for="title" class="col-12 control-label">Año:</label>
                                 <input type="text" onkeypress="return soloNumeros(event);" required class="form-control" name="txt_anio" id="txt_anio" value="">

                          </div>
                      </div>
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


</body>
</html>
