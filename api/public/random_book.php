
<?php

  /*
   * 获取3本小书
   *
   * */
  session_start();
  header('Content-Type: application/json');
  header('Access-Control-Allow-Origin: *');
  require_once('./../utils.php');

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  $stmt = $pdo->prepare("SELECT bookname, bookimg, bookid from books WHERE isrecommend=1 AND ispost=1 limit 10, 3");
  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '获取小书内容失败', 'query error');
  }

  $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
  if(!$rows){
    $stmt = null;
    Utils::json(0, '请确认当前的url是否正确', 'query error');
  }
  $stmt = null;

  Utils::json(1, '查询成功', $rows);

?>