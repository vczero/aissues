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

  $title = $_REQUEST['title'];
  $link = $_REQUEST['link'];
  $imgurl = $_REQUEST['imgurl'];

  if(!$title || !$link || !$imgurl){
    Utils::json(0, '字段不全', 'no value');
  }
  $adid = Utils::guid();
  $title = Utils::xss($title);
  $link = Utils::xss($link);
  $imgurl = Utils::xss($imgurl);

  date_default_timezone_set("Asia/Shanghai");
  $localtime = date('y-m-d H:i:s',time());

  //插入数据
  $sql = <<<EOF
    INSERT ads(adid, title, link, imgurl, time) 
    VALUES(:adid, :title, :link, :imgurl, :time)
EOF;

  $stmt = $pdo->prepare($sql);

  $stmt->bindParam(':adid', $adid);
  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':link', $link);
  $stmt->bindParam(':imgurl', $imgurl);
  $stmt->bindParam(':time', $localtime);

  if($stmt->execute()){
    $stmt = null;
    Utils::json(1, 'banner创建成功', 'banner create success');
  }else{
    $stmt = null;
    Utils::json(0, 'banner创建失败', 'insert db error');
  }

?>