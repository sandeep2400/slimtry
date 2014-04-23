<?php
	require __DIR__.'/../config/DBConnect.php';

	class DbTest extends PHPUnit_Framework_TestCase
	{
		public function testconnect()
		{
			try
				{
					$connection = new Mongo('mongodb://localhost', array(
								    'username' => DB_Username,
								    'password' => DB_Password 
								    ));
					$db = $connection->selectDB('slimtry');
					echo ('connected');
				}
			catch(Exception $e)
				{
					echo ('Error Connecting to the Database: '. $e->getMessage().PHP_EOL);
				}
		}		
	}
?>