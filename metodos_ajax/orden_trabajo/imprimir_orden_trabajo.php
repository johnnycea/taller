<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';
require_once '../../clases/Cliente.php';
require_once '../../clases/Vehiculo.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Boucher</title>
</head>
<body>

  <h1>José Manuel Infante Poduje</h1>
  <h1>R.U.T: 7.816.171-K</h1>
  <h1>Taller Electromecánico</h1>
  <h1>Nueva Rancagua: N°0125</h1>
  <h1>Fono: 713558 ANGOL</h1>

  <div class="card-head">
       <div clas="col-2">
             <img class="card-img" src="../../img/logo-inguz.jpg" alt="">
       </div>
  </div>

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


  <h1>Orden de trabajo <?php echo $id_orden; ?></h1>

  <p>----------------------------</p>
  <table border="1" align="center"  width="100%">
  <caption>Cliente</caption>
  <tr>
    <td width="100%">
      <label for="">Rut Cliente: </label>
      <label for=""><?php echo $rut_cliente; ?> </label>

  <label for="">Nombre: </label>
  <label for=""><?php echo $nombre; ?> </label>

  <label for="">Teléfono: </label>
  <label for=""><?php echo $telefono; ?> </label>
<br>
  <label for="">Dirección: </label>
  <label for=""><?php echo $direccion; ?> </label>

  <label for="">Comuna: </label>
  <label for=""><?php echo $comuna; ?> </label>
  <br>
  <!-- <label for="">Giro: </label>
  <label for=""><?php //echo $giro; ?> </label> -->
  <br>
    </td>
  </tr>
  	</table>
<br>
  <table border="1" align="center"  width="100%">
        <caption>Patente</caption>
        <tr width="100%">
          <td width="100%">
              <label for=""><?php echo $patente; ?> </label>

              <label for="">Marca: </label>
              <label for=""><?php echo $marca; ?> </label>

              <label for="">Modelo: </label>
              <label for=""><?php echo $modelo ?> </label>
              <br>
              <label for="">Año: </label>
              <label for=""><?php echo $anio ?> </label>

              <label for="">Kilometraje: </label>
              <label for=""><?php echo $kilometraje ?> </label>
              <br>
          </td>
        </tr>
    	</table>


<?php

$DetalleOrden = new OrdenTrabajo();
$DetalleOrden->setIdOrden($id_orden);
$consultaDetalleOrden = $DetalleOrden->vistaDetalleOrden();

  echo ' <table border="1" class="table table-bordered  table-dark table-sm">
      <thead class="thead-dark">
        <th>Tipo</th>
        <th>Item</th>
        <th>Cantidad</th>
        <th>Valor</th>
        <th>Total</th>
        <th style="width:30px;"></th>
      </thead>
      <tbody>';

      while($resultado_detalle_orden = $consultaDetalleOrden->fetch_array()){
           echo '<tr>
              <td><span>'.$resultado_detalle_orden['tipo_detalle'].'</span></td>
              <td><span>'.$resultado_detalle_orden['descripcion'].'</span></td>
              <td><span>'.$resultado_detalle_orden['cantidad'].'</span></td>
              <td><span>$'.number_format($resultado_detalle_orden['valor'],0,",",".").'</span></td>
              <td><span>$'.number_format($resultado_detalle_orden['valor_total'],0,",",".").'</span></td>

           </tr> ';
       }
       echo '</tbody>
         </table>';
 ?>

            </body>
<script type="text/javascript" src="../../js/jquery-3.1.0.min.js"></script>

<script type="text/javascript">

function printHTML() {
  if (window.print) {
    window.print();
  }
}

</script>
</html>
