<?php

require ('Config.php');
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
			$connection = new Mongoclient();
			$db = $connection ->selectDB($dbname);
			return($db);
		}
		catch(Exception $e)
		{
			echo ('Error Connecting to the Database: '. $e->getMessage().PHP_EOL);
		}
	}
}
?>