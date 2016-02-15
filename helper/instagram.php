<?php

class Instagram {

	public $clientId = 'c0661960027049a7ab053a66b8d061d2';
	public $clientSecret = 'e6aa2cfef7dc463ea96cdbed8156bce7';
	public $accessToken = '36227137.c066196.e3b124fa9c544d1183d34a49f7126c94';
	public $redirectURI = 'http://test.meat.dev';
	
	private function _callInstagram($url){
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => 2
		));

		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	private function _getSig($endpoint, $params, $secret) {
		$sig = $endpoint;
		ksort($params);
		foreach ($params as $key => $val) {
			$sig .= "|$key=$val";
		}
		return hash_hmac('sha256', $sig, $secret, false);
	}

	public function getData(){

		$results = array();
		$url = 'https://api.instagram.com/oauth/authorize/?client_id=' . $this->clientId . '&redirect_uri=' . $this->redirectURI . '&response_type=token';
		echo $url;
		echo '<br>';
		$inst_stream = $this->_callInstagram($url);
		print_r($inst_stream);
		echo '<br>';

		// $secret = '6dc1787668c64c939929c17683d7cb74';

		// echo $sig;

		$tag = 'meat';
		// $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$this->clientId . '&client_secret='.$this->clientSecret . '&access_token=36227137.c066196.e3b124fa9c544d1183d34a49f7126c94';

		$endpoint = 'tags/meat/media/recent';
		$params = array(
			'access_token' => $this->accessToken,
			'count' => 10,
		);
		$sig = $this->_getSig($endpoint, $params, $secret);

		$url = 'https://api.instagram.com/v1/tags/meat/media/recent?access_token=' . $this->accessToken . '&sig='.$sig;

		echo $url;
		$inst_stream = $this->_callInstagram($url);
		$results = json_decode($inst_stream, true);

		print_r($results);

		return $results;
		//Now parse through the $results array to display your results... 
		// foreach($results['data'] as $item){
		//     $image_link = $item['images']['low_resolution']['url'];
		//     echo '<img src="'.$image_link.'" />';
		// }	
	}

	

	
}