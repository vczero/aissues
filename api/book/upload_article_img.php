<?php

  session_start();
  header('Content-Type: application/json');
  require_once('./../utils.php');

  if(!$_SESSION['_userid']){
    Utils::json(0, '没有登录，没有权限上传', 'No permissions');
  }

  if ((($_FILES['file']['type']   == 'image/gif')
      || ($_FILES['file']['type'] == 'image/jpeg')
      || ($_FILES['file']['type'] == 'image/pjpeg'))
      || ($_FILES['file']['type'] == 'image/png') && ($_FILES['file']['size'] < 2097152)) {//2M
    if ($_FILES['file']['error'] > 0) {
      echo "error|服务器端错误";
      exit;
    } else {

      $name = '/images/books/'.strtolower(Utils::guid()).'.'.explode('/', $_FILES['file']['type'])[1];
      $path =  $_SERVER['DOCUMENT_ROOT'].$name;
      $is_ok = move_uploaded_file($_FILES['file']['tmp_name'], $path);
      if($is_ok){
        echo $name;
        exit;
      }else{
        echo "error|服务器端错误";
        exit;
      }
    }
  } else {
    echo "error|不能大于2M";
    exit;
  }
?>

