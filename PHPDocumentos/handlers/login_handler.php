<?php

class LoginHandler {

	
	    function get() {
			
			/*global $mstch;
			$_SESSION["usuarioId"]=4;
			$_SESSION["usuario"]="usuario1";
			$_SESSION["vistaArch"]=1;
			*/
			global $mstch;
			
			if(isset($_SESSION["usuarioId"]))
				header('Location:/PHPDocumentos/MiUnidad/');
			else
				echo $mstch->render('login');		
		    }
	



		function post(){
			global $mstch;
			if(isset($_REQUEST["btnUsuarioA"])){

				$boton=$_REQUEST["btnUsuarioA"];

				if($boton=="Entrar"){
					if(isset($_POST['txtUser'])&&$_POST['txtUser']!=""&&isset($_POST['txtPass'])&&$_POST['txtPass']!=""){
		               $usuario=validar_usuario($_POST['txtUser'], $_POST['txtPass']);
				               if($usuario!=null&&$usuario[0]["IdUsuario"]!=null&&$usuario[0]["NombreUsuario"]!=null&&$usuario[0]["Contrasenna"]!=null){
				                $_SESSION["usuarioId"]=$usuario[0]["IdUsuario"];
								$_SESSION["usuario"]=$usuario[0]["NombreUsuario"];
								$_SESSION["vistaArch"]=1;
								$_SESSION["vistaCheck"]=1;
							
							if(isset($_SESSION["usuarioId"]))
								header('Location:/PHPDocumentos/MiUnidad/');
							else
								echo $mstch->render('login',array('alerta'=>"No se encontró el usuario."));	
					    }else
					    	echo $mstch->render('login',array('alerta'=>"El usuario no existe."));
					}else
						echo $mstch->render('login',array('alerta'=>"Falta el usuario o contraseña."));
				}
				if($boton=="Crear"){
    			    if(isset($_POST['nombreUsu'])&&isset($_POST['contraUsu'])&&isset($_POST['contraUsu2'])){
    			    	$usuario=validar_usurio_reg($_POST['nombreUsu']);
    			    	if($usuario==null){
    			    		$resultado=add_usuario($_POST['nombreUsu'],$_POST['contraUsu']);
    			    		echo $mstch->render('login',array('logroReg'=>"Se registro el usuario con éxito, intente ingresar con su nombre de usuario y contraseña."));
    			    	}else{
    			    	 echo $mstch->render('login',array('alertaReg'=>"Ya existe un usuario con ese nombre."));
    			    	}
                      
    			    }else{
    			    	echo $mstch->render('login');
    			    	//echo $_POST['nombreUsu']." ".$_POST['contraUsu']." ".$_POST['contraUsu2'];
    			    }

				}

			}
		}		
}