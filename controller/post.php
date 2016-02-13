<?php

// use Helper\twitter;

class Post {

	public function index(){
		echo "Hello world";
		$twitter = new Twitter;

		if (is_object($twitter)){
			echo "<pre>";
			print_r($twitter->postByHaktash());
			echo "</pre>";
		}else{
			echo 'nup';
		}

	}

	public function likes(){
		echo "This could be likes";
	}
}