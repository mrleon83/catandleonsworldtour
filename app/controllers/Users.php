<?php
class users extends Controller{
	public function __construct(){
		$this->userModel = $this->model('User');
	}

	public function register(){
		//check for post
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			//sanitize

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'name' => trim($_POST['name']),
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),
				'confirm_password' => trim($_POST['confirm_password']),
				'name_err' => '',
				'email_err' => '',
				'password_err' => '',
				'confirm_password_err' => ''
			];

			//validation
			if(empty($data['email'])){
				$data['email_err'] = 'Please enter email';
			}else{
				if($this->userModel->getUserByEmail($data['email'])){
					$data['email_err'] = 'Email is already used!';
				}
			}

			if(empty($data['name'])){
				$data['name_err'] = 'Please enter name';
			}

			if(empty($data['password'])){
				$data['password_err'] = 'Please enter password';
			}elseif(strlen($data['password'] < 6)){
				//$data['password_err'] = 'Password must be at least 6 characters';
			}

			if(empty($data['confirm_password'])){
				$data['confirm_password_err'] = 'Please confirm password';
			}elseif($data['password'] != $data['confirm_password']){
				$data['password_err'] = 'Passwords do not match';
			}

			//check for errors
			if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
				//password hash
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

				if($this->userModel->register($data)){
					flashMessage('register_success', 'You are registered and can login');
					redirect('users/login');
				}else{die('oops- something ent wrong');}
			}else{
				$this->view('users/register', $data);
			}

		}
		else{
			//init data
			$data = [
				'name' => '',
				'email' =>'',
				'password' => '',
				'confirm_password' => '',
				'name_err' => '',
				'email_err' => '',
				'password_err' => '',
				'confirm_password_err' => ''
			];
			//load view
			$this->view('users/register', $data);
		}
	}

	public function login(){
		//check for post
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),
				'email_err' => '',
				'password_err' => ''
			];

			//validation
			if(empty($data['email'])){
				$data['email_err'] = 'Please enter email';
			}

			if(empty($data['password'])){
				$data['password_err'] = 'Please enter password';
			}elseif(strlen($data['password'] < 6)){
				//$data['password_err'] = 'Password must be at least 6 characters ';
			}
			if($this->userModel->getUserByEmail($data['email'])){
				//userfound
				$loggedInUser = $this->userModel->login($data['email'], $data['password']);
				if($loggedInUser){
					$this->createUserSession($loggedInUser);

				}else{
					$data['password_err'] = 'Password incorrect';
					$this->view('users/login', $data);
				}
			}else{
				$data['email_err'] = 'No User found';
			}
			
			//check for errors
			if(empty($data['email_err']) && empty($data['password_err'])){
			}else{
				$this->view('users/login', $data);
			}
		}
		else{
			//init data
			$data = [
				'email' =>'',
				'password' => '',
				'email_err' => '',
				'password_err' => '',
			];
			//load view
			$this->view('users/login', $data);
		}
	}
	public function createUserSession($user){
		$_SESSION['user_id'] = $user->id;
		$_SESSION['user_name'] = $user->name;
		$_SESSION['user_email'] = $user->email;
		redirect('posts');
	}

	public function logout(){
		unset($_SESSION['user_id']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_name']);
		session_destroy();
		redirect(URLROOT);
	}

}