<?php

class Instagram {

    public $clientId = 'c0661960027049a7ab053a66b8d061d2';
    public $clientSecret = 'e6aa2cfef7dc463ea96cdbed8156bce7';
    public $accessToken = '36227137.c066196.3afbcd6552054148a8dc7548fb550b1c';
    public $redirectURI = 'http://test.meat.dev';
    public $tag = 'meat';
		
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

        $instagram = array();
	$results = array();

	$url = 'https://api.instagram.com/v1/tags/' . $this->tag . '/media/recent?access_token=' . $this->accessToken ;
        
        $inst_stream = $this->_callInstagram($url);

        $results = json_decode($inst_stream, true);
	
	if($results->meta->code == 200){
            if(count($results->data) > 0){
                foreach ($results->data as $value) {
                    if($value->type === 'image'){
                        $image = $value->images->standard_resolution->url;
                        $instagram[] = [
                            'type' => 'instagram',
                            'content' => $image . ' + ' . $value->caption->text, 
                            'date' => date('d/m/Y h:i:s', $value->caption->created_time), 
                            'likes' => $value->likes->count,
                        ];
                    }
                }
            }
        }

	return $instagram;
    }

		

		
}