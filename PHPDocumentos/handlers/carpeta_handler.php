<?php
class CarpetaHandler {
	function get($idCarpeta) {
		
		global $mstch;

		if(isset($_SESSION["usuarioId"])){
			
			if($idCarpeta==0){
				header('Location:/PHPDocumentos/MiUnidad/');
			}
			$vistaCheck=$_SESSION["vistaCheck"];
			$usuario = $_SESSION["usuario"];
			$usuarioId = $_SESSION["usuarioId"];
			$vista=$_SESSION["vistaArch"];
			$archivos=get_archivos($idCarpeta);
			$grupos= get_grupos($usuarioId);
			$etiquetas=get_etiquetas();
			$usuarios = get_usuarios($usuarioId);

			/*MIGAS DE PAN*/
			$_SESSION["carpetaPadre"]=$idCarpeta;
			$carpetas=get_carpetas($usuarioId,$idCarpeta);
			$carpetasU=get_carpetasUser($usuarioId);
			$MigasPan = $_SESSION['MigasPan'];
			$desCarpeta = get_DescripcionCarpeta($idCarpeta);	
			
			if($idCarpeta!=0)//SI NO ES MI UNIDAD
			{
				$bandera=0;
				$vectorMigas2 = explode(";",$MigasPan);
				$MigasPan="";

				foreach($vectorMigas2 as $valor){
					$vectorAux2= explode("-",$valor);
					if($bandera==0 and $vectorAux2[0]!= $idCarpeta)
					{
						if($MigasPan == "")
							{$MigasPan = $vectorAux2[0]."-".$vectorAux2[1];}
						else
							{$MigasPan = $MigasPan.";".$vectorAux2[0]."-".$vectorAux2[1];}
					}
					else
					{
						if($vectorAux2[0]== $idCarpeta)
							{$bandera=1;}
					}
				}
				
				$NombreCarpeta ="";

				foreach($desCarpeta as $value)
				{
					$NombreCarpeta=($value['Descripcion']);
				}	

				$MigasPan=$MigasPan.";".$idCarpeta."-".$NombreCarpeta;
				$_SESSION['MigasPan']= $MigasPan;
				$vectorMigas = explode(";",$MigasPan);
				$vectorMigasPan = array();	

				foreach($vectorMigas as $valor){
					$vectorAux= explode("-",$valor);
					array_push($vectorMigasPan,array("Id"=>$vectorAux[0],"Carpeta"=>$vectorAux[1].' / ',));
				}
			}
			else//SI ES MI UNIDAD
			{
				$MigasPanAux = "0-Mi Unidad";
				$_SESSION['MigasPan']= $MigasPanAux;
				$vectorMigasPan=array();
				$vectorMigasPan = array(
					"Id" => "0",
					"Carpeta" => "Mi Unidad");
			}


			echo $mstch->render('header',array(
				'usuario'=>$usuario,
				'ubicacion' => "Unidad",
				'migas' => $vectorMigasPan));
				
			//VALIDAR TIPO DE VISTA DE LOS ARCHIVOS
			if($vista==1){
				if($vistaCheck==1){
						echo $mstch->render('unidad_V1', array(
					'carpetas' => $carpetas,
					'carpetasU'=>$carpetasU,
					'archivos' => $archivos,
					'grupos' => $grupos,
					'usuarios' => $usuarios,
					'idCarpeta' => $idCarpeta,
					'etiquetasP' => $etiquetas));	
				}else
				{
				    echo $mstch->render('unidad_V1Check', array(
					'carpetas' => $carpetas,
					'carpetasU'=>$carpetasU,
					'archivos' => $archivos,
					'grupos' => $grupos,
					'usuarios' => $usuarios,
					'idCarpeta' => $idCarpeta,
					'etiquetasP' => $etiquetas));	
				}
			}
			else{
				if($vistaCheck==1){
						echo $mstch->render('unidad_V2', array(
					'carpetas' => $carpetas,
					'carpetasU'=>$carpetasU,
					'archivos' => $archivos,
					'grupos' => $grupos,
					'usuarios' => $usuarios,
					'idCarpeta' => $idCarpeta,
					'etiquetasP' => $etiquetas));	
				}else
				{
				    echo $mstch->render('unidad_V2Check', array(
					'carpetas' => $carpetas,
					'carpetasU'=>$carpetasU,
					'archivos' => $archivos,
					'grupos' => $grupos,
					'usuarios' => $usuarios,
					'idCarpeta' => $idCarpeta,
					'etiquetasP' => $etiquetas));	
				}
			}
			echo $mstch->render('footer');
		}
		else
			header('Location:/PHPDocumentos/');
		
	}
}