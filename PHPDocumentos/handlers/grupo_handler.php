<?php

class GrupoHandler {
	function get() {
		
		global $mstch;

		if(isset($_SESSION["usuarioId"])){
			$grupos= get_grupos($_SESSION["usuarioId"]);
			$etiquetas=get_etiquetas();
			$usuario=$_SESSION["usuario"];
			
			echo $mstch->render('header',array(
				'usuario' => $usuario));

			echo $mstch->render('grupos', array(
				'Grupos' => $grupos,
				'etiquetas' => $etiquetas));

			echo $mstch->render('footer');
		}
		else
			header('Location:/PHPDocumentos/');

	}
}
