<?php

// Carpetas
function add_Carpeta($descripcion,$idUsuario,$idCarpetaPadre) {
    $query = SQLite::getInstance()->prepare("insert into TbCarpeta (Descripcion,IdUsuario,IdCarpetaPadre)
                       values (:descripcion,:idUsuario,:idCarpetaPadre)");
    $query->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $query->bindValue(':idCarpetaPadre', $idCarpetaPadre, PDO::PARAM_INT);
    return $query->execute();

}

function edit_Carpeta($descripcion,$idCarpeta) {
    $query = SQLite::getInstance()->prepare("update TbCarpeta set Descripcion=:descripcion
                       where IdCarpeta=:idCarpeta");
    $query->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
    $query->bindValue(':idCarpeta', $idCarpeta, PDO::PARAM_INT);
    return $query->execute();

}

function delete_Carpeta($idCarpeta) {
    $query = SQLite::getInstance()->prepare("delete from TbCarpeta where IdCarpeta =:idCarpeta");
    $query->bindValue(':idCarpeta', $idCarpeta, PDO::PARAM_INT);
    return $query->execute();

}

function get_carpetas($idUsuario,$idCarpetaPadre) {
    $query = SQLite::getInstance()->query('SELECT * FROM TbCarpeta where IdUsuario=:idUsuario and IdCarpetaPadre=:idCarpetaPadre');
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
	$query->bindValue(':idCarpetaPadre', $idCarpetaPadre, PDO::PARAM_INT);

    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function get_DescripcionCarpeta($idCarpeta) {
    $query = SQLite::getInstance()->query("SELECT Descripcion FROM TbCarpeta where IdCarpeta=:idCarpeta");
	 $query->bindValue(':idCarpeta', $idCarpeta, PDO::PARAM_INT);
     $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

//Compartir
function compartir_Grupo($idGrupo,$idUsuario,$idDocumento) {
    $query = SQLite::getInstance()->prepare("insert into TbDocumentosCompartidos (IdUsuario, IdDocumento)
                                             select idUsuario, :idDocumento
                                             from tbUsuariosXgrupo
                                             where idGrupo = :idGrupo and idUsuario <> :idUsuario");

    $query->bindValue(':idGrupo', $idGrupo, PDO::PARAM_INT);
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $query->bindValue(':idDocumento', $idDocumento, PDO::PARAM_INT);
    return $query->execute();
}
function compartir_Usuario($idUsuario,$idDocumento) {
    $query = SQLite::getInstance()->prepare("insert into TbDocumentosCompartidos (IdUsuario, IdDocumento)
                                             values (:idUsuario, :idDocumento)");
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $query->bindValue(':idDocumento', $idDocumento, PDO::PARAM_INT);
    return $query->execute();
}

function get_archivosCompartidos($idUsuario) {
    $query = SQLite::getInstance()->query('Select * from TbDocumento where IdDocumento in (select IdDocumento from TbDocumentosCompartidos where IdUsuario =:idUsuario)');
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

//Archivos
function add_Archivo($FechaCreacion,$Archivo,$Descripcion,$IdCarpetaPadre,$Extension,$idUsuario) {
    $query = SQLite::getInstance()->prepare("Insert Into TbDocumento(FechaCreacion,Archivo,Descripcion,IdCarpeta,Extension,IdUsuario)
                       values (:fechaCreacion,:archivo,:descripcion,:idCarpetaPadre,:extension,:idUsuario)");
    $query->bindValue(':descripcion', $Descripcion, PDO::PARAM_STR);
    $query->bindValue(':archivo', $Archivo, PDO::PARAM_STR);
    $query->bindValue(':fechaCreacion', $FechaCreacion, PDO::PARAM_STR);
    $query->bindValue(':extension', $Extension, PDO::PARAM_STR);
    $query->bindValue(':idCarpetaPadre', $IdCarpetaPadre, PDO::PARAM_INT);
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
    return $query->execute();
    
}

function delete_Archivo($idArchivo) {
    $query = SQLite::getInstance()->prepare("delete from TbDocumento where IdDocumento =:IdDocumento");
    $query->bindValue(':IdDocumento', $idArchivo, PDO::PARAM_INT);
    return $query->execute();

}

function get_archivos($idCarpeta) {
    $query = SQLite::getInstance()->query('SELECT * FROM TbDocumento where IdCarpeta=:idCarpeta');
    $query->bindValue(':idCarpeta', $idCarpeta, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function get_archivosXusuario($idUsuario) {
    $query = SQLite::getInstance()->query('SELECT * FROM TbDocumento where IdUsuario=:idUsuario');
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


function get_archivosMiUnidad($idUsuario) {
    $query = SQLite::getInstance()->query('SELECT * FROM TbDocumento where IdCarpeta=0 and IdUsuario = :idUsuario');
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function edit_Archivo($descripcion,$idDocumento) {
    $query = SQLite::getInstance()->prepare("update TbDocumento set Descripcion=:descripcion
                       where IdDocumento=:idDocumento");
    $query->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
    $query->bindValue(':idDocumento', $idDocumento, PDO::PARAM_INT);
    return $query->execute();

}

//Grupos
function get_integrantes($idGrupo) {
    $query = SQLite::getInstance()->query('SELECT * FROM tbUsuario where idUsuario in(select idUsuario from tbUsuariosXgrupo where idgrupo=:idGrupo)');
    $query->bindValue(':idGrupo', $idGrupo, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function get_grupos($idUsuario) {
    $query = SQLite::getInstance()->query("select * from TbGrupo where IdAdministrador = :idUsuario");
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function get_integrante($idIntegrante) {
    $query = SQLite::getInstance()->query('SELECT * FROM tbUsuario where idUsuario =:idIntegrante');
    $query->bindValue(':idIntegrante', $idIntegrante, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function add_integrante($idGrupo, $idUsuario) {
    $query = SQLite::getInstance()->prepare('insert into TbUsuariosXgrupo(IdUsuario,IdGrupo)
											values(:idUsuario,:idGrupo)');
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
	$query->bindValue(':idGrupo', $idGrupo, PDO::PARAM_INT);
   return $query->execute();
}
function edit_Grupo($descripcion,$idGrupo) {
    $query = SQLite::getInstance()->prepare("update TbGrupo set Descripcion=:descripcion
                       where IdGrupo=:idGrupo");
    $query->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
    $query->bindValue(':idGrupo', $idGrupo, PDO::PARAM_INT);
    return $query->execute();

}
function delete_Integrante($idUsuario,$idGrupo) {
    $query = SQLite::getInstance()->prepare("delete from tbUsuariosXgrupo
											where idUsuario = :idUsuario and idGrupo = :idGrupo");
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
	$query->bindValue(':idGrupo', $idGrupo, PDO::PARAM_INT);
    return $query->execute();

}
function delete_Grupo($idGrupo) {
    $query = SQLite::getInstance()->prepare("delete from TbGrupo where IdGrupo =:idGrupo");
    $query->bindValue(':idGrupo', $idGrupo, PDO::PARAM_INT);
    return $query->execute();

}
function add_Grupo($descripcion,$idUsuario) {
    $query = SQLite::getInstance()->prepare("insert into TbGrupo (Descripcion,IdAdministrador)
                       values (:descripcion,:idUsuario)");
    $query->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
    return $query->execute();
}

//Etiquetas
function get_archivoXetiqueta($idetiqueta) {
    $query = SQLite::getInstance()->query('SELECT * FROM TbDocumento where IdDocumento in(SELECT IdArchivo FROM TbEtiquetasXArchivo where IdEtiqueta=:idetiqueta)');
    $query->bindValue(':idetiqueta', $idetiqueta, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function get_etiquetas() {
    $query = SQLite::getInstance()->query("SELECT * FROM TbEtiqueta");
    return $query->fetchAll();
}

function get_etiquetas_user($idUsuario){
    $query = SQLite::getInstance()->query("SELECT * FROM TbEtiqueta where IdUsuario=:idUsuario");
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function add_etiqueta($descripcion,$idusuario){
     $query = SQLite::getInstance()->prepare('insert into TbEtiqueta(Descripcion,IdUsuario)
                                            values(:descripcion,:idusuario)');
    $query->bindValue(':descripcion', $descripcion, PDO::PARAM_STR);
    $query->bindValue(':idusuario', $idusuario, PDO::PARAM_INT);
   return $query->execute();
}
function link_etiqueta($idarchivo,$idetiqueta){
    $query = SQLite::getInstance()->prepare('insert into TbEtiquetasXArchivo(IdArchivo,IdEtiqueta)
                                            values(:idarchivo,:idetiqueta)');
    $query->bindValue(':idarchivo', $idarchivo, PDO::PARAM_INT);
    $query->bindValue(':idetiqueta', $idetiqueta, PDO::PARAM_INT);
   return $query->execute();
}
function registro_anterior_etiAr($idarchivo,$idetiqueta) {
    $query = SQLite::getInstance()->query('SELECT * FROM TbEtiquetasXArchivo where IdArchivo =:idarchivo and IdEtiqueta=:idetiqueta');
    $query->bindValue(':idarchivo', $idarchivo, PDO::PARAM_INT);
    $query->bindValue(':idetiqueta', $idetiqueta, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
function remove_aso_etiquetas($idEtiqueta){

}
function remove_etiqueta($idEtiqueta){
    $query = SQLite::getInstance()->prepare("delete from TbEtiqueta where IdEtiqueta =:idEtiqueta");
    $query->bindValue(':idEtiqueta', $idEtiqueta, PDO::PARAM_INT);
    return $query->execute();
}
/*Seguridad*/
function validar_usuario($idUsuario, $contrasenna) {
    $query = SQLite::getInstance()->query('SELECT * FROM TbUsuario where NombreUsuario =:idUsuario and Contrasenna=:contrasenna');
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_STR);
    $query->bindValue(':contrasenna', strval($contrasenna), PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function get_usuarios($idUsuario) {
    $query = SQLite::getInstance()->query('Select * from tbUsuario where idUsuario <> :idUsuario');
     $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
function validar_usurio_reg($nombreUsu) {
    $query = SQLite::getInstance()->query('SELECT * FROM TbUsuario where NombreUsuario =:$nombreUsu');
    $query->bindValue(':$nombreUsu', $nombreUsu, PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function add_usuario($nombreUsu, $contrasenna) {
    $query = SQLite::getInstance()->prepare('insert into TbUsuario(NombreUsuario,Contrasenna)
                                            values(:nombreUsu,:contrasenna)');
    $query->bindValue(':nombreUsu', $nombreUsu, PDO::PARAM_STR);
    $query->bindValue(':contrasenna', $contrasenna, PDO::PARAM_STR);
    return $query->execute();
}
/*Filtro*/
function filtrar_Compartidos($idUsuario, $filtro) {
    $query = SQLite::getInstance()->query('Select * from TbDocumento where Descripcion like "%'.$filtro.'%" and IdDocumento in (select IdDocumento from TbDocumentosCompartidos where IdUsuario =:idUsuario)');
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function filtrar_Unidad($idUsuario, $filtro) {
    $query = SQLite::getInstance()->query('SELECT * FROM TbDocumento where Descripcion like "%'.$filtro.'%" and IdUsuario = :idUsuario');
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function mover_Archivo($idCarpetaPadre,$idDocumento) {
    $query = SQLite::getInstance()->prepare("update TbDocumento set IdCarpeta=:idCarpetaPadre
                       where IdDocumento=:idDocumento");
    $query->bindValue(':idCarpetaPadre', $idCarpetaPadre, PDO::PARAM_INT);
    $query->bindValue(':idDocumento', $idDocumento, PDO::PARAM_INT);
    return $query->execute();

}


function get_archivoEspecifico($idDocumento) {
    $query = SQLite::getInstance()->query('SELECT * FROM TbDocumento where IdDocumento=:idDocumento');
    $query->bindValue(':idDocumento', $idDocumento, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
function get_carpetasUser($idUsuario) {
    $query = SQLite::getInstance()->query('SELECT * FROM TbCarpeta where IdUsuario=:idUsuario');
    $query->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);

    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}