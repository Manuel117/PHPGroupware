<?php
class EtiquetasHandler {


    function get($idEti) {
			global $mstch;
		    $usuario = $_SESSION["usuario"];
		 	$usuarioId = $_SESSION["usuarioId"];
			$vista=$_SESSION["vistaArch"];
			$EtiquetasUserC=get_etiquetas_user($usuarioId);
			
			if($idEti!="Todo")
				$archivos=get_archivoXetiqueta($idEti);
			else
				$archivos=get_archivosXusuario($usuarioId);
			
			$usuarios = get_usuarios($usuarioId);
		    $etiquetas=get_etiquetas_user($usuarioId);
		    

		    echo $mstch->render('header',array(
				'usuario'=>$usuario,
				'ubicacion' => "Unidad"));

		    if($vista==1){
				echo $mstch->render('etiquetas_V1', array(
	     	'etiquetas' => $etiquetas,
	     	'usuarios' => $usuarios,
	     	'etiquetasP' => $EtiquetasUserC,
	     	'archivos' => $archivos
	     	));	
			}
			else{
				echo $mstch->render('etiquetas_V2', array(
	     	'etiquetas' => $etiquetas,
	     	'usuarios' => $usuarios,
	     	'etiquetasP' => $EtiquetasUserC,
	     	'archivos' => $archivos
	     	));	
			}



	     	echo $mstch->render('footer');			
    }
    function post(){
    		global $mstch;
    		$usuario = $_SESSION["usuario"];
		 	$usuarioId = $_SESSION["usuarioId"];
			$vista=$_SESSION["vistaArch"];
			$EtiquetasUserC=get_etiquetas_user($usuarioId);
    	   	
    	   	
		    if(isset($_REQUEST["btnEtiqueta"])){
		    	
				//------Lógica para agregar
				$boton=$_REQUEST["btnEtiqueta"];
				//si lo que hacemos es seleccionar el $idEtiquetaPbutton de la modal para crear etiquetas
				if($boton=="Crear Etiqueta"){
						if(isset($_POST['descripcionEt'])&&$_POST['descripcionEt']!=""&&$usuarioId!=null)
						{
							$etiqueta=add_etiqueta($_POST['descripcionEt'],$usuarioId);
						}
						else
						{
							//no se puede guardar etiqueta
						}
				}
				//--------Lógica para eliminar
				if($boton=="Eliminar"){
                    if(isset($_POST['idElemento']))
						{
							$etiqueta=remove_etiqueta($_POST['idElemento']);
						}else{
							//No se pudo eliminar la etiqueta
						}
						
				}
				if($boton=="Vincular Etiqueta"){
						if(isset($_POST["etiquetaCB"])!=null&&isset($_POST["idEt"])!=null&&isset($_POST["etiquetaCB"])!=""&&isset($_POST["idEt"])!=""){
								$resultRegistroEtiqueta=registro_anterior_etiAr($_POST["idEt"],$_POST["etiquetaCB"]);
								if($resultRegistroEtiqueta!=""){
									link_etiqueta($_POST["idEt"],$_POST["etiquetaCB"]);
									$self = $_SERVER['HTTP_REFERER']; //Obtenemos la página de atras
		                            header('Location:'.$self.''); //vamos hacia atras
								}
						}
				}
			}
			


			$archivos=get_archivosXusuario($usuarioId);
			$usuarios = get_usuarios($usuarioId);
		    $etiquetas=get_etiquetas_user($usuarioId);



			echo $mstch->render('header',array(
				'usuario'=>$usuario,
				'ubicacion' => "Unidad"));
			echo $mstch->render('etiquetas_V1', array(
	     	'etiquetas' => $etiquetas,
	     	'usuarios' => $usuarios,
	     	'etiquetasP' => $EtiquetasUserC,
	     	'archivos' => $archivos
	     	));	
	     	echo $mstch->render('footer');


    }

    //logica para pintar
		    
}