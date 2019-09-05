<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Vehiculo.php';


  echo '
  <br>
  <br>
  <table class="table  table-sm table-bordered table-dark table-hover">
     <thead class="thead-dark">

        <th>Patente</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Año</th>
        <th></th>
        <th></th>

     </thead>
     <tbody>';

       $Funciones = new Funciones();
       $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);
       $cantidad_registros = $Funciones->limpiarNumeroEntero($_REQUEST['cantidad_registros']);

       $Vehiculo = new Vehiculo();
       $listadoVehiculo = $Vehiculo->obtenerVehiculos($texto_buscar,$cantidad_registros); //$texto_buscar," where id_estado=1 or id_estado=2 "

         while($filas = $listadoVehiculo->fetch_array()){

          echo '<tr>

                       <td><span id="columna_patente_'.$filas['patente'].'" >'.$filas['patente'].'</span></td>
                       <td><span id="columna_marca_'.$filas['patente'].'" >'.$filas['marca'].'</span></td>
                       <td><span id="columna_modelo_'.$filas['patente'].'" >'.$filas['modelo'].'</span></td>
                       <td><span id="columna_anio_'.$filas['patente'].'" >'.$filas['anio'].'</span></td>

                       <td>
                             <button onclick="cargarInformacionModificarVehiculo(\''.$filas['patente'].'\')" data-target="#modal_vehiculo" data-toggle="modal" class="col-12 btn btn-warning "> <i class="fa fa-edit"></i> </button>
                       </td>
                       <td>
                             <button onclick="eliminarVehiculo(\''.$filas['patente'].'\')"  class="col-12 btn btn-danger "> <i class="fa fa-trash-alt"></i> </button>
                       </td>

                    </tr>';
         }

    echo '
     </tbody>
  </table>

  <button class="btn btn-block btn-warning" onclick="cambiarCantidadRegistros()">Mostrar Mas</button>

  ';

  // <a href="./modificar_empresa.php?id_empresa='.$filas['id_empresa'].'" class="btn btn-outline-primary">Editar</a>


 ?>
