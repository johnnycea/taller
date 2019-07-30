
listarOrden();

function cargarInformacionClientes(texto_buscar){

	$("#txt_nombre").val('Cargando...');
	$("#txt_apellido").val('Cargando...');
	$("#txt_calle").val('Cargando...');
	$("#txt_numero").val('Cargando...');
	$("#txt_comuna").val('Cargando...');
	$("#txt_giro").val('Cargando...');
	$("#txt_telefono").val('Cargando...');

		$.ajax({
			url:"./metodos_ajax/clientes/buscar_cliente_orden.php?texto_buscar="+texto_buscar,
			method:"POST",
			dataType:"json",
			success:function(respuesta){
				 $("#txt_nombre").val(respuesta.nombre);
				 $("#txt_apellido").val(respuesta.apellidos);
				 $("#txt_calle").val(respuesta.calle);
				 $("#txt_numero").val(respuesta.numero_calle);
				 $("#txt_comuna").val(respuesta.comuna);
				 $("#txt_giro").val(respuesta.giro);
				 $("#txt_telefono").val(respuesta.telefono);
			}
		});
}

function cargarVehiculo(texto_buscar){

	$("#txt_marca").val('Cargando...');
	$("#txt_modelo").val('Cargando...');
	$("#txt_anio").val('Cargando...');

		$.ajax({
			url:"./metodos_ajax/vehiculo/buscar_vehiculo_orden.php?texto_buscar="+texto_buscar,
			method:"POST",
			dataType:"json",
			success:function(respuesta){
				// console.log(respuesta);
				// alert(respuesta);
				// alert(respuesta.marca+" modelo: "+respuesta.modelo+" anio:"+respuesta.anio );
				 $("#txt_marca").val(respuesta.marca);
				 $("#txt_modelo").val(respuesta.modelo);
				 $("#txt_anio").val(respuesta.anio);
			}
		});
}

function guardarDatosOrden(){

   var txt_id_orden = $("#txt_id_orden").val();
   var txt_descripcion = $("#txt_descripcion").val();
   var txt_kilometraje = $("#txt_kilometraje").val();
   var cmb_trabajador = $("#cmb_trabajador").val();

		$.ajax({
			url:"./metodos_ajax/orden_trabajo/guardar_diagnostico.php?txt_descripcion="+txt_descripcion+"&txt_kilometraje="+txt_kilometraje+"&txt_id_orden="+txt_id_orden+"&cmb_trabajador="+cmb_trabajador,
			method:"POST",
			success:function(respuesta){
				console.log("respuesta actualiza orden :"+respuesta);
			}
		});
}


function listarOrden(){

		$.ajax({
			url:"./metodos_ajax/orden_trabajo/mostrar_listado_orden.php?",
			method:"POST",
			success:function(respuesta){
				 // alert(respuesta);
				 
				 $("#contenedor_listado_orden").html(respuesta);
			}
		});
}

function listarDetalleOrden(){

	var id_orden = $("#txt_id_orden").val();

		$.ajax({
			url:"./metodos_ajax/orden_trabajo/mostrar_detalle_orden.php?id_orden="+id_orden,
			method:"POST",
			success:function(respuesta){
				 // alert(respuesta);
				 $("#contenedor_detalle_orden").html(respuesta);
			}
		});
}


function crearDetalleOrden(){
	// var txt_id_orden = $("#txt_id_orden").val();
	// var txt_id_detalle = $("#txt_id_detalle").val();
			$.ajax({
				url:"./metodos_ajax/orden_trabajo/ingresar_modificar_detalle_orden.php",
				// url:"./metodos_ajax/orden_trabajo/ingresar_modificar_detalle_orden.php?txt_id_orden="+txt_id_orden+"&txt_id_detalle="+txt_id_detalle,
				method:"POST",
				data: $("#formulario_modal_detalle_orden").serialize(),
				success:function(respuesta){
					  // alert(respuesta);
						console.log(respuesta);
					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 // $("#modal_orden").modal('hide');
						 listarDetalleOrden("");
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}




// function limpiarFormularioOrden(){
//    $("#formulario_modal_orden")[0].reset();
// 	 $('#txt_id_factura').attr("readonly",false);
// 	 $("#formulario_modal_orden").attr("action","javascript:crearOrden()");
//
// }



function eliminarDetalleOrden(id_detalle,id_orden){

	// 	alert("Id_detalle: "+id_detalle+" Id_orden: "+id_orden);
	swal({
	title: "¿Eliminar?",
	text: "El detalle de su orden",
	type: "warning",
	showCancelButton: true,
	confirmButtonColor: "#DD6B55",
	confirmButtonText: "Eliminar!",
	cancelButtonText: "Cancelar!",
	closeOnConfirm: false,
	closeOnCancel: false },
	function(isConfirm){
			if (isConfirm) {
			$.ajax({
				url:"./metodos_ajax/orden_trabajo/eliminar_detalle_orden.php?id_detalle="+id_detalle+"&id_orden="+id_orden,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarDetalleOrden("");
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
					}
				});
			} else {
					swal("Cancelado", "", "error");
			}
			});
			}
