<?php
	require('/../config/DBConnect.php');


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
		
		//query the database
		$users = $slimtryDB->selectCollection('users');
		
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

?>