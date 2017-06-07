<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../../api/utils.php');
  if(!$_SESSION['_admin_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }

  $userid = $_SESSION['_admin_userid'];
  //获取页数
  $page = $_REQUEST['page'];
  if(!$page) $page = 1;
  $page = (int)$page;
  if($page < 1){
    $page = 1;
  }
  //这里设定每页20条数据
  $num = 20;

  //查询数据库
  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  //第1步，查询管理员表
  $stmt_admin = $pdo->prepare('select email from admin WHERE userid=:userid');
  $stmt_admin->bindParam(':userid', $userid);

  if(!$stmt_admin->execute()){
    Utils::json(0, '你没有登录，不具备管理员权限', 'db admin query error');
  }
  $stmt_admin = null;

  //第2步，查询总条数
  $stmt_total = $pdo->prepare('SELECT bookname FROM books;');
  $res_total = $stmt_total->execute();
  $total = $stmt_total->rowCount();

  //第3步计算总页数
  $pages = ceil($total / $num);

  //第4步，判断传入的页码是否合理
  if($page > $pages){
    Utils::json(0, '传入的页码有误，该页码大于总页数', 'Can Not Found The page');
  }

  //第5步，获取该页数据
  //计算起始位
  $offset = ( $page - 1 ) * $num;
  $sql = <<<EOF
      SELECT bookid,userid,bookname,time,ispost,repost,linkid,type,isrecommend,is_close 
      FROM books order by time desc
      limit :offset,:num 
EOF;
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
  $stmt->bindParam(':num', $num, PDO::PARAM_INT);
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

  //返回结果集
  $obj = new stdClass();
  $obj->rows = $rows;
  $obj->pages = $pages;
  $obj->current = $page;
  $obj->total = $total;

  Utils::json(1, '查询成功', $obj);

?>
