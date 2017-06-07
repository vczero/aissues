<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../utils.php');
  if(!$_SESSION['_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }

  $bookid = Utils::xss($_REQUEST['bookid']);
  $bookname = $_REQUEST['bookname'];
  $bookdesc = Utils::xss($_REQUEST['bookdesc']);
  $type = Utils::xss($_REQUEST['type']);
  $repost = Utils::xss($_REQUEST['repost']);

  if(!$bookid || !$bookname || !$bookdesc || !$type){
    Utils::json(0, '字段不全', 'null value');
  }

  if(!$repost){
    $repost = 0;
  }

  $isvtype = 0;
  $types = ['前端', '后端', 'iOS', 'Android', '运维', '移动端'];
  foreach ($types as $vtype){
    if($vtype == $type){
      $isvtype = 1;
    }
  }
  if(!$isvtype){
    Utils::json(0, '小书类型字段不合法', 'inv value');
  }

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }
  $userid = $_SESSION['_userid'];
  $sql = <<<EOF
    UPDATE books SET bookname=:bookname, bookdesc=:bookdesc, type=:type, repost=:repost
    WHERE userid=:userid AND bookid=:bookid;
EOF;

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':userid', $_SESSION['_userid']);
  $stmt->bindParam(':bookid', $bookid);
  $stmt->bindParam(':bookname', $bookname);
  $stmt->bindParam(':bookdesc', $bookdesc);
  $stmt->bindParam(':type', $type);
  $stmt->bindParam(':repost', $repost);

  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '小书简介更新失败', 'query error');
  }else{
    $stmt = null;
    Utils::json(1, '小书简介更新成功', 'success');
  }

?>