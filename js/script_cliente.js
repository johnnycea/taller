listarCliente("");

function listarCliente(texto_buscar){


		$.ajax({
			url:"./metodos_ajax/clientes/mostrar_listado_cliente.php?texto_buscar="+texto_buscar,
			method:"POST",
			success:function(respuesta){
				// alert(respuesta);
				 $("#contenedor_listado_cliente").html(respuesta);
			}
		});
}

function crearCliente(){

			$.ajax({
				url:"./metodos_ajax/clientes/ingresar_modificar_cliente.php",
				method:"POST",
				data: $("#formulario_modal_cliente").serialize(),
				success:function(respuesta){
					  alert(respuesta);
					 if(respuesta==1){
						 swal("Guardado","Los datos se han guardado correctamente.","success");
						 $("#modal_cliente").modal('hide');
						 listarCliente("");
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});
	}


function limpiarFormularioCliente(){
   $("#formulario_modal_cliente")[0].reset();
	 $('#txt_rut_cliente').attr("readonly",false);
	 $("#formulario_modal_cliente").attr("action","javascript:crearCliente()");

}

function cargarInformacionClientes(id){

  var txt_rut = $("#txt_rut_"+id).html();
  var txt_dv = $("#txt_dv_"+id).html();
	var txt_nombre = $("#txt_nombre_"+id).html();
	var txt_direccion = $("#txt_direccion_"+id).html();
	var txt_comuna = $("#txt_comuna_"+id).html();
	var txt_giro = $("#txt_giro_"+id).html();
	var txt_telefono = $("#txt_telefono_"+id).html();

	//carga la informacion recibida en el modal
 $('#txt_rut_cliente').val(txt_rut);
 $('#txt_dv').val(txt_dv);
	$('#txt_nombre').val(txt_nombre);
	$('#txt_direccion').val(txt_direccion);
	$('#txt_comuna').val(txt_comuna);
	$('#txt_giro').val(txt_giro);
	$('#txt_telefono').val(txt_telefono);
}

function eliminarCliente(id){

			$.ajax({
				url:"./metodos_ajax/clientes/eliminar_cliente.php?id="+id,
				method:"POST",
				success:function(respuesta){
					 // alert(respuesta);
					 if(respuesta==1){
						 swal("Eliminado correctamente","Los datos se han guardado correctamente.","success");
						 listarCliente("");
					 }else if(respuesta==2){
						 swal("Ocurrió un error","Recargue la página e intente nuevamente.","error");
					 }
				}
			});

}


// function modificarProveedor(){
//
// 			$.ajax({
// 				url:"./metodos_ajax/marcas/modificar_subvencion.php",
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
