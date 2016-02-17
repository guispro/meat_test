<?php

// use Helper\twitter;

class Post {

	public function index(){
		$twitter = new Twitter;
		$instagram = new Instagram;

		$twits = $twitter->postByHaktash();

                $instadata = $instagram->getData();

                // $post = $twits;
		$post = array_merge($instadata,$twits);

		usort($post, array($this,'_sortDate'));

		echo json_encode($post);

	}

	public function likes(){
		$twitter = new Twitter;
		$instagram = new Instagram;

		$twits = $twitter->postByHaktash();

		$instadata = $instagram->getData();

                // $post = $twits;
                $post = array_merge($instadata,$twits);

		usort($post, array($this,'_sortLikes'));

		echo json_encode($post);
	}

	private function _sortDate($a, $b){
		return strtotime($a['date']) - strtotime($b['date']);
	}

	private function _sortLikes($a, $b){
		return $a['likes'] - $b['likes'];
	}	
}