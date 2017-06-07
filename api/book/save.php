<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../utils.php');
  if(!$_SESSION['_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }

  $content = $_REQUEST['content'];
  $bookid = $_REQUEST['bookid'];

//  if(strlen($content) < 200){
//    Utils::json(0, '内容字数不能小于200', 'value length must > 200');
//  }
  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }
  $userid = $_SESSION['_userid'];
  $stmt = $pdo->prepare('UPDATE books SET content=:content WHERE userid=:userid AND bookid=:bookid;');
  $stmt->bindParam(':userid', $_SESSION['_userid']);
  $stmt->bindParam(':bookid', $bookid);
  $stmt->bindParam(':content', $content);

  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '小书内容保存失败，请妥善保管文章', 'query error');
  }else{
    $stmt = null;
    Utils::json(1, '小书内容保存成功', 'success');
  }

?>