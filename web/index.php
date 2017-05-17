<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

//This is just a test route, please ingore it
$app->get('/test', function() use ($app){
	return new \Symfony\Component\HttpFoundation\Response("This is a test page, for test purpose only.");
});

$app->run();
