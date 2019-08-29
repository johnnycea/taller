function boton_nueva_orden(){

   listarDetalleOrden();
	 mostrarOcultarOpcionesEstado(1);
	 $("#txt_fecha_pago").val("");
	 $("#txt_rut_cliente").val("");
	 $("#txt_patente").val("");

}

$(document).ready(listarOrden);


function mostrarOcultarOpcionesEstado(opcion){
	//opcion 1: ocultar estado e imprimir, mostrar confirmar ingreso
	//opcion 2: mostrar estado e imprimir, ocultar confirmar ingreso
	if(opcion==1){
		$('#btn_confirmar_orden').removeClass('d-none');
		$('#contenedor_opciones_orden').addClass('d-none');
	}else if(opcion==2){
		$('#btn_confirmar_orden').addClass("d-none");
		$('#contenedor_opciones_orden').removeClass('d-none');
	}
}

function cargarInformacionClientes(texto_buscar){

	$("#txt_nombre").val('Cargando...');
	$("#txt_direccion").val('Cargando...');
	$("#txt_comuna").val('Cargando...');
	$("#txt_giro").val('Cargando...');
	$("#txt_telefono").val('Cargando...');

		$.ajax({
			url:"./metodos_ajax/clientes/buscar_cliente_orden.php?texto_buscar="+texto_buscar,
			method:"POST",
			dataType:"json",
			success:function(respuesta){

				// alert(respuesta.quepaso);

				 $("#txt_nombre").val(respuesta.nombre);
				 $("#txt_direccion").val(respuesta.direccion);
				 $("#txt_comuna").val(respuesta.comuna);
				 $("#txt_giro").val(respuesta.giro);
				 $("#txt_telefono").val(respuesta.telefono);
			}
		});
}

function guardarDatosCliente(){


   var rut = $("#txt_rut_cliente").val();
   var nombre = $("#txt_nombre").val();
   var telefono = $("#txt_telefono").val();
   var comuna = $("#txt_comuna").val();
   var direccion = $("#txt_direccion").val();
   var giro = $("#txt_giro").val();

		$.ajax({
			url:"./metodos_ajax/clientes/ingresar_modificar_cliente.php?txt_rut_cliente="+rut+"&txt_nombre="+nombre+"&txt_telefono="+telefono+"&txt_comuna="+comuna+"&txt_direccion="+direccion+"&txt_giro="+giro,
			method:"POST",
			success:function(respuesta){
				console.log(respuesta);
			}
		});
}

function guardarDatosVehiculo(){

   var patente = $("#txt_patente").val();
   var marca = $("#txt_marca").val();
   var modelo = $("#txt_modelo").val();
   var anio = $("#txt_anio").val();

		$.ajax({
			url:"./metodos_ajax/vehiculo/ingresar_modificar_vehiculo.php?txt_patente="+patente+"&txt_marca="+marca+"&txt_modelo="+modelo+"&txt_anio="+anio,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				console.log(respuesta);
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
	var txt_rut_cliente = $("#columna_rut_cliente_"+id).html();
	var txt_id_estado = $("#columna_estado_"+id).html();
	var txt_fecha_pago = $("#columna_fecha_pago_"+id).html();



	//carga la informacion recibida en el modal
	$('#txt_id_orden').val(txt_id_orden);
	$('#span_codigo_orden').html(txt_id_orden);
	$('#txt_descripcion').val(txt_descripcion);
	$('#txt_kilometraje').val(txt_kilometraje);
	$('#cmb_trabajador').val(txt_trabajador);

	$('#txt_patente').val(txt_patente);
	$('#txt_patente').keyup();
	$('#txt_rut_cliente').val(txt_rut_cliente);
	$('#txt_rut_cliente').change();

	$('#txt_fecha_pago').val(txt_fecha_pago);

	$('#select_estado_orden').val(txt_id_estado);
   mostrarOcultarFechaPago();

  mostrarOcultarOpcionesEstado(2);


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
				// alert(respuesta.quepaso);

				 $("#txt_marca").val(respuesta.marca);
				 $("#txt_modelo").val(respuesta.modelo);
				 $("#txt_anio").val(respuesta.anio);
			}
		});
}

