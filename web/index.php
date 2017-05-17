<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app['companyReview'] = function($app) {
	return new \CompanyReview\CompanyReview();
};


$app->get('/file', function() use ($app){
	$file = $app['companyReview']->getData();
	return new Response($file);
});

//This is just a test route, please ingore it
$app->get('/test', function() use ($app){
	return new \Symfony\Component\HttpFoundation\Response("This is a test page, for test purpose only.");
});

$app->run();
