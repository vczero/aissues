<?php

  session_start();
  header('Content-Type: application/json');
  require_once('./../utils.php');

  echo strlen('1111') > 6;
  if(!$_SESSION['_userid']){
    Utils::json(0, '没有权限', 'No permissions');
  }

  $password = $_REQUEST['password'];
  $new_password = $_REQUEST['new_password'];
  $second_password = $_REQUEST['second_password'];

  if(!$password || !$new_password || !$second_password){
    Utils::json(0, '字段不能为空', 'field must has value');
  }

  if($new_password != $second_password){
    Utils::json(0, '确认密码输入不一致', 'confirm value != new password');
  }

  if(strlen($password) <6 || strlen($new_password) < 6 || strlen($second_password) < 6){
    Utils::json(0, '密码必须至少6位', 'password length < 6');
  }


  $password = Utils::xss($password);
  $new_password = Utils::xss($new_password);
  $second_password = Utils::xss($second_password);

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  //加密密码
  $userid = $_SESSION['_userid'];
  $email = $_SESSION['_email'];
  //新密码编码
  $new_password = Utils::encodePassword($email, $new_password);
  //旧密码编码
  $password = Utils::encodePassword($email, $password);

  //先查询是否存在该用户，检查合法性
  $stmt_query = $pdo->prepare('select email from users WHERE password=:password AND userid=:userid');
  $stmt_query->bindParam(':password', $password);
  $stmt_query->bindParam(':userid', $userid);

  if(!$stmt_query->execute()){
    Utils::json(0, '查询数据库失败', 'query fail');
  }
  $row = $stmt_query->fetch(PDO::FETCH_OBJ);

  if($row->email == $email){
    $stmt_query = null;
    //执行更新
    $stmt_update = $pdo->prepare('update users set password =:new_password WHERE userid=:userid');
    $stmt_update->bindParam(':new_password', $new_password);
    $stmt_update->bindParam(':userid', $userid);
    $is_ok = $stmt_update->execute();
    if(!$is_ok){
      $stmt_update = null;
      Utils::json(0, '密码更新失败', 'update fail');
    }
    $stmt_update = null;
    Utils::json(1, '更新密码成功', 'update password successfully');
  }else{
    Utils::json(0, '没有权限', 'No permissions');
  }

?>