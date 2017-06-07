<?php
  /*
   * 用户注册
   * （1）校验参数
   * （2）查询数据库
   * （3）插入数据
   * */
  session_start();
  header('Content-Type: application/json; charset=utf-8');
  require_once('./../utils.php');

  //获取请求的数据
  $email    = Utils::xss($_REQUEST['email']);
  $password = Utils::xss($_REQUEST['password']);
  $code     = Utils::xss($_REQUEST['code']);

  //判空处理
  if(!$email || !$password || !$code){
    Utils::json(0, '字段不能为空', 'field must has value');
  }

  //密码大于6位
  if(strlen($password) < 6){
    Utils::json(0, '密码必须至少6位', 'password length < 6');
  }

  //判断邮箱格式
  function pregEmail($test){
    $reg = '/^[a-zA-Z0-9][a-zA-Z0-9._-]*\@[a-zA-Z0-9]+\.[a-zA-Z0-9\.]+$/A';
    preg_match($reg,$test,$result);
    return $result;
  }
  if(count(pregEmail($email)) == 0){
    Utils::json(0, '邮件格式错误', 'email format error');
  }

  //读取验证码
  //register_captcha_code
  $code_register = $_SESSION['_register_code'];
  if($code != $code_register){
    Utils::json(0, '验证码错误，请输入正确的验证码', 0);
  }

  //读取数据库
  $pdo = null;
  try{
    $pdo = DBHelp::getInstance()->connect();
  }catch (PDOException $e){
    Utils::json(0, '数据连接异常', 'db link error');
  }

  $query_stmt = $pdo->prepare('SELECT * FROM users WHERE email =:email');
  $query_stmt->bindParam(':email', $email);
  $is_ok = $query_stmt->execute();
  if(!$is_ok){
    $query_stmt = null;
    Utils::json(0, '无法取到数据结果或者查询失败', 'result null');
  }
  foreach ($query_stmt->fetchAll(PDO::FETCH_OBJ) as $row){
    if($row->email == $email){
      $query_stmt = null;
      Utils::json(0, '该邮箱已被注册，可以直接登录', 'email was be registered');
    }
  }


  //注册——写入数据库
  //加密密码
  $password = Utils::encodePassword($email, $password);
  //设置时区
  date_default_timezone_set("Asia/Shanghai");
  $localtime = date('y-m-d H:i:s',time());
  $userid = Utils::guid();

  $insert_stmt = $pdo->prepare("INSERT users(email, password, type, userid, time, ip) VALUES(:email, :password, 'user', :userid, :time, :ip)");

  $insert_stmt->bindParam(':email', $email);
  $insert_stmt->bindParam(':password', $password);
  $insert_stmt->bindParam(':userid', $userid);
  $insert_stmt->bindParam(':time', $localtime);
  $insert_stmt->bindParam(':ip', Utils::getIP());

  if($insert_stmt->execute() && $insert_stmt->rowCount()){
    $insert_stmt = null;
    $_SESSION['_userid'] = $userid;
    $_SESSION['_username'] = $email;
    $_SESSION['_email'] = $email;
    Utils::json(1, '恭喜你，注册成功', 'success');
  }else{
    $insert_stmt = null;
    Utils::json(0, '服务出现异常，无法注册，请稍后再试', 'insert db error');
  }







  
