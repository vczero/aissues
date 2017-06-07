<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../utils.php');
  if(!$_SESSION['_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }

  $bookid = $_REQUEST['bookid'];

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }
  $userid = $_SESSION['_userid'];
  $stmt = $pdo->prepare('UPDATE books SET ispost=0 WHERE userid=:userid AND bookid=:bookid;');
  $stmt->bindParam(':userid', $_SESSION['_userid']);
  $stmt->bindParam(':bookid', $bookid);

  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '小书内容保存发布失败，请妥善保管文章', 'query error');
  }else{
    $stmt = null;
    Utils::json(1, '小书内容保存和发布成功', 'success');
  }

?>