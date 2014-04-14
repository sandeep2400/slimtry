<?php

	$app->get('/hello/:name', function($name) use ($app) {
		echo 'Hello '.$name;
	});


	$app->get('/', function() use ($app){
		echo "hello duder";
	});

	//get a user
	$app->get('/user/:id', function($id) use ($app)
	{
		echo 'hello'.$id;
	});

?>