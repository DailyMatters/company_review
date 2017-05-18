<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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

$app->post('/review', function(Request $request) use ($app){

	$review = $request->request->get("review");
	$string = $app['companyReview']->addNewReview($review);
	return new Response($string);
});

$app->get('/moreReviews/{string}', function($string) use ($app){
	$string = $app['companyReview']->getMoreReviews($string);
	return new Response($string);
});

$app->run();
