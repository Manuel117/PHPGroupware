<?php
class addIntegranteHandler {
	function get() {
		
	}
	function post() {
		try{
				$resultado = add_integrante($_POST['idGrupo'],$_POST['usuario']);

		}
		catch (Exception $e) {
		   echo $e;
		}
		header('Location:/PHPDocumentos/Grupo/'.$_POST['idGrupo']);
	}

}