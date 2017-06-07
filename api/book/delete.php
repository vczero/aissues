<?php
  session_start();
  header('Content-Type: application/json; charset=utf8');
  require_once('./../utils.php');
  if(!$_SESSION['_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }
  $bookid = $_REQUEST['bookid'];
  $userid = $_SESSION['_userid'];
  $stmt = $pdo->prepare('delete from books WHERE userid=:userid AND bookid=:bookid');
  $stmt->bindParam(':userid', $userid);
  $stmt->bindParam(':bookid', $bookid);
  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '小书删除失败', 'query error');
  }

  if($stmt->rowCount() < 1){
    $stmt = null;
    Utils::json(0, 'book id 输入有误', 'query error');
  }

  $stmt = null;
  Utils::json(1, '删除成功', 'success');

?>