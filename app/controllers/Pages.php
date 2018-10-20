<?php 

class Pages extends Controller{
	public function __construct(){
		
	}
	public function index(){
		if(loggedIn()){
			redirect('posts');
		}

		$data = ['title' =>'Cat & Leon\'s World Tour'];
		$this->view('pages/index', $data);

	}

	public function about(){
		$data = ['title' => 'About'];
		$this->view('pages/about', $data);
	}

}

?>