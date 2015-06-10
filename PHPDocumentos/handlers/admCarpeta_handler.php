<?php
class AdminCarpetaHandler {
	function get($idCarpeta) {
		
		$resultado = delete_Carpeta($idCarpeta);
		
		$self = $_SERVER['HTTP_REFERER']; //Obtenemos la página de atras
		header('Location:'.$self.''); //vamos hacia atras
	}
	function post() {
		
		if(isset($_POST['idC'])){//si es agregar
			$resultado = add_Carpeta($_POST['descripcionAC'],$_SESSION["usuarioId"],$_SESSION["carpetaPadre"]);
		}
		else//si es editar
		{
			$resultado = edit_Carpeta($_POST['descripcionEE'],$_POST['idEE']);
		}
		
		$self = $_SERVER['HTTP_REFERER']; //Obtenemos la página de atras
		header('Location:'.$self.''); //vamos hacia atras
	}
}