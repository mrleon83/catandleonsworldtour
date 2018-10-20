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
}