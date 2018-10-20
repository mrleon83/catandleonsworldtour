<?php 
class Blogs extends Controller{
	public function __construct(){
		$this->postModel = $this->model('post');
		$this->userModel = $this->model('User');
	}

	public function index(){
		$posts = $this->postModel->getPosts();

		$data = [
			'posts' => $posts
		];
		$this->view('/pages/blogs/index', $data);
	}




}