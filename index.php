<?php
	//composer autoload
	require 'vendor/autoload.php';
	$composer = json_decode(file_get_contents('composer.json'));

//	$_ENV['SLIM_MODE'] = 'development';
	//instantiating the SLIM constructor
	$app = new \Slim\Slim(array(
			'mode' => 'development' //dev mode
			));
	// configuration for Production environment
	$app->configureMode('production', function() use ($app){
		$app->config(array(
			'log.enable'=>true,
			'debug'=>false,
			'cookies.encrypt'=>true
			));
	});

	// configuration for development environment
	$app->configureMode('development', function() use ($app){
		$app->config(array(
			'log.enable'=>true,
			'debug'=>true,
			'log.level' => \Slim\Log::DEBUG
			));
	});

	require 'app/app.php';

	$app->run();
?>