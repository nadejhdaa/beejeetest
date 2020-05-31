<?php

require_once 'Task.php';

class Pages extends Controller {

  public function index(){
    $task = new Task();
    $data = [];
    $data['title'] = 'Задачи';
    $data['isLoggedIn'] = isLoggedIn();
    $data['tasks'] = $task->getTasks();
    $data['username'] = 'admin';

    $this->view('front', $data);
  }

}