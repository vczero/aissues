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

  $newsid = $_REQUEST['newsid'];
  $is_close = $_REQUEST['isclose'];

  $message = '该文章禁止发布';
  if(!$is_close){
    $is_close = 0;
    $message = '该文章恢复发布';
  }
  //更新用户信息
  $stmt = $pdo->prepare('UPDATE news SET is_close=:is_close WHERE newsid=:newsid;');
  $stmt->bindParam(':newsid', $newsid);
  $stmt->bindParam(':is_close', $is_close);

  $is_ok = $stmt->execute();
  if(!$is_ok){
    $stmt = null;
    Utils::json(0, '更新数据失败', 'update data error');
  }
  $stmt = null;

  Utils::json(1, $message, 'update data successfully');

?>