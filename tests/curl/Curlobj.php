<?php
namespace curl;
	class Curlobj
	{
//		protected $__url;
		protected $curl;

		public function __construct()
		{
		}

		public function curlget($url)
		{
			$curl = curl_init();
		    curl_setopt_array($curl, array(
		    	CURLOPT_RETURNTRANSFER=>1,
		    	CURLOPT_URL=>$url
		    	));
		    $response = curl_exec($curl);

		    curl_close($curl);
		    return($response);		    
		}

		public function curlpost($url, $data)
		{
			$curl = curl_init();
			
			curl_setopt($curl,CURLOPT_URL, $url);
			curl_setopt($curl,CURLOPT_POST, 1);
			curl_setopt($curl,CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			
			$response = curl_exec($curl);
			curl_close($curl);
			
			return($response);
		}

	}
?>