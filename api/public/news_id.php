<?php
  /*
   * 根据图书id, 获取图书信息
   *
   *
   * */
  session_start();
  header('Content-Type: application/json');
  header('Access-Control-Allow-Origin: *');
  require_once('./../utils.php');

  $newsid = $_REQUEST['newsid'];

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  //查询新闻
  $stmt = $pdo->prepare('SELECT * from news WHERE newsid=:newsid');
  $stmt->bindParam(':newsid', $newsid);
  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '获取新闻内容失败', 'query error');
  }

  $row = $stmt->fetch(PDO::FETCH_OBJ);
  if(!$row){
    $stmt = null;
    Utils::json(0, '请确认当前的news id是否正确', 'query error');
  }
  $stmt = null;

  Utils::json(1, '查询成功', $row);

?>