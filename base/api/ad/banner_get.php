<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../../../api/utils.php');
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
  $sql = <<<EOF
      select * from ads 
      order by time desc
      limit 0,:num
EOF;

  $stmt = $pdo->prepare($sql);
  $num = $_REQUEST['num'];
  if(!$num || $num < 0){
    $num = 1;
  }
  $num = (int)$num;
  $stmt->bindParam(':num', $num, PDO::PARAM_INT);

  if($stmt->execute() && $stmt->rowCount()){
    $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
    $stmt = null;
    Utils::json(1, '获取banner成功', $rows);
  }else{
    $stmt = null;
    Utils::json(0, '获取banner失败', 'query error');
  }

?>