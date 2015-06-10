<?php
class AdminArchivoHandler {
	function get($idArchivo) {
		
		$resultado = delete_Archivo($idArchivo);
		header('Location:/PHPDocumentos/Carpeta/'.$_SESSION["carpetaPadre"]);
	}
	function post() {
		
		if(isset($_POST['idEE'])){
			$descripcion=$_POST['descripcionEE'];
			$idDocumento=$_POST['idEE'];
			
			$resultado = edit_Archivo($descripcion,$idDocumento);
		}else{
			
			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'\PHPDocumentos\Archivos\\';
			$dirg ='../Archivos/';
		
			$uploaddir = $uploaddir.$_SESSION["usuarioId"];
			if (!file_exists($uploaddir)) {
			    mkdir($uploaddir, 0777, true);
			}
			$uploaddir = $uploaddir."\\".$_SESSION["carpetaPadre"];
			if (!file_exists($uploaddir)) {
			    mkdir($uploaddir, 0777, true);
			}
			$uploadfile = $uploaddir."\\" . basename($_FILES['archivo']['name']);
			if(move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadfile));
			{
				$time = time();
				$hoy = date("Y-m-d ", $time);
				$fechaArchivo = date("Y-m-d (H:i:s)", $time);
				$dirArchivo =  $dirg.$_SESSION["usuarioId"]."/".$_SESSION["carpetaPadre"]."/".$_FILES['archivo']['name'];

				$extension = substr($_FILES['archivo']['name'], strrpos($_FILES['archivo']['name'],'.'));
				$extension= str_replace('.', '', $extension);
				$resultado = add_Archivo($hoy,$dirArchivo,$_FILES['archivo']['name'],$_SESSION["carpetaPadre"],$extension,$_SESSION["usuarioId"]);										
			}
		}
			
		$self = $_SERVER['HTTP_REFERER']; //Obtenemos la página de atras
		header('Location:'.$self.''); //vamos hacia atras
	}
}