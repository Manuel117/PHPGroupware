<?php
class CompartidoHandler {
	function get() {
		
		global $mstch;

		if(isset($_SESSION["usuarioId"])){
			$vistaTipo;
			$usuario = $_SESSION["usuario"];
			$usuarioId = $_SESSION["usuarioId"];
			$vista=$_SESSION["vistaArch"];
			$vistaCheck=$_SESSION["vistaCheck"];
			$archivos=get_archivosCompartidos($_SESSION["usuarioId"]);
			$grupos= get_grupos($usuarioId);
			$etiquetas=get_etiquetas_user($usuarioId);

			echo $mstch->render('header',array(
				'usuario'=>$usuario,
				'ubicacion' => "Compartidos"));
				
			//VALIDAR TIPO DE VISTA DE LOS ARCHIVOS
			if($vista==1){
               

				echo $mstch->render('compartido_V1', array(
					'archivos' => $archivos,
					'grupos' => $grupos,
					'aciones' => "",
					'etiquetasP' => $etiquetas));
			}
			else{
				echo $mstch->render('compartido_V2', array(
					'archivos' => $archivos,
					'grupos' => $grupos,
					'aciones' => "",
					'etiquetasP' => $etiquetas));
			}
			echo $mstch->render('footer');
		}
		else
			header('Location:/PHPDocumentos/');
		
	}
}