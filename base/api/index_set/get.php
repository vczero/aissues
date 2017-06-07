<?php
  header('Content-Type: application/json');
  header('Access-Control-Allow-Origin: *');
  require_once('./../../../api/utils.php');

  try{
    $json_string = file_get_contents('./books.json');
    $data = json_decode($json_string, true);
    Utils::json(1, '读取推荐小书成功' , $data);
  }catch(Exception $e){
    Utils::json(0, '读取推荐小书服务异常' , 'exception');
  }

?>