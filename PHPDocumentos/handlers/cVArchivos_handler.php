<?php
class CambiarVistaArchivosHandler {
	function get() {
	
		if($_SESSION["vistaArch"]==1)
			$_SESSION["vistaArch"]=2;
		else
			$_SESSION["vistaArch"]=1;
		
		$self = $_SERVER['HTTP_REFERER']; //Obtenemos la página de atras
		header('Location:'.$self.''); //vamos hacia atras
	
	}
}