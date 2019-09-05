<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
// require_once './clases/Estado.php';
require_once './clases/Cliente.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

   <title>Cliente</title>
   <?php cargarHead(); ?>
   <script src="./js/script_cliente.js"></script>

</head>
<body>


  <?php cargarMenuPrincipal(); ?>
  <div class="container contenedor-principal" >

          <div class=" col-12">

              <div>
                <h4>Clientes</h4>
              </div>

              <div><hr></div>

              <div class="row">
                   <button type="button" onclick="limpiarFormularioCliente();" class="btn btn-info col-12 col-md-4" data-target="#modal_cliente" data-toggle="modal" name="button">Crear nuevo cliente</button>
                   <input onkeyup="listarCliente(this.value)" placeholder="Buscar Clientes" class="form-control col-12 col-md-4" type="text" name="txt_texto_buscar_cliente" id="txt_texto_buscar_cliente" value="">
              </div>

              <div><hr></div>

              <div class="container">
                   <div id="contenedor_listado_cliente" class="table-responsive"></div>
              </div>
          </div>

  </div>


  <!-- MODAL Producto-->
  <div class="modal fade" id="modal_cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_cliente" class="" action="javascript:crearCliente()" method="post">

               <div class="form-group card border-info" >

                    <div class="container">
                      <div class="row">
                          <div class="form-group col-8" >
                                 <label for="title" class="col-12 control-label">Rut:</label>
                                 <input type="text"  required class="form-control" name="txt_rut_cliente" id="txt_rut_cliente" value="">
                          </div>

                          <div class="form-group col-12 col-md-6" >
                            <label for="title" class="col-12 control-label">Nombre:</label>
                            <input type="text" class="form-control" name="txt_nombre" id="txt_nombre" value="">
                          </div>

                          <div class="form-group col-12 col-md-6" >
                            <label for="title" class="col-12 control-label">Direccion:</label>
                            <input type="text" class="form-control" name="txt_direccion" id="txt_direccion" value="">
                          </div>

                          <div class="form-group col-12 col-md-6" >
                            <label for="title" class="col-12 control-label">Comuna:</label>
                            <input type="text" class="form-control" name="txt_comuna" id="txt_comuna" value="">
                          </div>

                          <div class="form-group col-12 col-md-6" >
                            <label for="title" class="col-12 control-label">Giro:</label>
                            <input type="text" class="form-control" name="txt_giro" id="txt_giro" value="">
                          </div>

                          <div class="form-group col-12 col-md-6" >
                            <label for="title" class="col-12 control-label">Telefono:</label>
                            <input type="text" class="form-control" name="txt_telefono" id="txt_telefono" value="">
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
