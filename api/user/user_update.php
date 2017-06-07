<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../utils.php');
  if(!$_SESSION['_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }

  $nickname = isset($_REQUEST['nickname'])? $_REQUEST['nickname']   : '';
  $company  = isset($_REQUEST['company'])? $_REQUEST['company']     : '';
  $job      = isset($_REQUEST['job']) ? $_REQUEST['job']            : '';
  $intro    = isset($_REQUEST['intro']) ? $_REQUEST['intro']        :'';

  $nickname = Utils::xss($nickname);
  $company = Utils::xss($company);
  $job = Utils::xss($job);
  $intro = Utils::xss($intro);

  $userid = $_SESSION['_userid'];

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  //更新用户信息
  $stmt = $pdo->prepare('UPDATE users SET nickname=:nickname, company=:campany, job=:job, intro=:intro WHERE userid=:userid;');
  $stmt->bindParam(':userid', $userid);
  $stmt->bindParam(':nickname', $nickname);
  $stmt->bindParam(':campany', $company);
  $stmt->bindParam(':job', $job);
  $stmt->bindParam(':intro', $intro);

  $is_ok = $stmt->execute();
  if(!$is_ok){
    $stmt = null;
    Utils::json(0, '更新数据失败', 'update data error');
  }
  $stmt = null;
  Utils::json(1, '更新数据成功', 'update data successfully');

?>