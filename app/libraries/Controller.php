<?php

class Controller {

  public function view($view, $data = []) {
    if(file_exists('../app/views/' . $view . '.php')) {
      require ('../app/views/' . $view . '.php');
    } else{
      die ('View does not exists');
    }
  }

  public function createSession(){
    session_start();
  }
}