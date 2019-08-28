<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';


$funciones = new Funciones();

$fecha_inicio = $funciones->limpiarTexto($_REQUEST['txt_fecha_inicio']);
$fecha_fin = $funciones->limpiarTexto($_REQUEST['txt_fecha_fin']);
$tipo_informe = $funciones->limpiarNumeroEntero($_REQUEST['select_tipo_informe']);
$cliente = $funciones->limpiarTexto($_REQUEST['txt_rut_cliente']);



$Conexion = new Conexion();
$Conexion = $Conexion->conectar();


if($tipo_informe==1){//informe general

     $consulta = "select * from vista_orden where fecha_recepcion between '".$fecha_inicio."' and '".$fecha_fin."' and id_estado = 3 ";

     if($cliente!=""){

       $posicion_guion = strpos($cliente,"-");
       $solo_rut = substr($cliente,0,$posicion_guion);

       $consulta = $consulta." and cliente = ".$solo_rut;
     }

     $resultado_consulta = $Conexion->query($consulta);


     echo '
     <table class="table table-stripped table-bordered table-sm ">
        <thead>
           <th>Nº OT</th>
           <th>Fecha</th>
           <th>Cliente</th>
           <th>Iva</th>
           <th>Valor+Iva</th>
        </thead>
        <tbody>';

        $total=0;
         while($filas = $resultado_consulta->fetch_array()){
             echo '
                <tr>
                  <td>'.$filas['id_orden'].'</td>
                  <td>'.$filas['fecha_recepcion'].'</td>
                  <td>'.$filas['nombre'].'</td>
                  <td>'; echo ($filas['iva_venta']>0) ? "Si" : "No";  echo '</td>
                  <td>$'.number_format($filas['valor'],0,",",".").'</td>
                </tr>
             ';

             $total+=$filas['valor'];
         }

         echo '
            <tr>
              <td colspan="4">Total</td>
              <td>$'.number_format($total,0,",",".").'</td>
            </tr>
         ';

    echo '</tbody>
     </table>
     ';


}else if($tipo_informe==2){//

  $consulta = "select * from vista_orden where fecha_recepcion between '".$fecha_inicio."' and '".$fecha_fin."' and id_estado = 3 ";

  $resultado_consulta = $Conexion->query($consulta);


  echo '
  <table class="table table-stripped table-bordered table-sm ">
     <thead>
        <th>Nº OT</th>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Iva</th>
        <th>Valor+Iva</th>
     </thead>
     <tbody>';

     $total=0;
      while($filas = $resultado_consulta->fetch_array()){
          echo '
             <tr>
               <td>'.$filas['id_orden'].'</td>
               <td>'.$filas['fecha_recepcion'].'</td>
               <td>'.$filas['nombre'].'</td>
               <td>'; echo ($filas['iva_venta']>0) ? "Si" : "No";  echo '</td>
               <td>$'.number_format($filas['valor'],0,",",".").'</td>
             </tr>
          ';

          $total+=$filas['valor'];
      }

      echo '
         <tr>
           <td colspan="4">Total</td>
           <td>$'.number_format($total,0,",",".").'</td>
         </tr>
      ';

 echo '</tbody>
  </table>
  ';

}


 ?>
