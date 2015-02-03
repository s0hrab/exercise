<?php
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/*
 * Uncomment the following when using the built in webserver in php 5.4
 */
//$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
//if (php_sapi_name() === 'cli-server' && is_file($filename)) {
//    return false;
//}

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

//Examples
$app->get('/', function () {
    return 'Welcome to the excersise';
});

$app->get('/hello', function (Application $app) {
    return $app['twig']->render('hello.twig', array(
        'name' => '',
    ));
});

$app->get('/hello/{name}', function (Application $app, $name) {
    return $app['twig']->render('hello.twig', array(
        'name' => $name,
    ));
});

$app->post('/hello', function (Application $app, Request $request) {
    $name = $request->get('name');

    return $app['twig']->render('hello.twig', array(
        'name' => $name,
    ));
});

$app->run();
