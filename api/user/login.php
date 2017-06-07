<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../utils.php');
  $email    = $_REQUEST['email'];
  $password = $_REQUEST['password'];
  $code     = $_REQUEST['code'];

  //校验
  if(!$email || !$password || !$code){
    Utils::json(0, '字段不能为空', 'field must have value');
  }

  $captcha_code = $_SESSION['_captcha_code'];
  if($code != $captcha_code){
    Utils::json(0, '验证码错误', 'verify code error');
  }

  $email = Utils::xss($email);
  $password = Utils::xss($password);

  //查询数据库--登录
  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }
  //加密密码
  $password = Utils::encodePassword($email, $password);
  $query_stmt = $pdo->prepare('SELECT email, userid, nickname, is_close from  users WHERE email=:email AND password=:password;');

  $query_stmt->bindParam(':email', $email);
  $query_stmt->bindParam(':password', $password);

  $is_ok = $query_stmt->execute();
  if(!$is_ok){
    $query_stmt = null;
    Utils::json(0, '无法取到数据结果或者查询失败', 'result null');
  }

  $row = $query_stmt->fetch(PDO::FETCH_OBJ);

  //没有查询到数据
  if(!$row){
    $query_stmt = null;
    Utils::json(0, '用户名或者密码错误', 'username & password error');
  }

  if($row->is_close){
    Utils::json(0, '对不起，你已被禁言，请找管理员', 'user close');
  }

  //查询到了数据，写入session
  $_SESSION['_userid'] = $row->userid;
  $_SESSION['_email'] = $row->email;
  $_SESSION['_username'] = $row->nickname;
  if(!$row->nickname){
    $_SESSION['_username'] = $row->email;
  }

  $query_stmt = null;
  Utils::json(1, '登录成功', $row);

?>
