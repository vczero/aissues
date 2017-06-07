<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../utils.php');
  if(!$_SESSION['_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }

  $bookid = $_REQUEST['bookid'];
  $userid = $_SESSION['_userid'];

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  //先查询content是否大于650
  $stmt_content = $pdo->prepare('select content, bookimg from books WHERE userid=:userid AND bookid=:bookid;');
  $stmt_content->bindParam(':userid', $_SESSION['_userid']);
  $stmt_content->bindParam(':bookid', $bookid);
  if($stmt_content->execute()){
    $content = $stmt_content->fetch(PDO::FETCH_OBJ);
    $len = strlen($content->content);
    if($len < 650){
      Utils::json(0, '您的小书内容必须大于650个字符', $len);
    }
    if(!$content->bookimg){
      Utils::json(0, '请给您的小书上传一个优美的封面吧', 'no book img');
    }
  }else{
    Utils::json(0, '数据连接异常', '查询content是否大于650异常');
  }

  $stmt = $pdo->prepare('UPDATE books SET ispost=1 WHERE userid=:userid AND bookid=:bookid;');
  $stmt->bindParam(':userid', $_SESSION['_userid']);
  $stmt->bindParam(':bookid', $bookid);

  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '小书隐藏失败，请妥善保管文章', 'query error');
  }else{
    $stmt = null;
    Utils::json(1, '小书隐藏成功', 'success');
  }

?>