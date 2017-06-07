<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../../api/utils.php');
  if(!$_SESSION['_admin_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }

  $newsid = Utils::xss($_REQUEST['newsid']);
  $title = $_REQUEST['title'];
  $author = Utils::xss($_REQUEST['author']);
  $content = $_REQUEST['content'];
  $keywords =  Utils::xss($_REQUEST['keywords']);
  $type =  Utils::xss($_REQUEST['type']);
  $imgurl = $_REQUEST['imgurl'];

  if(!$title || !$author || !$type || !$content || !$keywords){
    Utils::json(0, '字段不能为空', 'field must has value');
  }

  //type分类校验
  //  $isvtype = 0;
  //  $types = ['科技', '互联网', 'iOS', 'Android', '运维', 'weex', '开源项目', 'JavaScript', 'CSS',
  //    'Java', 'Go', 'React Native', 'Swift', 'H5', '后端', '产品', '管理', '专访', '本站新闻'];
  //  foreach ($types as $vtype){
  //    if($vtype == $type){
  //      $isvtype = 1;
  //    }
  //  }
  //  if(!$isvtype){
  //    Utils::json(0, '小书类型字段不合法', 'inv value');
  //  }

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  //$userid = $_SESSION['_admin_userid'];
  date_default_timezone_set("Asia/Shanghai");
  //$localtime = date('y-m-d H:i:s',time());

  //插入数据
  $sql = <<<EOF
    UPDATE news SET title=:title, author=:author, type=:type, content=:content, keywords=:keywords, imgurl=:imgurl WHERE newsid=:newsid;
EOF;


  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':newsid', $newsid);
  //$stmt->bindParam(':userid', $userid);
  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':author', $author);
  $stmt->bindParam(':type', $type);
  //$stmt->bindParam(':time', $localtime);
  $stmt->bindParam(':content', $content);
  $stmt->bindParam(':keywords', $keywords);
  $stmt->bindParam(':imgurl', $imgurl);

  if($stmt->execute() && $stmt->rowCount()){
    $stmt = null;
    Utils::json(1, '文章更新成功', 'article create success');
  }else{

    $stmt = null;
    Utils::json(0, '文章更新失败', 'insert db error');
  }

?>