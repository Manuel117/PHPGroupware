<?php

class GruposHandler {
	function get($idGrupo) {
		
		global $mstch;

		if(isset($_SESSION["usuarioId"])){
			$grupos= get_grupos($_SESSION["usuarioId"]);
			$etiquetas=get_etiquetas();
			$usuario=$_SESSION["usuario"];
			$usuarioId = $_SESSION["usuarioId"];
			$integrantes = get_integrantes($idGrupo);
			$usuarios = get_usuarios($usuarioId);
			$url = $_SERVER["REQUEST_URI"];
			$urlDes = explode("/",$url);
			echo $mstch->render('header',array(
				'usuario' => $usuario));

			echo $mstch->render('grupos', array(
				'Grupos' => $grupos,
				'integrantes' => $integrantes,
				'usuarios' => $usuarios,
				'grupo' => $urlDes[3],
				'etiquetas' => $etiquetas));

			echo $mstch->render('footer');
		}
		else
			header('Location:/PHPDocumentos/');

	}
}
