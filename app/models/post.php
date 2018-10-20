<?php
class post{
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getPosts(){
		$this->db->query('SELECT u.id AS userid,
								u.name as name, 
								p.user_id as postuserid, 
								p.created_at as created,  
								p.title as title,
								p.body as body,
								p.id as postid
								FROM posts p INNER JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC');

		$results = $this->db->getResultArray();
		return $results;
	}

	public function addPost($data){
		$this->db->query('INSERT INTO posts (title, user_id, body) VALUES(:title, :user_id, :body)');
		$this->db->bindValues(':title', $data['title']);
		$this->db->bindValues(':user_id', $data['user_id']);
		$this->db->bindValues(':body', $data['body']);
		if($this->db->execute())
		{
			return true;
		}else{
			return false;
		}
	}

	public function updatePost($data){
		$this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
		$this->db->bindValues(':id', $data['id']);
		$this->db->bindValues(':title', $data['title']);
		$this->db->bindValues(':body', $data['body']);
		if($this->db->execute())
		{
			return true;
		}else{
			return false;
		}
	}

	public function deletePost($id){
		$this->db->query('DELETE FROM posts WHERE id = :id');
		$this->db->bindValues(':id', $id);
		if($this->db->execute())
		{
			return true;
		}else{
			return false;
		}	
	}

	public function getPostById($id){
		$this->db->query('SELECT * FROM posts WHERE id = :id');
		$this->db->bindValues(':id', $id);
		$row = $this->db->getResultSingle();

		return $row;
	}


}