<?php

class IntegranteHandler {
	function get($integranteId,$grupoId){

		$resultado = delete_Integrante($integranteId,$grupoId);
		header('Location:/PHPDocumentos/Grupo/'.$grupoId);
	}
	
}