function guardarDatosOrden(){

   var txt_rut_cliente = $("#txt_rut_cliente").val();
   var txt_patente = $("#txt_patente").val();

   var txt_id_orden = $("#txt_id_orden").val();
   var txt_descripcion = $("#txt_descripcion").val();
   var txt_kilometraje = $("#txt_kilometraje").val();
   var cmb_trabajador = $("#cmb_trabajador").val();

		$.ajax({
			url:"./metodos_ajax/orden_trabajo/guardar_diagnostico.php?txt_rut_cliente="+txt_rut_cliente+"&txt_patente="+txt_patente+"&txt_descripcion="+txt_descripcion+"&txt_kilometraje="+txt_kilometraje+"&txt_id_orden="+txt_id_orden+"&cmb_trabajador="+cmb_trabajador,
			method:"POST",
			success:function(respuesta){
				console.log(respuesta);
				listarOrden();
			}
		});
}


function listarOrden(){

   contenedorCargando("#contenedor_listado_orden");
		$.ajax({
			url:"./metodos_ajax/orden_trabajo/mostrar_listado_orden.php",
			method:"POST",
			data: $("#formulario_buscar_ordenes").serialize(),
			success:function(respuesta){

				 $("#contenedor_listado_orden").html(respuesta);

			}
		});
}

function listarDetalleOrden(){

	contenedorCargando("#contenedor_detalle_orden");

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

function cambiarIva(iva){

	var id_orden = $("#txt_id_orden").val();

			$.ajax({
				url:"./metodos_ajax/orden_trabajo/cambiar_iva.php?id_orden="+id_orden+"&iva="+iva,
				method:"POST",
				success:function(respuesta){
					// alert(respuesta);
					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 listarDetalleOrden("");
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}


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

			function imprimeComprobante() {
				var id_orden = $("#txt_id_orden").val()
				// alert(nombre);
				// alert(apellidos);
					 window.open("./metodos_ajax/orden_trabajo/imprimir_orden_trabajo.php?id_orden="+id_orden, "Impimir Boucher" , "width=800,height=600,scrollbars=YES");
			}


function mostrarOcultarFechaPago() {
	var estado_actual = $("#select_estado_orden").val();

  if(estado_actual==4){
      $("#contenedor_fecha_pago").removeClass("d-none");
	}else{
		  $("#contenedor_fecha_pago").addClass("d-none");
	}
}

function cambiarEstadoOrden(nuevo_estado){
	if(nuevo_estado==4){
		$("#select_estado_orden").val(4);//para cuando se guarde en onblur de fecha
	}
	mostrarOcultarFechaPago();

				var id_orden = $("#txt_id_orden").val();
				var fecha_pago = $("#txt_fecha_pago").val();

        if(nuevo_estado==2){
           //VERIFICAR QUE SE HAYA INGRESADO PATENTE Y RUT
					 if($("#txt_rut_cliente").val()==""){
						 swal("Debe ingresar Cliente","","info");
						 return false;
					 }else if($("#txt_patente").val()==""){
						 swal("Debe ingresar Patente","","info");
						 return false;
					 }

				}

						if(nuevo_estado==4 && (fecha_pago=="" || fecha_pago==" ")){
								swal("Indique la fecha de pago","","info");
								$("#select_estado_orden").val(3);

						}else{


								$.ajax({
									url:"./metodos_ajax/orden_trabajo/cambiar_estado_orden.php?id_orden="+id_orden+"&nuevo_estado="+nuevo_estado+"&fecha_pago="+fecha_pago,
									method:"POST",
									success:function(respuesta){
										// alert(respuesta);
										if(respuesta==1){
											swal("Guardado","Los datos se han guardado correctamente.","success");
											listarDetalleOrden("");
											mostrarOcultarOpcionesEstado(2);
											listarOrden();
										}else{
											swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
										}
									}
								});

						}


}
