<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../utils.php');
  if(!$_SESSION['_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }

  $userid = $_SESSION['_userid'];
  //查询数据库
  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  $stmt = $pdo->prepare('SELECT email, nickname, job, company, intro, avatar FROM users WHERE userid=:userid;');
  $stmt->bindParam(':userid', $userid);
  $is_ok = $stmt->execute();

  if(!$is_ok){
    $stmt = null;
    Utils::json(0, '查询数据库失败', 'db query error');
  }

  $row = $stmt->fetch(PDO::FETCH_OBJ);
  if(!$row){
    $stmt = null;
    Utils::json(0, '没有查询到数据', 'db query error');
  }
  $stmt = null;
  Utils::json(1, '查询成功', $row);

?>
