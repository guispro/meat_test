<?php

// use Helper\twitter;

class Post {

	public function index(){
		echo "Hello world";
		$twitter = new Twitter;
		$instagram = new Instagram;

		echo "<pre>";
		print_r($twitter->postByHaktash());
		echo "</pre>";

		echo "<pre>";
		print_r($instagram->getData());
		echo "</pre>";
		

	}

	public function likes(){
		echo "This could be likes";
	}
}