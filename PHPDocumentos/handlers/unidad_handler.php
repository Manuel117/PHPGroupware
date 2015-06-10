<?php

class UnidadHandler {
	function get() {

		global $mstch;

		if(isset($_SESSION["usuarioId"])){

			
			$etiquetas=get_etiquetas_user($_SESSION["usuarioId"]);
			$vista=$_SESSION["vistaArch"];
			$usuario=$_SESSION["usuario"];
			$usuarioId=$_SESSION["usuarioId"];
			$vistaCheck=$_SESSION["vistaCheck"];
			$grupos= get_grupos($usuarioId);
			$usuarios = get_usuarios($usuarioId);
			$archivos=get_archivosMiUnidad($usuarioId);//Archivos de mi unidad se guardan con 0
			$carpetasU=get_carpetasUser($usuarioId);
			/*--------------MIGAS DE PAN----------*/
			$CarpetaPadre=0;
			$_SESSION["carpetaPadre"]=$CarpetaPadre;
			$MigasPan = "0-Mi Unidad";
			$_SESSION['MigasPan']= $MigasPan;

			$carpetas=get_carpetas($usuarioId,$CarpetaPadre);

			$MigasArray = array(
				"Id" => "0",
				"Carpeta" => "Mi Unidad");
			/*------------------------------------*/

			echo $mstch->render('header',array(
				'usuario'=>$usuario,
				'ubicacion' => "Unidad",
				'migas' => $MigasArray
				));
				
			//VALIDAR TIPO DE VISTA DE LOS ARCHIVOS
			if($vista==1){
				if($vistaCheck==1){
						echo $mstch->render('unidad_V1', array(
					'carpetas' => $carpetas,
					'carpetasU'=>$carpetasU,
					'archivos' => $archivos,
					'grupos' => $grupos,
					'usuarios' => $usuarios,
					'etiquetasP' => $etiquetas,
					'idCarpeta' => 0));	
				}else
				{
				    echo $mstch->render('unidad_V1Check', array(
					'carpetas' => $carpetas,
					'carpetasU'=>$carpetasU,
					'archivos' => $archivos,
					'grupos' => $grupos,
					'usuarios' => $usuarios,
					'etiquetasP' => $etiquetas,
					'idCarpeta' => 0));	
				}
			
			}
			else{
				if($vistaCheck==1){
				echo $mstch->render('unidad_V2', array(
					'carpetas' => $carpetas,
					'carpetasU'=>$carpetasU,
					'archivos' => $archivos,
					'usuarios' => $usuarios,
					'grupos' => $grupos,
					'etiquetasP' => $etiquetas,
					'idCarpeta' => 0));	
			}else
			{
				echo $mstch->render('unidad_V2Check', array(
					'carpetas' => $carpetas,
					'carpetasU'=>$carpetasU,
					'archivos' => $archivos,
					'usuarios' => $usuarios,
					'grupos' => $grupos,
					'etiquetasP' => $etiquetas,
					'idCarpeta' => 0));
			}
				
			}

			echo $mstch->render('footer');

		}
		else
			header('Location:/PHPDocumentos/');
	}
}