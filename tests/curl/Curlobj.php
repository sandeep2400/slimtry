<?php
namespace curl;
	class Curlobj
	{
//		protected $__url;
		protected $curl;

		public function __construct()
		{
		}

		public function curlurl($url)
		{
			var_dump($url);
			$curl = curl_init();
		    curl_setopt_array($curl, array(
		    	CURLOPT_RETURNTRANSFER=>1,
		    	CURLOPT_URL=>$url
		    	));
		    $response = curl_exec($curl);

		    curl_close($curl);
		    return($response);		    
		}

	}
?>