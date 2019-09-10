<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';
require_once '../../clases/Cliente.php';
require_once '../../clases/Vehiculo.php';
 ?>

 <?php

   $id_orden = $_REQUEST['id_orden'];

   $Orden = new OrdenTrabajo();
   $Orden->setIdOrden($id_orden);
   $consultaOrden = $Orden->obtenerOrdenTrabajo();

   $resultado_orden = $consultaOrden->fetch_array();
   $rut_cliente = $resultado_orden['rut_cliente'];
   $patente = $resultado_orden['patente'];
   $kilometraje = $resultado_orden['kilometraje'];

   $Cliente = new Cliente();
   $Cliente->setRutCliente($rut_cliente);
   $consultaCliente = $Cliente->obtenerCliente();

   $resultado_cliente = $consultaCliente->fetch_array();
   $nombre = $resultado_cliente['nombre'];
   $direccion = $resultado_cliente['direccion'];
   $comuna = $resultado_cliente['comuna'];
   $giro = $resultado_cliente['giro'];
   $telefono = $resultado_cliente['telefono'];

   $Vehiculo = new Vehiculo();
   $Vehiculo->setPatente($patente);
   $consultaVehiculo = $Vehiculo->obtenerVehiculo();

   $resultado_vehiculo = $consultaVehiculo->fetch_array();
   $marca = $resultado_vehiculo['marca'];
   $modelo = $resultado_vehiculo['modelo'];
   $anio = $resultado_vehiculo['anio'];
   // echo "vehiculo".$patente .$marca .$modelo .$anio;

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Orden de Trabajo</title>


    <style>
        @media print {
          @page {
            margin: 0;
          }
          body {
            margin: 2cm;
          }

          #logo{
              width: 200px;
              height: 100px;
              float:left;

           }
          #contenedor_texto{
              width: auto;
              height: 100px;
              float:left;
           }
          #contenedor_datos_orden{
              width: 50%;
              float:left;
           }
          #contenedor_clientes{
              width: 50%;
              float:left;
           }
          #contenedor_vehiculo{
              width: auto;
              height: 100px;
              float:left;
           }
          #contenedor_detalle_orden{
              width: 100%;
              float:left;
           }
          #tabla_detalle_orden{
              width: 100%;
              border-collapse: collapse;
           }
           .texto{
             display: block;
           }
           .contenedor_tabla{
             display: block;
           }
           #tabla_informe{
             width: 100%;
            border-collapse: collapse;
           }
           #tabla_resumen_detalle{
            border-collapse: collapse;
            float: right;
           }
           #tabla_cliente{
            border-collapse: collapse;
            float: right;
           }
           #tabla_patente{
            border-collapse: collapse;
            float: right;
            border-left-style: none;
            border-left-width: 0;
           }


        }

        #logo{
            width: 200px;
            height: 100px;
            float:left;

         }
         #contenedor_texto{
           margin-top: 20px;
             width: auto;
             height: 100px;
             float:left;
          }
          #contenedor_datos_orden{
              width: auto;
              height: 100px;
              float:right;
           }
           #contenedor_clientes{
               width: 50%;
               float:left;
            }
           #contenedor_vehiculo{
               width: 50%;
               float:left;
            }
           #contenedor_detalle_orden{
              margin-top:40px;
               width: 100%;
               float:left;
            }
          .texto{
            display: block;
          }
          .contenedor_tabla{
            display: block;
          }
          #tabla_informe{
            width: 100%;
            border-collapse: collapse;
          }

    </style>
</head>
<body>
  <img id="logo" src="../../img/logo-inguz.jpg" alt="">

  <div id="contenedor_texto">
    <label class="texto" for=""><strong>José Manuel Infante Poduje</strong></label>
    <label class="texto" for="">R.U.T: 7.816.171-K</label>
    <label class="texto" for="">Taller Electromecánico</label>
    <label class="texto" for="">Nueva Rancagua: N°0125</label>
    <label class="texto" for="">Fono: 713558 ANGOL</label>
  </div>

  <div id="contenedor_datos_orden">
    <label class="texto" for=""><strong>Órden de Trabajo</strong></label>
    <label class="texto" for=""><strong>N° <?php echo $id_orden; ?></strong></label>
  </div>



<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div id="contenedor_clientes">
    <table border="1"  id="tabla_cliente"  align="center"  width="100%">
      <caption>Cliente</caption>
      <tr>
        <td >
          <label for=""><strong>Rut Cliente: </strong></label>
          <label for=""><?php echo $rut_cliente; ?> </label>
          <br>
          <label for=""><strong>Nombre: </strong></label>
          <label for=""><?php echo $nombre; ?> </label>
          <br>

          <label for=""><strong>Teléfono: </strong></label>
          <label for=""><?php echo $telefono; ?> </label>
          <br>
          <label for=""><strong>Dirección: </strong></label>
          <label for=""><?php echo $direccion; ?> </label>
          <br>

          <label for=""><strong>Comuna: </strong></label>
          <label for=""><?php echo $comuna; ?> </label>
        </td>
      </tr>
  	</table>
