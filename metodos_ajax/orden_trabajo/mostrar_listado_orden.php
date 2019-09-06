<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';
// require_once '../../clases/RegistroActividad.php';


//consultar usuario logeado
require_once '../../clases/Usuario.php';
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
$tipo_usuario_actual = $usuario['tipo_usuario'];


$Funciones = new Funciones();

//variables busqueda
$codigo = $Funciones->limpiarNumeroEntero($_REQUEST["txt_codigo_orden_buscar"]);
$fecha_inicio = $Funciones->limpiarTexto($_REQUEST["txt_fecha_inicio_buscar"]);
$fecha_fin = $Funciones->limpiarTexto($_REQUEST["txt_fecha_fin_buscar"]);
$cliente = $Funciones->limpiarTexto($_REQUEST["txt_rut_cliente_buscar"]);
$patente = $Funciones->limpiarTexto($_REQUEST["txt_patente_buscar"]);
$estado = $Funciones->limpiarTexto($_REQUEST["txt_estado_orden_buscar"]);
$trabajador = $Funciones->limpiarTexto($_REQUEST["txt_rut_trabajador_buscar"]);

 $posicion_guion = strpos($cliente,"-");
 $soloRut = substr($cliente,0,$posicion_guion);

  echo '
  <table class="table table-dark table-sm table-striped table-hover">
     <thead class="" align=center>
        <th>Nº Orden</th>
        <th>Hora</th>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Vehiculo</th>
        <th>Estado</th>
        <th>Modificar</th>
        <th>Eliminar</th>
     </thead>
     <tbody>';


       $OrdenTrabajo = new OrdenTrabajo();
       $listadoOrdenTrabajo = $OrdenTrabajo->mostrarOrdenesTrabajo($codigo,$fecha_inicio,$fecha_fin,$soloRut,$patente,$estado,$trabajador);

         while($filas = $listadoOrdenTrabajo->fetch_array()){

           $fecha = date_create($filas['fecha_recepcion']);
           $fecha_recepcion = date_format($fecha, 'd-m-Y');
           $hora_recepcion = date_format($fecha, 'H:i');


               echo '<tr align=center>
                       <td><span id="columna_id_orden_'.$filas['id_orden'].'" >'.$filas['id_orden'].'</span></td>
                       <td><span id="columna_fecha_recepcion_'.$filas['id_orden'].'" >'.$fecha_recepcion.'</span></td>
                       <td><span id="columna_fecha_recepcion_'.$filas['id_orden'].'" >'.$hora_recepcion.'</span></td>

                           <span class="d-none" id="columna_descripcion_'.$filas['id_orden'].'" >'.$filas['descripcion_diagnostico'].'</span>
                           <span class="d-none" id="columna_kilometraje_'.$filas['id_orden'].'" >'.$filas['kilometraje'].'</span>
                           <span class="d-none" id="columna_trabajador_'.$filas['id_orden'].'" >'.$filas['trabajador'].'</span>
                           <span class="d-none" id="columna_rut_cliente_'.$filas['id_orden'].'" >'.$filas['cliente'].'</span>

                       <td><span id="columna_nombre_'.$filas['id_orden'].'" >'.$filas['nombre'].' </span></td>
                       <td><span id="columna_vehiculo'.$filas['id_orden'].'" >'.$filas['patente'].' '.$filas['marca'].' '.$filas['modelo'].'</span></td>
                           <span class="d-none" id="columna_patente_'.$filas['id_orden'].'" >'.$filas['patente'].'</span></td>

                           <span class="d-none" id="columna_estado_'.$filas['id_orden'].'" >'.$filas['id_estado'].'</span></td>
                           <span class="d-none" id="columna_fecha_pago_'.$filas['id_orden'].'" >'.$filas['fecha_pago'].'</span></td>
                           <span class="d-none" id="columna_fecha_entrega_'.$filas['id_orden'].'" >'.$filas['fecha_entrega'].'</span></td>
                           <span class="d-none" id="columna_fecha_facturacion_'.$filas['id_orden'].'" >'.$filas['fecha_facturacion'].'</span></td>
                           <span class="d-none" id="columna_tipo_pago_'.$filas['id_orden'].'" >'.$filas['tipo_pago'].'</span></td>

                       <td><span id="columna_descripcion_estado_'.$filas['id_orden'].'" >'.$filas['estado'].'</span></td>
                       <td>
                           <button onclick="cargarModificarOrden('.$filas['id_orden'].')" data-target="#modal_orden" data-toggle="modal" class="col-12 btn btn-sm btn-warning "> <i class="fa fa-edit"></i> </button>
                       </td>
                       <td>
                       <button class="btn btn-sm btn-danger btn-block" onclick="eliminarOrdenTrabajo('.$filas['id_orden'].')" ><i class="fa fa-trash-alt"></i></button>
                       </td>';


                       if($tipo_usuario_actual==1){
                           echo '
                           <td>
                              <button onclick="cargarRegistroActividad('.$filas['id_orden'].')" data-target="#modal_registro" data-toggle="modal" class="col-12 btn btn-sm btn-success "> <i class="fa fa-history" aria-hidden="true"></i> </button>
                           </td>';
                       }

                       echo '
                      </tr>';

         }

    echo '
     </tbody>
  </table>';


 ?>
