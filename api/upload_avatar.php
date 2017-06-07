<?php
  /*
  * 如果出现错误，确保图片文件夹有读写权限
  *
  */
  session_start();
  header('Content-Type: application/json');
  require_once('./utils.php');

  if(!$_SESSION['_userid']){
    Utils::json(0, '没有登录，没有权限上传', 'No permissions');
  }

  if ((($_FILES['file']['type']   == 'image/gif')
      || ($_FILES['file']['type'] == 'image/jpeg')
      || ($_FILES['file']['type'] == 'image/pjpeg'))
      || ($_FILES['file']['type'] == 'image/png') && ($_FILES['file']['size'] < 1048577)) {
    if ($_FILES['file']['error'] > 0) {
      Utils::json(0, '上传图片失败', 'image upload error');
    } else {
      $name = '/images/avatars/'.strtolower(Utils::guid()).'.'.explode('/', $_FILES['file']['type'])[1];
      $path =  $_SERVER['DOCUMENT_ROOT'].$name;
      $is_ok = move_uploaded_file($_FILES['file']['tmp_name'], $path);
      if($is_ok){
        //TODO:写入数据库
        $pdo = null;
        try{
          $pdo = DBHelp::getInstance()->connect();
        }catch (PDOException $e){
          Utils::json(0, '数据连接异常', 'db link error');
        }
        $stmt = $pdo->prepare('UPDATE users SET avatar=:avatar WHERE userid=:userid;');
        //这里存储的是相对路径
        $stmt->bindParam(':avatar', $name);
        $stmt->bindParam(':userid', $_SESSION['_userid']);

        if($stmt->execute()){
          $stmt = null;
          Utils::json(1, '图片上传成功', $name);
        }else{
          $stmt = null;
          Utils::json(0, '图片上传失败', 'upload error');
        }

      }else{
        Utils::json(0, '图片上传失败', 'image upload error');
      }
    }
  } else {
    Utils::json(0, '图片格式错误或者大于1M，请重新上传', 'image upload error');
  }
?>

