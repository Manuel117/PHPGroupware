<?php

class SingOutHandler {
    function get() {
		
		global $mstch;
		
		session_unset();
		session_destroy(); 
		
		header('Location:/PHPDocumentos/');
	
    }
}