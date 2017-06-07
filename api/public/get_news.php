<?php
  /*
   * 获取最新的7条新闻，时间倒排
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

  $stmt = $pdo->prepare('SELECT title, newsid, time  from news order by time desc limit 0, 10');
  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '查询新闻失败', 'query error');
  }

  $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
  if(!$rows){
    $stmt = null;
    Utils::json(0, '目前还没有新闻', 'query error');
  }
  $stmt = null;
  Utils::json(1, '查询成功', $rows);

?>