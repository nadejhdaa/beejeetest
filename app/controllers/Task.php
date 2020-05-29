<?php 

class Task extends Controller {
	private $db;
   
	public function __construct() {
		$this->db = new Database(); 
  }


	public function create() {
		$data['title'] = 'Создать задачу';
		if($_SERVER['REQUEST_METHOD']=='POST') {
			$_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
			$data['name'] = trim($_POST['name']);
			$data['email'] = trim($_POST['email']);
			$data['body'] = trim(strip_tags($_POST['body']));
			$data['status'] = !empty(trim($_POST['body'])) ? trim($_POST['body']) : 1;
		 
			if( empty($data['name']) ){
				$data['name_err'] = 'Please enter the title';
			}

			if( empty($data['email']) ){
				$data['email_err'] = 'Please enter the Email';
			}
			else {
				if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
					$data['email_err'] = 'Email is invalid';
				}
			}

			if( empty($data['body']) ){
				$data['body_err'] = 'Please enter the body';
			}   

			if (empty($data['name_err']) && empty($data['body_err']) && empty($data['email_err'])){
				if ($this->addTask($data)) {
					$msg = [
						[
							'type' => 'alert-success',
							'msg' => 'Task <strong>"' . $data['name'] . '"</strong> has been added',
						],
					];
					$_SESSION['msg'] = $msg;
					redirect('/');
				}
			}
			else {
				$msg = [
					[
						'type' => 'alert-danger',
						'msg' => 'Something went wrong',
					],
				];
				$_SESSION['msg'] = $msg;
			}
		}
		
		$this->view('create_task_page', $data);
	}


	public function addTask($data) {
		$this->db->query('INSERT INTO tasks (name, mail, body, status, created, edited) values (:name, :email, :body, :status, :created, :edited)');

		$this->db->bind(':name', $data['name']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':body', $data['body']);
		$this->db->bind(':status', 0);
		$this->db->bind(':created', time());
		$this->db->bind(':edited', 0);
		
		if($this->db->execute()){
			return TRUE;
		} else {
			return FALSE;
		}
	}
 

	public function getTasks() {
		$chunk = 3;
		$page = !empty($_GET['page']) ? $_GET['page'] : 0;

		$sort = 'order by t.created desc';
		if (!empty($_GET['sortBy'])) {
			if (!empty($_GET['order']) && $_GET['order'] == 'ASC') {
				$sort = 'order by t.' .$_GET['sortBy']. ' ASC';
			}
			else if (!empty($_GET['order']) && $_GET['order'] == 'DESC') {
				$sort = 'order by t.' .$_GET['sortBy']. ' DESC';
			}
		}

		$this->db->query('select t.id, t.name, t.mail, t.body, t.status, t.created, t.edited from tasks t ' . $sort);
		
		$result = $this->db->resultSet();
		$rows = array_chunk($result, $chunk);

		$data = [
			'pages' => range(0, count($rows)),
			'rows' => $rows[$page],
		];

		return $data;
	}


	public function edit() {
		if (!isLoggedIn()) {
			if (empty($_SESSION)) {
				$this->createSession();
			}
			$_SESSION['msg'][] = [
				'type' => 'alert-danger',
				'msg' => 'You are not allowed to create tasks'
			];
			redirect('/');
		}
		$id = !empty($_GET['id']) ? $_GET['id'] : '';

		if (!empty($id)) { 
			$task = $this->getTaskById($id);
			$data['task'] = $task;  
		}

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

			$data['id'] =  trim($_POST['id']);
			$data['body'] = trim(strip_tags($_POST['body']));
			$data['status'] = !empty($_POST['status']) ? 1 : 0;
			 
			if ($this->updateTask($data)) {
				$msg = [
					'type' => 'alert-success',
					'msg' => 'Task [' . $id . '] has been updated',
				];
				$_SESSION['msg'][] = $msg;
				redirect('/');
			}
			else {
				$msg = [
					'type' => 'alert-success',
					'msg' => 'Someting went wrong',
				];
				$_SESSION['msg'][] = $msg;
			}
		}

		$this->view('taskeditpage', $data);

	}

	public function updateTask($data) {
		$this->db->query('UPDATE tasks SET status = :status, body = :body, edited = 1 where id = :id');

		$this->db->bind(':body', $data['body']);
		$this->db->bind(':status', $data['status']); 
		$this->db->bind(':id', $data['id']); 
		
		if( $this->db->execute() ){
			return true;
		} else {
			return false;
		}
	}


	public function getTaskById($id) {
		$this->db->query('select * from tasks where id = :id');
		$this->db->bind(':id', $id);
			
		$result = $this->db->single();
		return $result;
	}

}