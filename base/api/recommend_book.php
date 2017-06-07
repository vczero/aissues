<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../../api/utils.php');
  if(!$_SESSION['_admin_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }

  $admin_userid = $_SESSION['_admin_userid'];
  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }
  //管理员权限校验
  $stmt_admin = $pdo->prepare('select email from admin WHERE userid=:userid');
  $stmt_admin->bindParam(':userid', $admin_userid);

  if(!$stmt_admin->execute()){
    Utils::json(0, '你没有登录，不具备管理员权限', 'db admin query error');
  }
  $stmt_admin = null;

  $bookid = $_REQUEST['bookid'];
  //更新用户信息
  $stmt = $pdo->prepare('UPDATE books SET isrecommend=1 WHERE bookid=:bookid;');
  $stmt->bindParam(':bookid', $bookid);

  $is_ok = $stmt->execute();
  if(!$is_ok){
    $stmt = null;
    Utils::json(0, '更新数据失败', 'update data error');
  }
  $stmt = null;

  Utils::json(1, '该小书已被推荐', 'update data successfully');

?>