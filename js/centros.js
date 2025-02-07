


function integrante_filter_unidad_change(attr){
	
}

function integrante_filter_lugarTrabajo_change(attr){
	
}

function lugarTrabajo_filter_lugarTrabajo_change(attr){
	
}

function autocomplete_callback_apellido( oid ){
	
	$("#autocomplete_spanapellido").append("<span id='iconoLoading' style='position:absolute;'><img src='css/grid/loading.gif' /></span>")
	$("#hiddenApellido").val( oid );
	
	jQuery.ajax({
	      url:"doAction?action=add_integrante_docente&cd_docente=" + $("#hiddenApellido").val(),
	      dataType:"json",
	      success: function(data){
	      	
	      	if( data != null && data["error"]!=null){
	      		showMessageError( data["error"], true );
	      		//inhabilitar el submit.
	      		$("#edit_matriculado_input_submit_ajax").hide();
	      	}
	      	
	      	else{
	      		$("#edit_matriculado_input_submit_ajax").show();
	      		//ocultamos los div.
	      		$("#nombre").val(data["nombre"]);
	      		$("#apellido").val(data["apellido"]);
	      		$("#cuil").val(data["cuil"]);	
	      		$("#mail").val(data["mail"]);	
	      		$("#telefono").val(data["telefono"]);	
	      		$("#categoria_oid").val(data["categoria_oid"]);
				$("#categoriasicadi_oid").val(data["categoriasicadi_oid"]);
				$("#carrerainv_oid").val(data["carrerainv_oid"]);
	      		$("#organismo_oid").val(data["organismo_oid"]);		
	      		$("#cargo_oid").val(data["cargo_oid"]);		
	      		$("#deddoc_oid").val(data["deddoc_oid"]);		
	      		$("#facultad_oid").val(data["facultad_oid"]);		
	      		/*$("#integrante_filter_lugarTrabajo_oid").val(data["lugarTrabajo_oid"]);	
	      		$("#integrante_filter_lugarTrabajo_oid").blur();*/
	      		$("#beca").val(data["beca"]);	
	      		var categoria = document.getElementById("categoria.oid");
	      		categoria.value = data["categoria_oid"];
				var categoriasicadi = document.getElementById("categoriasicadi.oid");
				categoriasicadi.value = data["categoriasicadi_oid"];
	      		
	      	} 	
	      	 $("#iconoLoading").remove();
	      }
	});
}






