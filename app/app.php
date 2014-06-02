<?php
	require 'vendor/autoload.php';
	require __DIR__.'/../config/DBConnect.php';

	//use League\Monga;

	// $app->get('/hello/:name', function($name) use ($app) {
	// 	echo 'Hello '.$name;
	// });


	// $app->get('/', function() use ($app){
	// 	print_r($app);
	// 	echo "hello duder";	
	// });

	//get a user based on the name of the user
	$app->get('/user/:name', 'getuser');

//------------ Add User -----------------------------------------
	$app->post('/users', function() use ($app)
	{
		$isPost = $app->request->isPost();
		if ($isPost)
		{
			$body = json_decode($app->request->getBody());
			$valid = validate($body);
			if($valid)
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
			else
			{
				$message = array(
					'status' => '402',
					'message'=> "Bad Data - please fix"
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


//CHeck if user exists in the database

	function getuser ($name)
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
		
		if ($results) {
			echo json_encode($results);
		}
		else {
			$message = array(
					'status'=>'204',
					'message'=>"No user found"
				);
			echo json_encode($message);
		}
	}

	function validate($body)
	{
		$valid = validatename($body->fname);
		if (!$valid){return FALSE;} 
		$valid = validatename($body->lname);
		if (!$valid){return FALSE;} 
		if(!filter_var($body->email, FILTER_VALIDATE_EMAIL))
			{return FALSE;}
		$valid = validatephone($body->contact);
		if (!$valid){return FALSE;} 
		return TRUE;
	}	

	function validatename($name)
	{
		$pattern = '/[A-Za-z]/';
		if (preg_match($pattern, $name)) {
			return TRUE;
		}
		else { 
			return FALSE;
		}

	}

	function validatephone($phone)
	{
		$pattern = '/[0-9_-]/';
		if (preg_match($pattern, $phone)) {
			return TRUE;
		}
		else{ 
			return FALSE;
		}

	}	

?>