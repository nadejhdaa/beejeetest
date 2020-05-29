<?php 
	
class User extends Controller {

	public function login() {
		if (empty($_SESSION)) {
			$this->createSession();
		}
			
		if(isLoggedIn()) {
			redirect('/');
		}

		$data['title'] = 'Войти';

		if(isset($_POST['username']) && isset($_POST['password'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			if ($_POST['username'] == 'admin' && $_POST['password'] == '123') {
			  $_SESSION['valid'] = TRUE;
			  $_SESSION['start'] = time();
			  $_SESSION['username'] = $username;
			  $_SESSION['expire'] = $_SESSION['start'] + (120 * 60);
			  header('Location: ../');
			}
			else {
			  $data['username_err'] = 'Неверный login';
			  $data['password_err'] = 'Неверный login';
			  $_SESSION['msg'][] = [
			  	'type' => 'alert-danger',
					'msg' => 'Wrong login or password',
			  ];
			} 
		}
		$this->view('userlogin', $data);
  }

	public function logout() {
		unset($_SESSION["username"]);
		$_SESSION['valid'] = FALSE;
		unset($_SESSION);
		header('Location: ../');
	}

}
