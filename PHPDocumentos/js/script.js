$(document).ready(function(){

	//mostrar boton de editar y eliminar carpeta
	$('.carpeta').hover(function(){
		$('.btnEliminarC').css('display','none');
		$('.btnEditarC').css('display','none');
		
		$(this).find('.btnEliminarC').css('display','block');
		$(this).find('.btnEditarC').css('display','block');
	});
	
	$('.carpetas').mouseleave(function(){
		$('.btnEliminarC').css('display','none');
		$('.btnEditarC').css('display','none');
	});
//mostrar boton de editar y eliminar etiqueta
	$('.carpeta').hover(function(){
		$('.btnEliminarE').css('display','none');
		$('.btnEditarE').css('display','none');
		
		$(this).find('.btnEliminarE').css('display','block');
		$(this).find('.btnEditarE').css('display','block');
	});
	
	$('.carpetas').mouseleave(function(){
		$('.btnEliminarE').css('display','none');
		$('.btnEditarE').css('display','none');
	});
	//mostrar boton de editar y eliminar grupo
	$('.grupo').hover(function(){
		$('.btnEliminarG').css('display','none');
		$('.btnEditarG').css('display','none');
		
		$(this).find('.btnEliminarG').css('display','block');
		$(this).find('.btnEditarG').css('display','block');
	});
	
	$('.grupo').mouseleave(function(){
		$('.btnEliminarG').css('display','none');
		$('.btnEditarG').css('display','none');
	});
	//Editar grupo
	$('.btnEditarG').click(function(){
		var nombre= $(this).attr('name');
		var id = $(this).attr('id');
		$('#descripcionEE').val(nombre);
		$('.idEE').val(id);
		$('#formEditarE').attr('action','/PHPDocumentos/AdmGrupo/');
	});
	$('.btnEliminarG').click(function(){	
		var id=$(this).attr('id');
		$("#eliminarLink").attr('href','/PHPDocumentos/AdmGrupo/'+id);
	});
	//Eliminar Integrante de un grupo	
	$('.BtnEliminarIntegrante').click(function(){	
		var usuario=$(this).attr('id');
		var grupo =$(this).attr('grupo');
		$("#eliminarLink").attr('href','/PHPDocumentos/Integrante/'+usuario+','+grupo);
	});
	
		//mostrar boton de eliminar integrante
	$('.integrante').hover(function(){
		$('.BtnEliminarIntegrante').css('display','none');
		
		$(this).find('.BtnEliminarIntegrante').css('display','block');
	});
	
	$('.integrante').mouseleave(function(){
		$('.BtnEliminarIntegrante').css('display','none');
	});
	
	//Editar carpeta
	$('.btnEditarC').click(function(){
		var nombre= $(this).attr('name');
		var id = $(this).attr('id');
		$('#descripcionEE').val(nombre);
		$('.idEE').val(id);
		$('#formEditarE').attr('action','/PHPDocumentos/AdmCarpeta/');
	});
	
	//Editar archivo
	$('.btnEditarA').click(function(){
		var nombre= $(this).attr('name');
		var id = $(this).attr('id');
		$('#descripcionEE').val(nombre);
		$('.idEE').val(id);
		$('#formEditarE').attr('action','/PHPDocumentos/AdmArchivo/');
	});
	

	//Vincular Etiqueta
	$('.btnAddEtiqueta').click(function(){
		var id = $(this).attr('id');
		$('.idEt').val(id);
		
	});

	//Eliminar carpeta	
	$('.btnEliminarC').click(function(){	
		var id=$(this).attr('id');
		$("#eliminarLink").attr('href','/PHPDocumentos/AdmCarpeta/'+id);
	});
	
	//Eliminar archivo
	$('.btnEliminarA').click(function(){
		var id=$(this).attr('id');
		$("#eliminarLink").attr('href','/PHPDocumentos/AdmArchivo/'+id);
	});
	//Eliminar Etiqueta
	$('.btnEliminarE').click(function(){
		var id=$(this).attr('id');
		$("#eliminarLink").attr('href','/PHPDocumentos/MisEtiquetas/'+id);
		$("#idElemento").attr('value',id);		
	});
	// Obtener el id del archivo a manipular
	$('.aVisual').click(function(){	
		var id = $(this).find('img').attr('iddocumento');
		$("#idDocumento").val(id);
		$("#imgVisual").attr('idDocumento',id);
		
		//Cargar link a descargar
		var dir= $(this).find('img').attr('placeholder');
		$("#descargaA").attr('href',dir);
		$("#descargaA").attr('download',dir);
		
		//Cargar id para eliminar
		$(".btnEliminarA").attr("id",id);
		
		//cargar id para editar
		$(".btnEditarA").attr("id",id);
		var nombre=$(this).attr('name');
		$(".btnEditarA").attr("name",nombre);
		
		//carga imagen a visualizar
		var ext = $(this).find('img').attr('id');
		//carga id para etiquetas
		$(".btnAddEtiqueta").attr("id",id);

		if(ext=='jpg' || ext=='png'){
			var d= $(this).find('img').attr('placeholder');
			$('#imgVisual').attr('src',d);
		}
		else{
			var d= $(this).find('img').attr('src');
			$('#imgVisual').attr('src',d);
		}
	});
		//Para registrar usuario
		$("#contraUsu2").keyup(function(){
				if($("#contraUsu2").val()!=$("#contraUsu").val()&&$("#contraUsu2").val()!="")
					$(".spanMsj").html("<span class=\"alerta\">Las contraseñas no coinciden</span>");
				if($("#contraUsu2").val()==$("#contraUsu").val()&&$("#contraUsu2").val()!="")
					$(".spanMsj").html("<span class=\"logro\">Las contraseñas coinciden</span>");
			    if($("#contraUsu2").val()=="")
			    	$(".spanMsj").html("<span class=\"alerta\"></span>");
		});
		$("#contraUsu").keyup(function(){
				if($("#contraUsu2").val()!=$("#contraUsu").val()&&$("#contraUsu").val()!="")
					$(".spanMsj").html("<span class=\"alerta\">Las contraseñas no coinciden</span>");
				if($("#contraUsu2").val()==$("#contraUsu").val()&&$("#contraUsu").val()!="")
					$(".spanMsj").html("<span class=\"logro\">Las contraseñas coinciden</span>");
			    if($("#contraUsu").val()=="")
			    	$(".spanMsj").html("<span class=\"alerta\"></span>");
		});
		$( "#frmRegistrar" ).submit(function( e ) {
		 if($("#contraUsu2").val()!=$("#contraUsu").val()&&$("#contraUsu2").val()!="") 
		  e.preventDefault();
		});
		
});