<?php

require_once __DIR__.'/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__.'/../views/');
$twig = new Twig_Environment($loader, array(
    //'cache' => __DIR__.'/../cache',
));

$params = ['coins' => []];
$template = 'index.html.twig';

if (isset($_POST['amount'])) {
    if (isset ($_GET['fragment']) && $_GET['fragment'] == 'true') {
        $template = 'coins.html.twig';
    }

    $params['coins'] = (new Nshiell\Wallet())
        ->setAmountRaw($_POST['amount'])
        ->getCoins();

    $params['amount'] = $_POST['amount'];
}

echo $twig->render($template, $params);