<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app['companyReview'] = function($app) {
	return new \CompanyReview\CompanyReview();
};


$app->get('/avgRatings', function() use ($app){
	$file = $app['companyReview']->getCompaniesAvrRatings();
	return new Response($file);
});

$app->get('/company/{string}', function($string) use ($app){
	$string = $app['companyReview']->getCompany($string);
	return new Response($string);
});

//This is just a test route, please ingore it
$app->get('/test', function() use ($app){
	return new \Symfony\Component\HttpFoundation\Response("This is a test page, for test purpose only.");
});

$app->run();
