<?php
class CompartirHandler {
	function get() {
		
	}
	function post() {
		try 
		{
			if($_POST['grupo'] != "")
			{
				$resultado = compartir_Grupo($_POST['grupo'],$_SESSION["usuarioId"],$_POST['idDocumento']);
			}

		}
		catch (Exception $e) {
		   
		}
		try{
			if($_POST['usuario']!= "")
			{
				$resultado = compartir_Usuario($_POST['usuario'],$_POST['idDocumento']);
			}

		}
		catch (Exception $e) {
		   
		}
		
		$self = $_SERVER['HTTP_REFERER']; //Obtenemos la página de atras
		header('Location:'.$self.''); //vamos hacia atras
	}

}