<?php

require("handlers/categories_handler.php");
require("handlers/items_handler.php");
require("handlers/detail_handler.php");
require("lib/markdown.php");
require("lib/sqlite.php");
require("lib/queries.php");
require("lib/toro.php");
require ("lib/Mustache/Autoloader.php");
Mustache_Autoloader::register();
$options =  array('extension' => '.html');
$mstch = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/views', $options),
));

ToroHook::add("404", function() {
    echo "Not found";
});

Toro::serve(array(
    "/" => "CategoriesHandler",
    "/category/:alpha" => "ItemsHandler",
    "/category/:alpha/:alpha" => "DetailHandler"
));
