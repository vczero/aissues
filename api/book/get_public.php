<?php
  session_start();
  /*
   * 获取用户公开的所有小书，按照时间倒序
   *
   * */
  header('Content-Type: application/json; charset=utf8');
  require_once('./../utils.php');

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }
  $userid = $_REQUEST['userid'];

  $stmt = $pdo->prepare('SELECT bookid,bookname,bookimg from books WHERE ispost=1 AND userid=:userid  order by time desc;');
  $stmt->bindParam(':userid', $userid);
  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '查询图书失败', 'query error');
  }

  $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
  if(!$rows){
    $stmt = null;
    Utils::json(0, '目前您还未发布任何图书', 'query error');
  }
  $stmt = null;
  Utils::json(1, '查询成功', $rows);

?>