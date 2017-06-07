<?php
  /*
  * 获取分类图书，设置分页
  *
  * */
  session_start();
  header('Content-Type: application/json; charset=utf8');
  header('Access-Control-Allow-Origin: *');
  require_once('./../utils.php');

  //获取页数
  $page = $_REQUEST['page'];
  $type = $_REQUEST['type'];
  if(!$page) $page = 1;
  $page = (int)$page;
  if($page < 1){
    $page = 1;
  }
  //这里设定每页20条数据
  $num = 30;

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  //第2步，查询总条数
  $stmt_total = $pdo->prepare('SELECT bookname FROM books WHERE type=:type;');
  $stmt_total->bindParam(':type', $type);
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
        SELECT bookname, bookid, bookimg,time,bookdesc,userid,type
        FROM books 
        WHERE type=:type and ispost=1
        order by time desc
        limit :offset,:num 
EOF;
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':type', $type);
  $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
  $stmt->bindParam(':num', $num, PDO::PARAM_INT);
  $is_ok = $stmt->execute();


  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '查询图书失败', 'query error');
  }

  $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
  if(!$rows){
    $stmt = null;
    Utils::json(0, '还没有图书', 'query error');
  }
  $stmt = null;
  Utils::json(1, '查询成功', $rows);

?>