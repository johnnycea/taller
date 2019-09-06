<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

   <title>Informes</title>
   <?php cargarHead(); ?>

   <script src="./js/script_informes.js"></script>

</head>
<body>

  <?php cargarMenuPrincipal(); ?>


  <div><hr></div>

  <div class="container contenedor-principal" >
    <div class="row">

        <div class="col-12 col-md-3 ">
            <div class="card ">
              <div class="card-header bg-dark text-white">
                  <label class="card-title bold">Informes</label>
              </div>
              <div class="card-body">
                <form class="" id="formulario_informe" action="javascript:generarInforme()">

                  <div class="row">


                       <div class="form-group col-12">
                          <label for="title" class="col-12 control-label">Desde la fecha:</label>
                           <input type="date" value="" required class="form-control"  placeholder="Seleccionar fecha" name="txt_fecha_inicio">
                       </div>

                       <div class="form-group col-12">
                          <label for="title" class="col-12 control-label">Hasta la fecha:</label>
                          <input type="date" value=""  required class="form-control"  placeholder="Seleccionar fecha" name="txt_fecha_fin">
                       </div>

                       <div class="form-group col-12">
                          <label for="title" class="col-12 control-label">Tipo Informe:</label>
                          <select class="form-control" onchange="mostrarOcultarOpciones(this.value)" name="select_tipo_informe" id="select_tipo_informe">
                            <option value="1">Ordenes Por Pagar</option>
                            <option value="3">Ordenes Facturadas</option>
                            <option value="2">Ingresos</option>
                          </select>
                       </div>

                       <div class="form-group col-12" id="contenedor_selector_cliente">
                          <label for="title" class="col-12 control-label">Cliente:</label>
                          <input type="text" value="" class="form-control"  placeholder="Rut Opcional" name="txt_rut_cliente" id="txt_rut_cliente">
                       </div>

                       <div class="form-group col-12">
                          <label for="title" class="col-12 control-label">&nbsp;</label>
                          <input type="submit"  class="btn btn-info btn-block" value="Generar">

                       </div>

                   </div>

                </form>
              </div>

            </div>
        </div>


          <div class="col-12 col-md-9 ">
              <div class="card ">
                <div class="card-header bg-dark text-white">
                    <label class="card-title bold">Resultado informe</label>
                </div>
                <div class="card-body">

                  <div id="contenedor_informe" class="table-responsive" ></div>

                </div>
              </div>
          </div>


   </div>
</div>


</body>
</html>
