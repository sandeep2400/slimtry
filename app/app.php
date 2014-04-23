<?php
	require 'vendor/autoload.php';
	require __DIR__.'/../config/DBConnect.php';

	use League\Monga;

	$app->get('/hello/:name', function($name) use ($app) {
		echo 'Hello '.$name;
	});


	$app->get('/', function() use ($app){
		echo "hello duder";	
	});

	//get a user based on the name of the user
	$app->get('/user/:name', function($name) use ($app)
	{	
		//connect to the Database
		$dbconnect = new DbConnect();
		$slimtryDB = $dbconnect->connect('slimtry');
		
		//Retrieve the collection
		$users = $slimtryDB->selectCollection('users');
		
		//Query the database
		$results = $users->findOne(array(
				'fname'=>$name
				));
		
		if ($results) 
		{
			echo json_encode($results);
		}
		else
		{
			$message = array(
					'status'=>'204',
					'message'=>"No user found"
				);
			echo json_encode($message);
		}
	});
//------------ Add User -----------------------------------------
	$app->post('/users', function() use ($app)
	{
		$isPost = $app->request->isPost();
		if ($isPost)
		{
			$body = json_decode($app->request->getBody());
			if($body)
			{
				//connect to the Database
				$dbconnect = new DbConnect();
				$slimtryDB = $dbconnect->connect('slimtry');

				//retrieve the collection
				$users = $slimtryDB->selectCollection('users');

				$newuser = array(
						'fname'=>$body->fname,
						'lname'=>$body->lname,
						'email'=>$body->email,
						'contact'=>$body->contact					
					);
				$users->insert($newuser);
				$message = array(
					'status' => '200',
					'message'=> "New user was successfully added"
					);
				echo json_encode($message);
			}
		}
		else
		{
			$message = array(
				'status' => '403',
				'message'=> "Bad request"
				);
			echo json_encode($message);
		}
	});
?>