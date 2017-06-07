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
  $userid = $_SESSION['_userid'];
  $stmt = $pdo->prepare('SELECT bookid,bookname,bookimg,bookdesc,type from books WHERE userid=:userid order by time desc');
  $stmt->bindParam(':userid', $userid);
  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '查询图书失败', 'query error');
  }

  $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
  if(!$rows){
    $stmt = null;
    Utils::json(0, '你目前还没有创建图书', 'query error');
  }
  $stmt = null;
  Utils::json(1, '查询成功', $rows);

?>