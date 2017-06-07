<?php
  session_start();
  header('Content-Type: application/json');
  require_once('./../../api/utils.php');
  if(!$_SESSION['_admin_userid']){
    Utils::json(0, '没有获取该数据', 'No permissions');
  }

  if ((($_FILES['file']['type']   == 'image/gif')
      || ($_FILES['file']['type'] == 'image/jpeg')
      || ($_FILES['file']['type'] == 'image/pjpeg'))
      || ($_FILES['file']['type'] == 'image/png') && ($_FILES['file']['size'] < 1048577)) {
    if ($_FILES['file']['error'] > 0) {
      Utils::json(0, '服务器端错误', '');
    } else {
      $name = '/images/news/'.strtolower(Utils::guid()).'.'.explode('/', $_FILES['file']['type'])[1];
      $path =  $_SERVER['DOCUMENT_ROOT'].$name;
      $is_ok = move_uploaded_file($_FILES['file']['tmp_name'], $path);
      if($is_ok){
        Utils::json(1, 'success', $name);
      }else{
        Utils::json(0, '图片存储失败', '');
      }
    }
  } else {
    Utils::json(0, '不能超过1M或者文件类型错误', 'error');
  }
?>






