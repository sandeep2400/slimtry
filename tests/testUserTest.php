<?php
//namespace testcases;

	require('testConfig.php'); // contains variables for testing the URLS;
//	require('/curl/Curlobj.php');

	class UserTest extends PHPUnit_Framework_TestCase
	{
		public function testurl()
	    {
		    $URL = \TEST\URL;
			$this->assertEquals('http://localhost/slimtry/',$URL, 'This does not match');
//			$this->assertEquals(2,$curlid, 'Ids do not match');	

	    }		
//testcase to check the get 1 user end-point
		public function testgetexistingUser()
	    {
		    $URL = \TEST\URL;
		    $base_url = $URL.'user/sandeep';

		    //Secure the api call
		    $authobj = new \auth\authobj();
		    $final_url = $authobj->secure($base_url);

		    //use curl to retrieve the data
		    $curlobj = new \curl\curlobj();
		    $data = $curlobj->curlurl($final_url);
	
			//decode the data
		    $response = json_decode($data);
		    $this->assertEquals($response->lname,'gopal', 'This is a match');
	    }		
//test a user that does not exist in the database
		public function testfakeUser()
	    {
		    $URL = \TEST\URL;
		    $base_url = $URL.'user/pinky';

		    //Secure the api call
		    $authobj = new \auth\authobj();
		    $final_url = $authobj->secure($base_url);

		    //use curl to retrieve the data
		    $curlobj = new \curl\curlobj();
		    $data = $curlobj->curlurl($final_url);
			var_dump($data);
			//decode the data
		    $response = json_decode($data);
		    $this->assertEquals($response->status,'204', 'This is a match');
	    }		


	}
?>