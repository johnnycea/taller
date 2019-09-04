<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/RegistroActividad.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

   <title>Registro Actividad</title>
   <?php cargarHead(); ?>
   <script src="./js/script_registro_actividad.js"></script>

</head>
<body>


  <?php cargarMenuPrincipal(); ?>


  <div class="container contenedor-principal">
      <div class="row">

            <div class="col-12 col-md-3">
                <div class="card text-dark">
                  <div class="card-header bg-dark text-white">
                      OPCIONES
                  </div>
                  <div class="card-body">
                       <?php cargarMenuConfiguraciones(); ?>
                  </div>
                </div>
            </div>

             <div class="col-12 col-md-9">
                <div  style="" class=" card col-12">

                      <div class="container">
                           <br>
                           <!-- <button type="button" class="btn btn-success col-12 col-md-4" data-target="#modal_registro_actividad" data-toggle="modal" name="button">Crear nueva actividad</button> -->
                      </div>

                      <div class="container">
                            <br>
                            <div id='contenedor_listado_registro_actividad' class="table-responsive"></div>
                      </div>

                </div>
             </div>

      </div>
  </div>



  <!-- MODAL Registro-->
  <div class="modal fade" id="modal_registro_actividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_registro" class="" action="javascript:CrearRegistro()" method="post">

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
