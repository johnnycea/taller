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


if($tipo_informe==1){//ORDENES POR PAGAR

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

           $fecha = date_create($filas['fecha_recepcion']);
           $fecha = date_format($fecha, 'd-m-Y');

             echo '
                <tr>
                  <td>'.$filas['id_orden'].'</td>
                  <td>'.$fecha.'</td>
                  <td>'.$filas['nombre'].'</td>
                  <td>$'.number_format($filas['iva_venta'],0,",",".").'</td>
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


}else if($tipo_informe==2){//ingresos

  $consulta = "select * from vista_orden
                where fecha_recepcion between '".$fecha_inicio."' and '".$fecha_fin."'
                and id_estado = 4 ";

  $resultado_consulta = $Conexion->query($consulta);


  echo '
  <table class="table table-stripped table-bordered table-sm ">
     <thead>
        <th>Nº OT</th>
        <th>Fecha Ingreso</th>
        <th>Cliente</th>
        <th>Fecha Pago</th>
        <th>Repuestos</th>
        <th>Mano de Obra</th>
        <th>Neto</th>
        <th>Iva</th>
        <th>Total</th>
     </thead>
     <tbody>';

     $total=0;
      while($filas = $resultado_consulta->fetch_array()){

        $fecha_ingreso = date_create($filas['fecha_recepcion']);
        $fecha_ingreso = date_format($fecha_ingreso, 'd-m-Y');

        $fecha_pago = date_create($filas['fecha_pago']);
        $fecha_pago = date_format($fecha_pago, 'd-m-Y');

          echo '
             <tr>
               <td>'.$filas['id_orden'].'</td>
               <td>'.$fecha_ingreso.'</td>
               <td>'.$filas['nombre'].'</td>
               <td>'.$fecha_pago.'</td>
               <td>$'.number_format($filas['total_repuestos'],0,",",".").'</td>
               <td>$'.number_format($filas['total_mano_obra'],0,",",".").'</td>
               <td>$'.number_format($filas['total_repuestos']+$filas['total_mano_obra'],0,",",".").'</td>
               <td>$'.number_format($filas['iva_venta'],0,",",".").'</td>
               <td>$'.number_format($filas['valor'],0,",",".").'</td>
             </tr>
          ';

          $total+=$filas['valor'];
      }

      echo '
         <tr>
           <td colspan="8">Total</td>
           <td>$'.number_format($total,0,",",".").'</td>
         </tr>
      ';

 echo '</tbody>
  </table>
  ';

}


 ?>
