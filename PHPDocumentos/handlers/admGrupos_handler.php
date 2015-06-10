<?php
class AdminGrupoHandler {
	function get($idGrupo) {
		
		$resultado = delete_Grupo($idGrupo);
		header('Location:/PHPDocumentos/MisGrupos/');
	}
	function post() {
		if(isset($_POST['idG'])){//si es agregar
			$resultado = add_Grupo($_POST['descripcionAG'],$_SESSION["usuarioId"]);
			header('Location:/PHPDocumentos/MisGrupos/');
		}
		else//si es editar
		{
			$resultado = edit_Grupo($_POST['descripcionEE'],$_POST['idEE']);
			header('Location:/PHPDocumentos/MisGrupos/');
		}
	}
}