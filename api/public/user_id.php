<?php
  /*
   * 根据用户ID，查询用户信息
   *
   *
   * */
  session_start();
  header('Content-Type: application/json');
  header('Access-Control-Allow-Origin: *');
  require_once('./../utils.php');

  $userid = $_REQUEST['userid'];

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  $stmt = $pdo->prepare('SELECT userid, nickname, job, intro, company, time, avatar from users WHERE userid=:userid');
  $stmt->bindParam(':userid', $userid);
  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '获取用户信息失败', 'query error');
  }

  $row = $stmt->fetch(PDO::FETCH_OBJ);
  if(!$row){
    $stmt = null;
    Utils::json(0, '请传入一个正确的user id', 'query error');
  }
  $stmt = null;

  Utils::json(1, '查询成功', $row);

?>