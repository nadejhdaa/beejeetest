<?php

session_start();
 
function check_msg() { 
  $output = '';
  if (!empty($_SESSION['msg'])) {
    foreach ($_SESSION['msg'] as $key => $msg_item) {
      $class = !empty($msg_item['type']) ? $msg_item['type'] : 'alert-info';
      $output .= '<div class="alert '. $class .'" id="msg-flash" role="alert"><p><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg_item['msg'] . '</p></div>'; 
    }
  }
  unset($_SESSION['msg']);
  print $output;
}


function isLoggedIn(){
  if (isset($_SESSION['username'])) {
    return true;
  } else {
    return false;
  }
}

function redirect( $page = ''){
  header('Location: ' . $page);
}

function pagerLink($page) {
  $link = $page == 0 ? '/' : '?page=' . $page;

  if (!empty($_GET['sortBy'])) {
    $order = $_GET['order'];
    $sort = $_GET['sortBy'];
    $link .= '&sortBy=' . $sort . '&order=' .  $order;
  }
  return $link;
}

function sortLink($sort) {
  $get = [];
  $get = $_GET;
  $order = (!empty($_GET['order']) && $_GET['order'] == 'ASC') ? 'DESC' : 'ASC';
  $get['order'] = $order;
  $get['sortBy'] = $sort; 
  foreach ($get as $key => $value) {
    $arr[] = $key . '=' . $value;
  }
  $link = '?' . implode('&', $arr);
  return $link;
}