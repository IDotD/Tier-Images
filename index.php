<?php
ini_set('display_errors',1);
function __autoload($class) {
    require_once __DIR__ . '/Classes/' . str_replace(['De\\Idrinth\\TierImages\\','\\'],['','/'],$class) . '.php';
}
if(!isset($_GET['name'])) {
    die();
}
(new De\Idrinth\TierImages\ImageGenerator())->run($_GET['name']);
