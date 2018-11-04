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
								p.id as postid,
								i.file_location as file_location
								FROM posts p 
								INNER JOIN users u ON p.user_id = u.id 
								INNER JOIN images i ON i.blog_id = p.id
								ORDER BY p.created_at DESC');
		$results = $this->db->getResultArray();
		return $results;
	}

	public function getCountries(){
		$this->db->query('SELECT * FROM country ORDER BY country');
		$results = $this->db->getResultArray();
		return $results;
	}

	public function getSubCountries(){
		$this->db->query('SELECT * FROM sub_country sc INNER JOIN country c ON c.id = sc.country_id');
		$results = $this->db->getResultArray();
		return $results;
	}

	public function addPost($data){

		$this->db->query('INSERT INTO posts (title, user_id, body, country_id, sub_country_id, privacy, created_at) VALUES(:title, :user_id, :body, :country_id, :sub_country, :privacy, NOW())');
		$this->db->bindValues(':title', $data['title']);
		$this->db->bindValues(':user_id', $data['user_id']);
		$this->db->bindValues(':body', $data['body']);
		$this->db->bindValues(':country_id', $data['country']);
		$this->db->bindValues(':sub_country', $data['sub_country']);	
		$this->db->bindValues(':privacy', $data['privacy']);	
		if($this->db->execute())
		{
		  return true;
		}else{
			return false;
		}	
	}

	public function getLastPostId(){
		$this->db->query('SELECT MAX(id) as maxid FROM posts');
		$result = $this->db->getResultSingle();
		return $result->maxid;
	}

	public function addImage($data){
		$fileName =  $data['fileName'];
		$fileLocation = $data['fileLocation'];
		$this->db->query('INSERT INTO images (file_location, blog_id) VALUES(:fileLocation, :blog_id)');
		//	$this->db->bindValues(':filename', $fileName );
			$this->db->bindValues(':fileLocation', $fileLocation);
			$this->db->bindValues(':blog_id', $data['blog_id']);
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