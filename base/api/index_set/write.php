<?php

  //确保文件有读写权限
  session_start();
  header('Content-Type: application/json');
  require_once('./../../../api/utils.php');

  //管理员权限校验
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

  $stmt_admin = $pdo->prepare('select email from admin WHERE userid=:userid');
  $stmt_admin->bindParam(':userid', $admin_userid);

  if(!$stmt_admin->execute()){
    Utils::json(0, '你没有登录，不具备管理员权限', 'db admin query error');
  }
  $stmt_admin = null;

  try{
    $data = $_REQUEST['books'];
    $json_string = json_encode($data);

    $myfile = fopen("./books.json", "w") or die("Unable to open file!");
    fwrite($myfile, $json_string);
    fclose($myfile);

    Utils::json(1, '写入配置文件成功','write success');
  }catch(Exception $e){
    Utils::json(0, '写入文件失败','write error');
  }

?>