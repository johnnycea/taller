<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Vehiculo.php';


$Funciones = new Funciones();
$txt_patente = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

$Vehiculo = new Vehiculo();
$Vehiculo->setPatente($txt_patente);
$listadoVehiculo = $Vehiculo->obtenerVehiculo();


$vehiculo_encontrado = array();

if($listadoVehiculo->num_rows != 0){//si existe el vehiculo, recibe sus datos

    while($filas = $listadoVehiculo->fetch_array()){
       $vehiculo_encontrado['marca'] = $filas['marca'];
       $vehiculo_encontrado['modelo'] = $filas['modelo'];
       $vehiculo_encontrado['anio'] = $filas['anio'];
       $vehiculo_encontrado['quepaso'] = "lo_encontro";
     }

}else{//si el vehiculo no existe crea su patente

  $vehiculo_encontrado['marca'] = "";
  $vehiculo_encontrado['modelo'] = "";
  $vehiculo_encontrado['anio'] = "0";

  //preguntar si es un numero valido de pantente (si tiene 6 digitos lo guarda)
  if(strlen($txt_patente)==6){


      //AQUI HAY QUE PONER LA FUNCION QUE CREE EL VEHICULO SOLO CON SU PATENTE
      $conexion = new Conexion();
      $conexion = $conexion->conectar();

      if($conexion->query("insert into tb_vehiculos(patente) values('".$txt_patente."')")){

          $vehiculo_encontrado['quepaso'] = "se_agrego";
      }else{
          $vehiculo_encontrado['quepaso'] = "no_se_agrego";
      }

  }

}

 echo json_encode($vehiculo_encontrado);


// echo '{"marca":"TOYOTA","modelo":"CORONA","anio":"1991"}';
 ?>
