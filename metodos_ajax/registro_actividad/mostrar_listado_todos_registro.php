<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/RegistroActividad.php';


  echo '
  <table class="table table-sm table-bordered table-dark table-hover">
     <thead class="thead-dark">

     <th>Rut</th>
     <th>Nombre</th>
        <th>Accion</th>
        <th>Detalle</th>
        <th>Fecha/Hora</th>

     </thead>
     <tbody>';

       $Funciones = new Funciones();
       $id_orden = $Funciones->limpiarTexto($_REQUEST['id_orden']);

       $RegistroActividad = new RegistroActividad();
       // $RegistroActividad->setIdOrden($id_orden);
       $listadoRegistroActividad = $RegistroActividad->obtenerRegistrosActividades($id_orden); //$texto_buscar," where id_estado=1 or id_estado=2 "

         while($filas = $listadoRegistroActividad->fetch_array()){

          echo '<tr>

                       <td><span id="columna_rut_usuario_'.$filas['id_registro'].'" >'.$filas['rut_usuario'].'</span></td>
                       <td><span id="columna_nombre_usuario_'.$filas['id_registro'].'" >'.$filas['nombre_usuario'].'</span></td>
                       <td><span id="columna_accion_'.$filas['id_registro'].'" >'.$filas['accion'].'</span></td>
                       <td><span id="columna_detalle_accion_'.$filas['id_registro'].'" >'.$filas['detalle_accion'].'</span></td>
                       <td><span id="columna_hora_registro_'.$filas['id_registro'].'" >'.$filas['hora_registro'].'</span></td>
                    </tr>';
         }

    echo '
     </tbody>
  </table>';

  // <a href="./modificar_empresa.php?id_empresa='.$filas['id_empresa'].'" class="btn btn-outline-primary">Editar</a>


 ?>
