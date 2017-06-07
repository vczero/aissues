<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../../api/utils.php');
  if(!$_SESSION['_admin_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }

  $userid = $_SESSION['_admin_userid'];

  //查询数据库
  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  $sql = <<<EOF
        SELECT bookid,userid,bookname,time,ispost,repost,linkid,type,isrecommend,is_close 
        FROM books order by time desc
        limit 0,5 
EOF;
  $stmt = $pdo->prepare($sql);
  $is_ok = $stmt->execute();

  if(!$is_ok){
    $stmt = null;
    Utils::json(0, '查询数据库失败', 'db query error');
  }

  $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
  if(!$rows){
    $stmt = null;
    Utils::json(0, '没有查询到数据', 'db query error');
  }
  $stmt = null;
  Utils::json(1, '查询成功', $rows);

?>