
function generarInforme(){
		$.ajax({
			url:"./metodos_ajax/informes/mostrar_informe.php?",
			data: $("#formulario_informe").serialize(),
			method:"POST",
			success:function(respuesta){
				 $("#contenedor_informe").html(respuesta);
			}
		});
}


function mostrarOcultarOpciones(select_tipo_informe){

   if(select_tipo_informe==1){
		 $("#contenedor_selector_cliente").removeClass("d-none");
	 }else if(select_tipo_informe==2){
		 $("#contenedor_selector_cliente").addClass("d-none");
	 }

}

function imprimeComprobante(fecha_inicio,fecha_fin,tipo_informe,cliente) {

		 window.open("./metodos_ajax/ventas/imprimir_comprobante_venta.php?fecha_inicio="+fecha_inicio+"&fecha_fin="+fecha_fin+"&tipo_informe="+tipo_informe+"&cliente="+cliente,
		 							"Impimir Boucher" ,
									"width=800,height=600,scrollbars=YES");
}
