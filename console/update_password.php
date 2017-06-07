<?php
session_start();
//没有登录直接重定向
if(!$_SESSION['_userid']){
  header('Location: /');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('../ui/meta.php') ?>
  <title>控制台</title>
  <style type="text/css" rel="stylesheet">
    .main_view{
      width:100%;
      position: absolute;
      top:55px;
      left:0;
      right:0;
      bottom: 0;
      font-size:13px;
      color: #FFFFFF;
    }
    .main_right{
      background-color:#fff;
      position: absolute;
      left:175px;
      right:0;
      top:1px;
      bottom:0;
      color: #000;
    }
    .container{
      width:1000px;
      height:400px;
      margin-left:40px;
    }
    .user_hr{
      height:40px;
      line-height: 40px;
      margin-top:40px;
      padding-left:10px;
      border-left:8px solid #E7505A !important;
      border-bottom: 1px solid #ddd;
      margin-bottom: 50px;
    }
    .container input{
      border:1px solid #ddd !important;
      height:30px;
      width:350px;
      padding-left:5px;
      border-radius:3px;
      font-size: 14px;
    }
    .user_item{
      margin-top:20px;
      height:30px;
      line-height:30px;
    }
    .user_text{
      width:65px;
      display: inline-block;
    }
    .save_btn{
      width:200px;
      height:38px;
      line-height:38px;
      background-color: #E7505A;
      color:#fff;
      text-align: center;
      border-radius: 3px;
      cursor: pointer;
      display: block;
      margin-top:40px;

    }
  </style>
</head>
<body>
<?php require_once('../ui/console/header.php');?>
<div class="main_view">
  <?php require_once('../ui/console/menu.php')?>
  <div class="main_right fl">
    <div class="container">
      <div class="user_hr">
        修改密码
      </div>
      <div class="user_item">
        <span class="user_text">原始密码</span>
        <span>
        <input id="password" type="password" placeholder="请输入原始密码"/>
      </span>
      </div>

      <div class="user_item">
        <span class="user_text">新密码</span>
        <span>
        <input id="new_password" type="password" placeholder="至少6位"/>
      </span>
      </div>

      <div class="user_item">
        <span class="user_text">确认密码</span>
        <span>
        <input id="second_password" type="password" placeholder="请重新确认密码"/>
      </span>
      </div>

      <div class="save_btn">
        确认修改
      </div>
    </div>

    <script type="text/javascript">
      var password = $('#password');
      var new_password = $('#new_password');
      var second_password = $('#second_password');

      $('.save_btn').on('click', function () {
        var obj = {
          password: password.val(),
          new_password: new_password.val(),
          second_password: second_password.val()
        };

        $.post('/api/user/update_password.php', obj, function (data) {
          if(data.status){
            var infoWindow = new Alert('提示', '更新密码成功', function () {
              location.reload();
            });
            infoWindow.show();
          }else{
            var infoWindow = new Alert('提示', data.info);
            infoWindow.show();
          }
        });
      });
    </script>
  </div>
</div>
<?php include_once('../ui/cnzz.php');?>
</body>
</html>

