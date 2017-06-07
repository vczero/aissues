<?php
  /*
   * 获取banner信息
   *
   * */
  session_start();
  header('Content-Type: application/json');
  header('Access-Control-Allow-Origin: *');
  require_once('./../../api/utils.php');

  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  $sql = <<<EOF
        select * from ads 
        order by time desc
        limit 0,:num
EOF;

  $stmt = $pdo->prepare($sql);
  $num = $_REQUEST['num'];

  if(!$num || (int)$num < 0 || (int)$num > 5){
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