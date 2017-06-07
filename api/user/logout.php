<?php
  header('Content-Type: application/json; charset=utf-8');
  $_SESSION = array();

  if(isset($_COOKIE[session_name()])){
    setcookie(session_name(), '', time()-1, '/');
  }
  session_destroy();
  require_once('./../utils.php');
  Utils::json(1, '退出登录成功', '');
?>