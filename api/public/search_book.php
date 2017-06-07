<?php
  /*
   * 模糊查询：根据书名查询图书信息
   * /api/public/search_book?bookname=mysql
   *
   * */
  session_start();
  header('Content-Type: application/json');
  header('Access-Control-Allow-Origin: *');
  require_once('./../../api/utils.php');

  $bookname = $_REQUEST['bookname'];
  if(!$bookname){
    Utils::json(0, '没有输入查询关键字', 'no keywords');
  }
  //查询数据库
  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  $sql = <<<EOF
      SELECT bookid,bookname,time,repost,type,isrecommend
      FROM books 
      where ispost=1 and bookname like :bookname;
EOF;

  $bookname = '%'.$bookname.'%';
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':bookname', $bookname, PDO::PARAM_STR);
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