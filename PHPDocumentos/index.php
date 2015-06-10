<?php

/*MANEJO DE SESIÓN GLOBAL*/
session_start();

/*HANDLERS REQUERIDOS*/
require("handlers/categories_handler.php");
require("handlers/items_handler.php");
require("handlers/unidad_handler.php");
require("handlers/login_handler.php");
require("handlers/singout_handler.php");
require("handlers/carpeta_handler.php");
require("handlers/grupo_handler.php");
require("handlers/grupos_handler.php");
require("handlers/integrante_handler.php");
require("handlers/etiquetas_handler.php");
require("handlers/admCarpeta_handler.php");
require("handlers/admArchivo_handler.php");
require("handlers/cVArchivos_handler.php");
require("handlers/compartido_handler.php");
require("handlers/compartir_handler.php");
require("handlers/filtroArchivos_handler.php");
require("handlers/admGrupos_handler.php");
require("handlers/addIntegrante_handler.php");
require("handlers/mc_handler.php");
require("handlers/cVArchivosCheck_handler.php");
/*LIBRERIAS REQUERIDAS*/
require("lib/markdown.php");
require("lib/sqlite.php");
require("lib/queries.php");
require("lib/toro.php");
require ("lib/Mustache/Autoloader.php");

/*CONFIGURACIÓN MUSTACHE*/
Mustache_Autoloader::register();
$options =  array('extension' => '.html');
$mstch = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/views', $options),
));

/*CONFIGURACIÓN TORO*/
ToroHook::add("404", function() {
    echo "Not found";
});

Toro::serve(array(
    "/PHPDocumentos/" => "LoginHandler",
    "/PHPDocumentos/SingOut/" => "SingOutHandler",
    "/PHPDocumentos/MiUnidad/" => "UnidadHandler",
    "/PHPDocumentos/Carpeta/:alpha" => "CarpetaHandler",
    "/PHPDocumentos/MisGrupos/:alpha" => "GrupoHandler",
    "/PHPDocumentos/AdmGrupo/" => "AdminGrupoHandler",
    "/PHPDocumentos/AdmGrupo/:alpha" => "AdminGrupoHandler",
    "/PHPDocumentos/MisEtiquetas/" => "EtiquetasHandler",
    "/PHPDocumentos/MisEtiquetas/:alpha" => "EtiquetasHandler",
    "/PHPDocumentos/Integrante/:alpha" => "IntegranteHandler",
    "/PHPDocumentos/Integrante/:alpha,:alpha" => "IntegranteHandler",
    "/PHPDocumentos/AdmCarpeta/" => "AdminCarpetaHandler",
    "/PHPDocumentos/AdmCarpeta/:alpha" => "AdminCarpetaHandler",
    "/PHPDocumentos/AdmArchivo/" => "AdminArchivoHandler",
    "/PHPDocumentos/AdmArchivo/:alpha" => "AdminArchivoHandler",
    "/PHPDocumentos/Compartido/" => "CompartidoHandler",
    "/PHPDocumentos/Compartir/" => "CompartirHandler",
    "/PHPDocumentos/cvArch/" => "CambiarVistaArchivosHandler",
    "/PHPDocumentos/cvArch/:alpha" => "CambiarVistaArchivosHandler",
    "/PHPDocumentos/cvArchCheck/" => "CambiarVistaArchivosCheckHandler",
    "/PHPDocumentos/filtro/:alpha" => "FiltroArchivosHandler",  
    "/PHPDocumentos/MisGrupos/" => "GrupoHandler",
      "/PHPDocumentos/AddIntegrante/" => "addIntegranteHandler",
      "/PHPDocumentos/Grupo/:alpha" => "GruposHandler",
  "/PHPDocumentos/MC/" => "MCHandler",

));
