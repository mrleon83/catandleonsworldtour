<?php 
class Posts extends Controller{
	public function __construct(){
		//only if want to show blogs to people that are logged in only
		if(!loggedIn()){
			//
			redirect('/index');
		}
		$this->postModel = $this->model('post');
		$this->userModel = $this->model('User');
	}

	public function index(){
		$posts = $this->postModel->getPosts();
		$countries = $this->postModel->getCountries();
		$data = [
			'posts' => $posts,
			'countries' => $countries
		];
		$this->view('posts/index', $data);
	}

	public function add(){
		$countries = $this->postModel->getCountries();
		$sub_country = $this->postModel->getSubCountries();

		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			//file upload , maybe put this in a function and call from add script
			$fileExtensions =['jpeg', 'jpg', 'png'];
			$targetDir = APPROOT . "/uploads";
			$targetFile = $targetDir . basename($_FILES['file_upload']['name']);
			$fileTmpName = $_FILES['file_upload']['tmp_name'];
			$fileName = $_FILES['file_upload']['name'];
			$fileNameSql = trim($_POST['title'] . "_image");
			
			$fileExtension = explode('.', $fileName);
			//upload these to image db
			$fileLocation =  'uploads/' . $fileName;

			if(in_array($fileExtension['1'], $fileExtensions)){
				$upload_file = move_uploaded_file($fileTmpName, "$targetDir/$fileName");
			}

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
				'title' => trim($_POST['title']),
				'body' => trim($_POST['body']),
				'user_id' => $_SESSION['user_id'],
				'privacy' => $_POST['privacy'],
				'country' => $_POST['country'],
				'sub_country' => $_POST['sub_country'],
				'title_err' => '',
				'body_err' => '',
				'countries' => $countries,
				'sub_countries' => $sub_country
			];


			if(empty($data['title'])){
				$data['title_err'] = 'Please enter a title';
			}
			if(empty($data['body'])){
				$data['body_err'] = 'Please enter the blog body text';
			}

			if(empty($data['title_err']) && empty($data['body_err'])){
				//validated
				if($this->postModel->addPost($data)){
					$blogid = (int)$this->postModel->getLastPostId();

					$data2 = [
						'fileName' => $fileName,
						'fileLocation' => $fileLocation,
						'blog_id' => $blogid
					];
					$this->postModel->addImage($data2);
					redirect('posts');
				}else
				die('Something went wrong');
			}else{
				var_dump($_FILES);
				$this->view('posts/add', $data);
			}
		}

		else{
		$data = [
			'title' => '',
			'body' => '',
			'file_upload' => '',
			'privacy' => '',
			'country' => '',
			'countries' => $countries,
			'sub_countries' => $sub_country
		];
		$this->view('posts/add', $data);	
		}
	}

    public function edit($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'title' => trim($_POST['title']),
          'body' => trim($_POST['body']),
          'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'body_err' => ''
        ];

        // Validate data
        if(empty($data['title'])){
          $data['title_err'] = 'Please enter title';
        }
        if(empty($data['body'])){
          $data['body_err'] = 'Please enter body text';
        }

        // Make sure no errors
        if(empty($data['title_err']) && empty($data['body_err'])){
          // Validated
          if($this->postModel->updatePost($data)){
            flashMessage('post_message', 'Post Updated');
            redirect('posts');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('posts/edit', $data);
        }

      } else {
        // Get existing post from model
        $post = $this->postModel->getPostById($id);

        // Check for owner
        if($post->user_id != $_SESSION['user_id']){
          redirect('posts');
        }

        $data = [
          'id' => $id,
          'title' => $post->title,
          'body' => $post->body
        ];
  
        $this->view('posts/edit', $data);
      }
    }

    public function delete($id){
    	if($_SERVER['REQUEST_METHOD'] == 'POST'){
    		if($this->postModel->deletePost($id)){
    			flashMessage('post_message', 'Post Removed');
    			redirect('posts');
    		}else{
    			die('Something gone wrong');
    		}
    	}else{
    		redirect('post');
    	}
    }

	public function show($id){
		$post = $this->postModel->getPostById($id);
		$user = $this->userModel->getUserById($post->user_id);
		$data = [
			'post' => $post,
			'user' => $user
		];
		$this->view('posts/show', $data);
	}

	public function add_country(){
		$countries = $this->postModel->getCountries();
		$sub_country = $this->postModel->getSubCountries();
		if($_SERVER['REQUEST_METHOD'] == 'POST'){


			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
				'select_country' => $_POST['select_country'],
				'country_input' => $_POST['country_input'],
				'select_subcountry' => $_POST['select_subcountry'],
				'subcountry_input' => $_POST['subcountry_input']
			];

          // Validated
		if($_POST['select_country'] == 'new'){
			$this->postModel->addCountry($data);
			$this->postModel->addSubCountry($data);
			redirect('posts');
		}
          else if($_POST['select_country'] != 'new'){
			$this->postModel->addSubCountry($data);
            redirect('posts');
          } else {
            die('Something went wrong');
          }
      }else{
				$data =[
				'countries' => $countries,
				'sub_country' => $sub_country
			];

		$this->view('posts/add_country', $data);
		}

	}

	public function add_dates(){
		$countries = $this->postModel->getCountries();
		$sub_country = $this->postModel->getSubCountries();
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
				'select_country' => $_POST['select_country'],
				'select_subcountry' => $_POST['select_subcountry'],
				'datefrom' => $_POST['datefrom'],
				'dateto' => $_POST['dateto']
			];
          // Validated
		if($this->postModel->add_Dates($data)){
			redirect('posts');
		} else {
            die('Something went wrong');
          }
      }else{
				$data =[
				'countries' => $countries,
				'sub_country' => $sub_country
			];

		$this->view('posts/add_dates', $data);
		}

	}

}