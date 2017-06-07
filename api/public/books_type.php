<?php
  /*
  * 获取分类图书的最新推荐7本小书
  *
  * */
  session_start();
  header('Content-Type: application/json; charset=utf8');
  header('Access-Control-Allow-Origin: *');
  require_once('./../utils.php');

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  $type = $_REQUEST['type'];
  $stmt = $pdo->prepare("SELECT bookname,bookid, bookimg from books WHERE type=:type AND isrecommend=1 order by time desc limit 0, 7");
  $stmt->bindParam(':type', $type);

  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '查询图书失败', 'query error');
  }

  $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
  if(!$rows){
    $stmt = null;
    Utils::json(0, '还没有图书', 'query error');
  }
  $stmt = null;
  Utils::json(1, '查询成功', $rows);

?>