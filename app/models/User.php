<?php
class User{
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function register($data){
		$this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
		$this->db->bindValues(':name', $data['name']);
		$this->db->bindValues(':email', $data['email']);
		$this->db->bindValues(':password', $data['password']);
		if($this->db->execute())
		{
			return true;
		}else{return false;}
	}

	public function getUserByEmail($email){
		$this->db->query('SELECT * FROM users WHERE email = :email');
		$this->db->bindValues(':email', $email);
		$row = $this->db->getResultSingle();

		if($this->db->getRowCount() > 0 ){
			return true;
		}else{
			return false;
		}
	}

	public function getUserById($id){
		$this->db->query('SELECT * FROM users WHERE id = :id');
		$this->db->bindValues(':id', $id);
		$row = $this->db->getResultSingle();

		if($this->db->getRowCount() > 0 ){
			return $row;
		}else{
			return false;
		}
	}

	public function login($email, $password){
		$this->db->query('SELECT * FROM users WHERE email = :email');
		$this->db->bindValues(':email', $email);

		$row = $this->db->getResultSingle();

		$hashed_password = $row->password;

		if(password_verify($password, $hashed_password)){
			return $row;
		}else{
			return false;
		}
	}
}