<?php
  /*
   * 获取最新的15本小书，时间倒排
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

  $stmt = $pdo->prepare('SELECT bookname,bookid,time from books WHERE ispost=1 order by time desc limit 0, 13');
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