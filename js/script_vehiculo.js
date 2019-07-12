listarVehiculo();

function listarVehiculo(texto_buscar){


		$.ajax({
			url:"./metodos_ajax/vehiculo/mostrar_listado_vehiculo.php?texto_buscar="+texto_buscar,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_listado_vehiculo").html(respuesta);
			}
		});
}

function CrearVehiculo(){

			$.ajax({
				url:"./metodos_ajax/vehiculo/ingresar_modificar_vehiculo.php",
				method:"POST",
				data: $("#formulario_modal_vehiculo").serialize(),
				success:function(respuesta){
					  // alert(respuesta);

					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_vehiculo").modal('hide');
						 listarVehiculo();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}


function limpiarFormularioVehiculo(){
   $("#formulario_modal_vehiculo")[0].reset();
	 $('#txt_id_subvencion').attr("readonly",false);
	 $("#formulario_modal_vehiculo").attr("action","javascript:CrearVehiculo()");

}

function cargarInformacionModificarVehiculo(id){

  var txt_patente = $("#columna_patente_"+id).html();
	var txt_marca = $("#columna_marca_"+id).html();
  var txt_modelo = $("#columna_modelo_"+id).html();
	var txt_anio = $("#columna_anio_"+id).html();

	//carga la informacion recibida en el modal
	$('#txt_patente').val(txt_patente);
	$('#txt_marca').val(txt_marca);
	$('#txt_modelo').val(txt_modelo);
	$('#txt_anio').val(txt_anio);

}


// function modificarVehiculo(){
//
// 			$.ajax({
// 				url:"./metodos_ajax/subvencion/modificar_subvencion.php",
// 				method:"POST",
// 				data: $("#formulario_modal_subvencion").serialize(),
// 				success:function(respuesta){
// 					 // alert(respuesta);
//
// 					 if(respuesta==1){
// 						 swal("Guardado","Los datos se han guardado correctamente.","success");
// 						 $("#modal_subvencion").modal('hide');
// 						 listarProveedor();
// 					 }else if(respuesta==2){
// 						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
// 				   }
// 				}
// 			});
//
// }

function eliminarVehiculo(id){

			$.ajax({
				url:"./metodos_ajax/vehiculo/eliminar_vehiculo.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarVehiculo();
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});

}
