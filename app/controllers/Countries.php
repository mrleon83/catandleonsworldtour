<?php 
class Countries extends Controller{
	public function __construct(){
		//only if want to show blogs to people that are logged in only
		if(!loggedIn()){
			redirect('users/login');
		}

		//$this->postModel = $this->model('post');
		//$this->userModel = $this->model('User');
	}

	public function index(){


		$data = [
			'countries' => $countries
		];
		$this->view('countries/index', $data);
	}
