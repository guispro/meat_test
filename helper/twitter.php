<?php

class Twitter {
	
	// public $Haktash = '#meat';

	public function postByHaktash(){
		
		$url = 'https://api.twitter.com/1.1/search/tweets.json';
		$twitter_settings = [
			'oauth_access_token' => "",
		    'oauth_access_token_secret' => "",
		    'consumer_key' => "6rCoxkfmcT3ktViFakYrYdtUg",
		    'consumer_secret' => "TJHssG3VuIcNBbNthA6vgcX4cTNQQWFxRnJq7WFJMBDxTpR5cJ"
		];

		$requestMethod = 'GET';
		$getfield = '?q=%23meat&locale=sp';
		$twitter = new TwitterAPIExchange($twitter_settings);
		$twits = $twitter->setGetfield($getfield)
		             ->buildOauth($url, $requestMethod)
		             ->performRequest();
		$arrayTwits = json_decode($twits);
		foreach ($arrayTwits->statuses as $value) {
			$twitter_response[] = ['text' => $value->text, 'created_at' => $value->created_at, 'likes' => $value->retweet_count];

		}

		// return json_decode($twits);
		return $twitter_response;
	}	
}