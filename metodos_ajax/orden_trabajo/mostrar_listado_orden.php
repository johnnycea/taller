<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';


  echo '
  <table class="table table-dark table-sm table-striped table-hover">
     <thead class="" align=center>

        <th></th>
        <th>Codigo</th>
        <th>Patente</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Rut</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Estado</th>
     </thead>
     <tbody>';


       $OrdenTrabajo = new OrdenTrabajo();
       $listadoOrdenTrabajo = $OrdenTrabajo->mostrarOrdenesTrabajo();

         while($filas = $listadoOrdenTrabajo->fetch_array()){

               echo '<tr>
                       <td><span id="columna_id_orden_'.$filas['id_orden'].'" >'.$filas['id_orden'].'</span></td>
                       <td><span id="columna_patente_'.$filas['id_orden'].'" >'.$filas['patente'].'</span></td>
                       <td><span id="columna_marca_'.$filas['id_orden'].'" >'.$filas['marca'].'</span></td>
                       <td><span id="columna_modelo_'.$filas['id_orden'].'" >'.$filas['modelo'].'</span></td>
                       <td><span id="columna_rut_cliente_'.$filas['id_orden'].'" >'.$filas['cliente'].'</span></td>
                       <td><span id="columna_nombre_'.$filas['id_orden'].'" >'.$filas['nombre'].'</span></td>
                       <td><span id="columna_apellido_'.$filas['id_orden'].'" >'.$filas['apellido'].'</span></td>
                       <span id="columna_estado_'.$filas['id_orden'].'" >'.$filas['id_estado'].'</span>
                       <td><span id="columna_descripcion_estado_'.$filas['id_orden'].'" >'.$filas['estado'].'</span></td>
                    </tr>';
         }

    echo '
     </tbody>
  </table>';


 ?>
