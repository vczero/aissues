<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../utils.php');
  if(!$_SESSION['_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }
  $book_name = $_REQUEST['bookname'];
  $book_desc = $_REQUEST['bookdesc'];
  $type = $_REQUEST['type'];
  $repost =  $_REQUEST['repost'];

  if(!$book_name || !$book_desc || !$type){
    Utils::json(0, '字段不能为空', 'field must has value');
  }
  if(!$repost){
    $repost = 0;
  }

  //type分类校验
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

  $book_id = Utils::guid();
  $book_name = $book_name;
  $book_desc = Utils::xss($book_desc);
  $type = Utils::xss($type);
  $repost = Utils::xss($repost);

  $userid = $_SESSION['_userid'];
  date_default_timezone_set("Asia/Shanghai");
  $localtime = date('y-m-d H:i:s',time());

  //插入数据
  $sql = <<<EOF
  INSERT books(userid, bookname, bookdesc, type, time, bookid, repost) 
  VALUES(:userid, :bookname, :bookdesc, :type, :time, :bookid, :repost)
EOF;


  $stmt = $pdo->prepare($sql);

  $stmt->bindParam(':userid', $userid);
  $stmt->bindParam(':bookname', $book_name);
  $stmt->bindParam(':bookdesc', $book_desc);
  $stmt->bindParam(':type', $type);
  $stmt->bindParam(':time', $localtime);
  $stmt->bindParam(':bookid', $book_id);
  $stmt->bindParam(':repost', $repost);

  if($stmt->execute() && $stmt->rowCount()){
    $stmt = null;
    Utils::json(1, '图书创建成功', 'book create success');
  }else{

    $stmt = null;
    Utils::json(0, '图书创建失败', 'insert db error');
  }

?>