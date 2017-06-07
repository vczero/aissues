<?php
  /*
   * 根据userid 获取小书数据
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

  //查询小书
  $stmt = $pdo->prepare('SELECT bookname, bookid, bookimg, type, time,bookdesc  from books WHERE userid=:userid AND ispost=1');
  $stmt->bindParam(':userid', $userid);
  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '获取小书内容失败', 'query error');
  }

  $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
  if(!$rows){
    $stmt = null;
    Utils::json(0, '请确认当前的user id是否正确', 'query error');
  }
  $stmt = null;

  Utils::json(1, '查询成功', $rows);

?>