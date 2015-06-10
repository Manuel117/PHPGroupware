<?php
class MCHandler {
	
	function post() {
			if(isset($_POST["variosAc"])){
			    	
					//------Lógica para mover
					$boton=$_REQUEST["variosAc"];
					if($boton=="Mover"){
							if(isset($_POST["carpetaCB"])&&isset($_POST['ckbSeleccionado'])){
								foreach ($_REQUEST['ckbSeleccionado'] as $seleccionado){ 
									$accion="";$array="";
						           $array=explode(',', $seleccionado);           
						           $accion=mover_Archivo($_POST["carpetaCB"],$array[0]);
						        }
			       
							}
					}
					if($boton=="Copiar"){
						//add_Archivo($FechaCreacion,$Archivo,$Descripcion,$IdCarpetaPadre,$Extension,$idUsuario)
						// get_archivoEspecifico($idDocumento)
						if(isset($_POST["carpetaCB"])&&isset($_POST['ckbSeleccionado'])){
								foreach ($_REQUEST['ckbSeleccionado'] as $seleccionado){ 
									$accion="";$array="";$accion2="";
						           $array=explode(',', $seleccionado);           
						           $accion=get_archivoEspecifico($array[0]);
						           echo $array[0];
						           if($accion[0]["IdDocumento"]!=""){
						           	$time = time();
									$hoy = date("Y-m-d ", $time);
									$fechaArchivo = date("Y-m-d (H:i:s)", $time);
						           		$accion2=add_Archivo($fechaArchivo,$accion[0]["Archivo"],$accion[0]["Descripcion"],$_POST["carpetaCB"],$accion[0]["Extension"],$accion[0]["IdUsuario"]);
						           }
						        }
			       
							}else{
								//no se puede copiar
							}
					}

			}
			
			$self = $_SERVER['HTTP_REFERER']; //Obtenemos la página de atras
			header('Location:'.$self.''); //vamos hacia atras
		}

}