</div>

<div id="contenedor_vehiculo">

  <table border="1" id="tabla_patente" width="100%">
        <caption>Vehiculo</caption>
        <tr >
          <td >
              <label for=""><strong>Patente: </strong></label>
              <label for=""><?php echo $patente; ?> </label>
              <br>
              <label for=""><strong>Marca: </strong></label>
              <label for=""><?php echo $marca; ?> </label>
              <br>
              <label for=""><strong>Modelo: </strong></label>
              <label for=""><?php echo $modelo ?> </label>
              <br>
              <label for=""><strong>Año: </strong></label>
              <label for=""><?php echo $anio ?> </label>
              <br>
              <label for=""><strong>Kilometraje: </strong></label>
              <label for=""><?php echo $kilometraje ?> </label>
              <br>
          </td>
        </tr>
    	</table>
</div>

<br>
<br>

<div id="contenedor_detalle_orden">

    <?php

    echo '<table border="1" id="tabla_detalle_orden">
      <thead >
        <th>Tipo</th>
        <th>Item</th>
        <th>Valor</th>
        <th>Total</th>
      </thead>
      <tbody>';

        $Funciones = new Funciones();

        $id_orden = $Funciones->limpiarNumeroEntero($_REQUEST['id_orden']);
       echo '<script> id_orden = '.$id_orden.'; </script>';

        $OrdenTrabajo = new OrdenTrabajo();
        $OrdenTrabajo->setIdOrden($id_orden);
        $listadoOrdenTrabajo = $OrdenTrabajo->vistaDetalleOrden();


        $total_mano_obra = 0;
        $total_repuestos = 0;
        $iva = 0;
        $checkbox_iva ="";
        $neto = 0;
        $total = 0;
          while($filas = $listadoOrdenTrabajo->fetch_array()){

                echo '<tr>
                        <td><span id="columna_tipo_detalle_" >'.$filas['tipo_detalle'].'</span></td>
                        <td><span id="columna_descripcion_detalle_'.$filas['id_detalle'].'">'.$filas['descripcion'].'</span></td>
                        
                        <td><span id="columna_valor_'.$filas['id_detalle'].'" >$'.number_format($filas['valor'],0,",",".").'</span></td>
                        <td><span id="columna_valor_total_'.$filas['id_detalle'].'" >$'.number_format($filas['valor_total'],0,",",".").'</span></td>
                     </tr>';

                     $total_mano_obra = ($filas['id_tipo_detalle']==1) ? $total_mano_obra+$filas['valor_total'] : $total_mano_obra;
                     $total_repuestos = ($filas['id_tipo_detalle']==2) ? $total_repuestos+$filas['valor_total'] : $total_repuestos;

                     $neto += $filas['valor_total'];
                     $checkbox_iva = $filas['iva_venta'];
          }

          echo '

           </tbody>
        </table>';

        $checkbox_iva = ($checkbox_iva=="19") ? "checked" : "";

        $iva = ($checkbox_iva=="checked") ? ($neto*0.19) : 0;
        $total = ($checkbox_iva=="checked") ? ($neto+$iva) : $neto;

    echo '


    <br>
    <br>

        <div class="row">
          <div class="col-md-4 offset-md-8">
            <table border="1" id="tabla_resumen_detalle">
              <tbody>

                  <tr class="">
                      <td colspan="4" ><strong>Mano de obra</strong></td>
                      <td><strong>$'.number_format($total_mano_obra,0,',','.').'</strong></td>
                  </tr>
                  <tr class="">
                      <td colspan="4" ><strong>Repuestos</strong></td>
                      <td><strong>$'.number_format($total_repuestos,0,',','.').'</strong></td>
                  </tr>
                  <tr class="">
                      <td colspan="4" ><strong>Sub total</strong></td>
                      <td><strong>$'.number_format($neto,0,',','.').'</strong></td>
                  </tr>
                  <tr class="">
                      <td colspan="4" >
                        <div class="form-check">
                          <label class="form-check-label" for="checkbox_iva">IVA</label>
                        </div>
                      </td>
                      <td><strong>$'.number_format($iva,0,',','.').'</strong></td>
                  </tr>
                  <tr class="bg-danger text-white">
                      <td colspan="4" ><strong>Total a pagar</strong></td>
                      <td><strong>$'.number_format($total,0,',','.').'</strong></td>
                  </tr>


              </tbody>
            </table>
          </div>
        </div>';
     ?>
</div>

</body>
<script type="text/javascript" src="../../js/jquery-3.1.0.min.js"></script>

<script type="text/javascript">

function printHTML() {
  if (window.print) {
    window.print();
  }
}

printHTML();

</script>
</html>
