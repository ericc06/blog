<?php
require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('view/frontend'); // Dossier contenant les templates
$twig = new Twig_Environment($loader, array(
    'cache' => false
));
