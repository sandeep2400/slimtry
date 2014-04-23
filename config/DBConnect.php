<?php

//require ('Config.php');
require __DIR__.'/Config.php';
class DbConnect
{
	private $connection;
	public function __construct()
	{

	}
//Connect to the Database passed in $dbname
	public function connect($dbname)
	{
		try
		{
			$connection = new Mongo('mongodb://localhost', array(
						    'username' => DB_Username,
						    'password' => DB_Password 
						    ));
			$db = $connection->selectDB($dbname);
			return($db);
		}
		catch(Exception $e)
		{
			echo ('Error Connecting to the Database: '. $e->getMessage().PHP_EOL);
		}
	}
}
?>