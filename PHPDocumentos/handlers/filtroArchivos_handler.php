<?php

class FiltroArchivosHandler {
	function get($ubicacion){
		global $mstch;
		
		//valida sesión
		if(isset($_SESSION["usuarioId"])){
			
			$usuario = $_SESSION["usuario"];
			$usuarioId = $_SESSION["usuarioId"];
			$vista=$_SESSION["vistaArch"];
			$grupos= get_grupos($usuarioId);
			$etiquetas=get_etiquetas();
			
			if($ubicacion == "Compartidos"){//cuando es en compartidos
			
				$archivos=filtrar_Compartidos($usuarioId, $_GET['filtro']);
				
				echo $mstch->render('header',array(
					'usuario'=>$usuario,
					'ubicacion' => "Compartidos"));
					
				//VALIDAR TIPO DE VISTA DE LOS ARCHIVOS
				if($vista==1){
					echo $mstch->render('filtroCompartidos_V1', array(
						'archivos' => $archivos,
						'grupos' => $grupos,
						'aciones' => "",
						'etiquetas' => $etiquetas));
				}
				else{
					echo $mstch->render('filtroCompartidos_V2', array(
						'archivos' => $archivos,
						'grupos' => $grupos,
						'aciones' => "",
						'etiquetas' => $etiquetas));
				}
				echo $mstch->render('footer');
			}
			else//cuando es en mi unidad o alguna carpeta
			{
				$archivos=filtrar_Unidad($usuarioId, $_GET['filtro']);
				
				echo $mstch->render('header',array(
				'usuario'=>$usuario,
				'ubicacion' => "Unidad"
				));
				
				//VALIDAR TIPO DE VISTA DE LOS ARCHIVOS
				if($vista==1){
					echo $mstch->render('filtroUnidad_V1', array(
						'archivos' => $archivos,
						'grupos' => $grupos,
						'etiquetas' => $etiquetas,
						'idCarpeta' => 0));
				}
				else{
					echo $mstch->render('filtroUnidad_V2', array(
						'archivos' => $archivos,
						'grupos' => $grupos,
						'etiquetas' => $etiquetas,
						'idCarpeta' => 0));
				}

			echo $mstch->render('footer');
			}
		}else
			header('Location:/PHPDocumentos/');
	}
}