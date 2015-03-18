<?php
require_once __DIR__.'/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__.'/../views/');
$twig = new Twig_Environment($loader, array(
    'cache' => __DIR__.'/../views/cache',
));

echo $twig->render('index.html.twig', array('name' => 'Fabien'));