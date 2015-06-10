<?php
class CambiarVistaArchivosCheckHandler {
	function get() {
	
		if($_SESSION["vistaCheck"]==1)
			$_SESSION["vistaCheck"]=2;
		else
			$_SESSION["vistaCheck"]=1;
		
		$self = $_SERVER['HTTP_REFERER']; //Obtenemos la página de atras
		header('Location:'.$self.''); //vamos hacia atras
	
	}
}