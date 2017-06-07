<?php
  /*
   * 根据小书id获取小书数据
   *
   * */
  session_start();
  header('Content-Type: application/json');
  header('Access-Control-Allow-Origin: *');
  require_once('./../utils.php');

  $book_id = $_REQUEST['bookid'];

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  //查询小书
  $stmt = $pdo->prepare('SELECT * from books WHERE bookid=:bookid AND ispost=1');
  $stmt->bindParam(':bookid', $book_id);
  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '获取小书内容失败', 'query error');
  }

  $row = $stmt->fetch(PDO::FETCH_OBJ);
  if(!$row){
    $stmt = null;
    Utils::json(0, '请确认当前的book id是否正确', 'query error');
  }
  $stmt = null;

  Utils::json(1, '查询成功', $row);

?>