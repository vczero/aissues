<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../utils.php');
  if(!$_SESSION['_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }

  $content = $_REQUEST['content'];
  $bookid = $_REQUEST['bookid'];
  $userid = $_SESSION['_userid'];

  if(strlen($content) < 650){
    Utils::json(0, '内容字数大于650才能发布，请去编辑', 'value length must > 650');
  }

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  //先查询是否有封面
  $stmt_content = $pdo->prepare('select bookimg from books WHERE userid=:userid AND bookid=:bookid;');
  $stmt_content->bindParam(':userid', $userid);
  $stmt_content->bindParam(':bookid', $bookid);
  if($stmt_content->execute()){
    $old_content = $stmt_content->fetch(PDO::FETCH_OBJ);
    if(!$old_content->bookimg){
      Utils::json(0, '请给您的小书上传一个优美的封面吧', 'no book img');
    }
  }else{
    Utils::json(0, '数据连接异常', '查询是否有封面异常');
  }

  $stmt = $pdo->prepare('UPDATE books SET content=:content, ispost=1 WHERE userid=:userid AND bookid=:bookid;');
  $stmt->bindParam(':userid', $userid);
  $stmt->bindParam(':bookid', $bookid);
  $stmt->bindParam(':content', $content);


  $is_ok = $stmt->execute();

  if(!$is_ok ){
    $stmt = null;
    Utils::json(0, '小书内容保存发布失败，请妥善保管文章', 'query error');
  }else{
    $stmt = null;
    Utils::json(1, '小书内容保存和发布成功', 'success');
  }

?>