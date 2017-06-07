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
  $stmt = $pdo->prepare('delete from news WHERE newsid=:newsid');
  $stmt->bindParam(':newsid', $newsid);
  $is_ok = $stmt->execute();

  if(!$is_ok){
    $stmt = null;
    Utils::json(0, '文章删除失败', 'query error');
  }

  if($stmt->rowCount() < 1){
    $stmt = null;
    Utils::json(0, 'news id 输入有误', 'query error');
  }

  $stmt = null;
  Utils::json(1, '删除成功', 'success');

?>