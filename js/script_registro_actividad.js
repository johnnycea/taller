listarRegistro();

// function cargarRegistroActividad(id_orden){
//
// 	contenedorCargando("#contenedor_listado_registro");
//
// 		$.ajax({
// 			url:"./metodos_ajax/registro_actividad/mostrar_listado_registro_actividad.php?id_orden="+id_orden,
// 			method:"POST",
// 			success:function(respuesta){
// 				// alert(respuesta);
// 				 $("#contenedor_listado_registro").html(respuesta);
// 			}
// 		});
// }

function listarRegistro(id_orden){

	// var id_orden = $("#txt_id_orden").val();

		$.ajax({
      url:"./metodos_ajax/registro_actividad/mostrar_listado_todos_registro.php?id_orden="+id_orden,
			method:"POST",
			success:function(respuesta){
				 // alert(respuesta);
				 $("#contenedor_listado_registro_actividad").html(respuesta);
			}
		});
}


// function cargarRegistroActividad(id){
//
// 	$("#txt_id_orden").val(id);
// 	listarRegistro();
//
//   var txt_id_registro = $("#columna_id_registro_"+id).html();
//   var txt_id_orden = $("#columna_id_orden_"+id).html();
//   var txt_hora_registro = $("#columna_hora_registro_"+id).html();
//   var txt_accion = $("#columna_accion_"+id).html();
//   var txt_detalle_accion = $("#columna_detalle_accion_"+id).html();
// 	var txt_rut_usuario = $("#columna_rut_usuario_"+id).html();
// 	var txt_nombre_usuario = $("#columna_nombre_usuario_"+id).html();
//
// 	//carga la informacion recibida en el modal
// 	$('#txt_id_registro').val(txt_id_registro);
// 	$('#txt_id_orden').val(txt_id_orden);
// 	$('#txt_hora_registro').html(txt_hora_registro);
// 	$('#txt_accion').val(txt_accion);
// 	$('#txt_detalle_accion').val(txt_detalle_accion);
// 	$('#txt_rut_usuario').val(txt_rut_usuario);
// 	$('#txt_nombre_usuario').val(txt_nombre_usuario);
//
//
// }
