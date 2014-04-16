<?php
require ('Config.php');
	class DbConnect
	{
		private $connection;
		public function __construct()
		{

		}

		public function connect()
		{
			$connection = new Mongo();
			$connection_str = sprintf();
			$m = new MongoClient("mongodb://localhost", array("username" => DB_Username, "password" => DB_Password));


			$connecting_string =  sprintf('mongodb://%s:%d/%s', $hosts, $port,$database),
$connection=  new Mongo($connecting_string,array('username'=>$username,'password'=>$password));
			try
			{
				return();
			}
			catch()
			{

			}
		}
	}
?>