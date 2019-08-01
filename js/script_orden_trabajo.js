
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


function cargarModificarOrden(id){

	$("#txt_id_orden").val(id);
	listarDetalleOrden();

  var txt_id_orden = $("#columna_id_orden_"+id).html();
  var txt_descripcion = $("#columna_descripcion_"+id).html();
  var txt_kilometraje = $("#columna_kilometraje_"+id).html();
  var txt_trabajador = $("#columna_trabajador_"+id).html();
  var txt_patente = $("#columna_patente_"+id).html();
	var txt_marca = $("#columna_marca_"+id).html();
  var txt_modelo = $("#columna_modelo_"+id).html();
  var txt_anio = $("#columna_anio_"+id).html();
	var txt_rut_cliente = $("#columna_rut_cliente_"+id).html();
	var txt_nombre = $("#columna_nombre_"+id).html();
	var txt_apellido = $("#columna_apellido_"+id).html();
	var txt_telefono = $("#columna_telefono_"+id).html();
	var txt_comuna = $("#columna_comuna_"+id).html();
	var txt_direccion = $("#columna_direccion_"+id).html();
	var txt_giro = $("#columna_giro_"+id).html();
	var txt_id_estado = $("#columna_estado_"+id).html();
	var txt_descripcion_estado = $("#columna_descripcion_estado_"+id).html();

	  var txt_tipo_detalle = $("#columna_tipo_detalle_"+id).html();
	  var txt_descripcion_detalle = $("#columna_descripcion_detalle_"+id).html();
	  var txt_cantidad = $("#columna_cantidad_"+id).html();
	  var txt_valor = $("#columna_valor_"+id).html();
	  var txt_valor_total = $("#columna_valor_total_"+id).html();

	//carga la informacion recibida en el modal
	$('#txt_id_orden').val(txt_id_orden);
	$('#txt_descripcion').val(txt_descripcion);
	$('#txt_kilometraje').val(txt_kilometraje);
	$('#txt_trabajador').val(txt_trabajador);
	$('#txt_patente').val(txt_patente);
	$('#txt_marca').val(txt_marca);
	$('#txt_modelo').val(txt_modelo);
	$('#txt_anio').val(txt_anio);
	$('#txt_rut_cliente').val(txt_rut_cliente);
	$('#txt_nombre').val(txt_nombre);
	$('#txt_apellido').val(txt_apellido);
	$('#txt_telefono').val(txt_telefono);
	$('#txt_comuna').val(txt_comuna);
	$('#txt_direccion').val(txt_direccion);
	$('#txt_giro').val(txt_giro);
	$('#txt_id_estado').val(txt_id_estado);
	$('#txt_descripcion_estado').val(txt_descripcion_estado);

	$('#txt_tipo_detalle').val(txt_tipo_detalle);
	$('#txt_descripcion_detalle').val(txt_descripcion_detalle);
	$('#txt_cantidad').val(txt_cantidad);
	$('#txt_valor').val(txt_valor);
	$('#txt_valor_total').val(txt_valor_total);

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
