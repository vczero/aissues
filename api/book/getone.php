<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../utils.php');
  if(!$_SESSION['_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }

  $book_id = $_REQUEST['book_id'];

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }
  //查询书名
  $userid = $_SESSION['_userid'];
  $stmt = $pdo->prepare('SELECT * from books WHERE userid=:userid AND bookid=:bookid');
  $stmt->bindParam(':userid', $userid);
  $stmt->bindParam(':bookid', $book_id);
  $is_ok = $stmt->execute();
  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '查询图书失败', 'query error');
  }

  $row = $stmt->fetch(PDO::FETCH_OBJ);
  if(!$row){
    $stmt = null;
    Utils::json(0, '你目前还没有创建图书', 'query error');
  }
  $stmt = null;

  Utils::json(1, '查询成功', $row);

?>