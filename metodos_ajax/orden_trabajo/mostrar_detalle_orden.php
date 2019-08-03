<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';


              echo '<table class="table table-bordered  table-dark table-sm">
                <thead class="thead-dark">

                  <th>Tipo</th>
                  <th>Item</th>
                  <th>Cantidad</th>
                  <th>Valor</th>
                  <th>Total</th>
                  <th style="width:30px;"></th>
                </thead>
                <tbody>';

                  $Funciones = new Funciones();

                  $id_orden = $Funciones->limpiarNumeroEntero($_REQUEST['id_orden']);
                 echo '<script> id_orden = '.$id_orden.'; </script>';

                  $OrdenTrabajo = new OrdenTrabajo();
                  $OrdenTrabajo->setIdOrden($id_orden);
                  $listadoOrdenTrabajo = $OrdenTrabajo->vistaDetalleOrden();


                  $total = 0;
                    while($filas = $listadoOrdenTrabajo->fetch_array()){

                          echo '<tr>

                                <td><span id="columna_tipo_detalle_" >'.$filas['tipo_detalle'].'</span></td>
                                  <td><span id="columna_descripcion_detalle_'.$filas['id_detalle'].'">'.$filas['descripcion'].'</span></td>
                                  <td><span id="columna_cantidad_" >'.$filas['cantidad'].'</span></td>
                                  <td><span id="columna_valor_'.$filas['id_detalle'].'" >$'.number_format($filas['valor'],0,",",".").'</span></td>
                                  <td><span id="columna_valor_total_'.$filas['id_detalle'].'" >$'.number_format($filas['valor_total'],0,",",".").'</span></td>
                                <td>
                                    <button class="btn btn-danger btn-block" onclick="eliminarDetalleOrden('.$filas['id_detalle'].','.$filas['id_orden'].')" ><i class="fas fa-trash-alt"></i></button></td>
                                  </td>
                                     </div>
                               </tr>';

                               $total += $filas['valor_total'];
                    }

                    echo '

                        <tr class="table-info text-dark">
                            <td colspan="4"><strong>Total a pagar</strong></td>
                            <td><strong>$'.number_format($total,0,',','.').'</strong></td>
                        </tr>

                     </tbody>
                  </table>';

                  echo '

                   <div class="container clearfix">';
                      if($total!=0){
                        echo '<button type="button" data-toggle="modal" data-target="#modal_finalizar_orden" class="btn btn-success col-12 col-md-4 btn-block"><i class="fas fa-check-circle"></i> Confirmar ingreso orden</button>';
                        echo '<button type="button"  onclick="imprimeComprobante('.$filas['id_orden'].')" class="btn btn-success col-12 col-md-4 btn-block"><i class="fas fa-check-circle"></i> Imprimir</button>';
                      }

                   echo '</div>
                  ';



 ?>
