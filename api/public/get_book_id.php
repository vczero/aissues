<?php
  /*
   * 跟传入的一个图书的ID数组，获取图书信息
   *
   * */
  session_start();
  header('Content-Type: application/json; charset=utf8');
  header('Access-Control-Allow-Origin: *');
  require_once('./../utils.php');

  $bookids = $_POST['bookids'];

  
  if(!$bookids){

    $data = file_get_contents("php://input");
    try{
      $bookids = json_decode($data)->bookids;
    }catch(Exception $e){
      Utils::json(0, '传入参数有误', $data);
    }
  }

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  $condi_sql = 'SELECT bookname,bookid,bookimg from books WHERE';
  for($i = 0; $i < count($bookids); $i++){
    if($i + 1 == count($bookids)){
      $condi_sql .= " bookid='".$bookids[$i]."'";
    }else{
      $condi_sql .= " bookid='".$bookids[$i]."' or";
    }
  }

  $stmt = $pdo->prepare($condi_sql);
  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '查询图书失败', 'query error');
  }

  $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
  if(!$rows && !$stmt->rowCount()){
    $stmt = null;
    Utils::json(0, '没有查询到该图书', 'query error');
  }
  $stmt = null;
  Utils::json(1, '查询成功', $rows);

?>