<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';


  echo '
  <table class="table table-dark table-sm table-striped table-hover">
     <thead class="" align=center>

        <th>Codigo</th>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Vehiculo</th>
        <th>Estado</th>
        <th>Modificar</th>
     </thead>
     <tbody>';


       $OrdenTrabajo = new OrdenTrabajo();
       $listadoOrdenTrabajo = $OrdenTrabajo->mostrarOrdenesTrabajo();

         while($filas = $listadoOrdenTrabajo->fetch_array()){

               echo '<tr align=center>
                       <td><span id="columna_id_orden_'.$filas['id_orden'].'" >'.$filas['id_orden'].'</span></td>
                       <td><span id="columna_fecha_recepcion_'.$filas['id_orden'].'" >'.$filas['fecha_recepcion'].'</span></td>
                           <span class="d-none" id="columna_descripcion_'.$filas['id_orden'].'" >'.$filas['descripcion_diagnostico'].'</span>
                           <span class="d-none" id="columna_kilometraje_'.$filas['id_orden'].'" >'.$filas['kilometraje'].'</span>
                           <span class="d-none" id="columna_trabajador_'.$filas['id_orden'].'" >'.$filas['trabajador'].'</span>
                       <span class="d-none" id="columna_rut_cliente_'.$filas['id_orden'].'" >'.$filas['cliente'].'</span>
                       <td><span id="columna_nombre_'.$filas['id_orden'].'" >'.$filas['nombre'].' '.$filas['apellido'].'</span></td>
                           <span class="d-none" id="columna_apellido_'.$filas['id_orden'].'" >'.$filas['apellido'].'</span>
                           <span class="d-none" id="columna_telefono_'.$filas['id_orden'].'" >'.$filas['telefono'].'</span>
                           <span class="d-none" id="columna_comuna_'.$filas['id_orden'].'" >'.$filas['comuna'].'</span>
                           <span class="d-none" id="columna_direccion_'.$filas['id_orden'].'" >'.$filas['direccion'].'</span>
                           <span class="d-none" id="columna_giro_'.$filas['id_orden'].'" >'.$filas['giro'].'</span>
                        <td><span id="columna_patente_'.$filas['id_orden'].'" >'.$filas['patente'].' '.$filas['marca'].' '.$filas['modelo'].'</span></td>
                            <span class="d-none" id="columna_marca_'.$filas['id_orden'].'" >'.$filas['marca'].'</span>
                            <span class="d-none" id="columna_modelo_'.$filas['id_orden'].'" >'.$filas['modelo'].'</span>
                            <span class="d-none" id="columna_anio_'.$filas['id_orden'].'" >'.$filas['anio'].'</span>
                       <span class="d-none" id="columna_estado_'.$filas['id_orden'].'" >'.$filas['id_estado'].'</span>
                       <td><span id="columna_descripcion_estado_'.$filas['id_orden'].'" >'.$filas['estado'].'</span></td>
                       <td>
                             <button onclick="cargarModificarOrden('.$filas['id_orden'].')" data-target="#modal_orden" data-toggle="modal" class="col-12 btn btn-warning "> <i class="fa fa-edit"></i> </button>
                       </td>
                    </tr>';
         }

    echo '
     </tbody>
  </table>';


 ?>
