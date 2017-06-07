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
  $stmt = $pdo->prepare('SELECT * from books WHERE userid <> :userid and isrecommend=1 and ispost=1  order by time desc limit 10,10');
  $stmt->bindParam(':userid', $userid);
  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '查询图书失败', 'query error');
  }

  $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
  if(!$rows){
    $stmt = null;
    Utils::json(0, '目前没有推荐的图书', 'query error');
  }
  $stmt = null;
  Utils::json(1, '查询成功', $rows);

?>