<?php
//namespace testcases;

	require('testConfig.php'); // contains variables for testing the URLS;
//	require('/curl/Curlobj.php');

	class UserTest extends PHPUnit_Framework_TestCase
	{
		public function testurl()
	    {
		    $URL = \TEST\URL;
			$this->assertEquals('http://localhost/slimtry/',$URL, 'This is OK');
//			$this->assertEquals(2,$curlid, 'Ids do not match');	

	    }		
//testcase to check the get 1 user end-point
		public function testgetUser()
	    {
		    $URL = \TEST\URL;
		    $curlobj = new \curl\curlobj();
		    $url = $URL.'/user/1';
		    $data = $curlobj->curlurl($url);

/*		    curl_setopt_array($curl, array(
		    	CURLOPT_RETURNTRANSFER=>1,
		    	CURLOPT_URL=>$URL.'/user/1'
		    	));
		    $response = curl_exec($curl);
		    curl_close($curl);	
*/		    $response = json_decode($data);
		    $this->assertEquals($response->id,1, 'This is a match');
//			$this->assertEquals(2,$curlid, 'Ids do not match');	
	    }		
	}
?>