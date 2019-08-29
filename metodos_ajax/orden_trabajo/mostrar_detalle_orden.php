<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/OrdenTrabajo.php';


              echo '<table class="table table-bordered  table-dark table-sm">
                <thead class="thead-dark">

                  <th style="width:30px;"></th>
                  <th>Tipo</th>
                  <th>Item</th>
                  <th>Cantidad</th>
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

                                  <td>
                                  <button class="btn btn-danger btn-block" onclick="eliminarDetalleOrden('.$filas['id_detalle'].','.$filas['id_orden'].')" ><i class="fas fa-trash-alt"></i></button></td>
                                  </td>
                                  <td><span id="columna_tipo_detalle_" >'.$filas['tipo_detalle'].'</span></td>
                                  <td><span id="columna_descripcion_detalle_'.$filas['id_detalle'].'">'.$filas['descripcion'].'</span></td>
                                  <td><span id="columna_cantidad_" >'.$filas['cantidad'].'</span></td>
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
                  <div class="row">
                    <div class="col-md-4 offset-md-8">
                      <table class=" table table-bordered  table-dark table-sm">
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
                                    <input type="checkbox" '.$checkbox_iva.' onChange="cambiarIva(this.checked)" class="form-check-input" id="checkbox_iva">
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
