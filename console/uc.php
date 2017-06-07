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
      color: #000000;
    }
    .user{
      width:1000px;
      min-height:500px;
      margin-left:40px;
    }
    .user_hr{
      height:40px;
      line-height: 40px;
      margin-top:40px;
      padding-left:10px;
      border-left:8px solid #E7505A;
      border-bottom: 1px solid #ddd;
    }
    .user_item{
      margin-top:20px;
      height:30px;
      line-height:30px;
    }
    .user_item input{
      border:1px solid #ddd !important;
      height:30px;
      width:350px;
      padding-left:5px;
      border-radius:3px;
    }
    .user_item_t{
      height:200px;
    }
    .user_item textarea{
      border:1px solid #ddd !important;
      width:600px;
      height:150px;
      padding-left:5px;
      padding-top:5px;
      border-radius:3px;
      resize: none;
    }
    .user_item input[readonly="readonly"]{
      background-color: #E6E4E6;
    }
    .user_item_text{
      display: inline-block;
      width:40px;
    }
    .user_save{
      width:200px;
      height:38px;
      line-height:38px;
      background-color: #E7505A;
      color:#fff;
      text-align: center;
      border-radius: 3px;
      cursor: pointer;
      display: block;
    }
    /*.user_save:hover{*/
    /*background-color:#0166FF;*/
    /*}*/
    .user_avatar{
      border:1px solid #ddd;
      max-height:150px;
      max-width:150px;
      border-radius: 3px;
      position: relative;
      top:-500px;
      left:800px;
      text-align: center;
    }
    .user_avatar img{
      width:140px;
      height:140px;
    }

    .update_password{
      margin-top:70px;
      cursor: pointer;
      color: #0166FF;
      width:80px;
      text-align: center;
      border-bottom: 1px solid #0166FF;
      display: block;
      text-decoration: none;
    }
  </style>
</head>
<body>
<?php require_once('../ui/console/header.php');?>
<div class="main_view">
  <?php require_once('../ui/console/menu.php')?>
  <div class="main_right fl">
    <div class="user">
      <div class="user_hr">
        用户信息修改
      </div>
      <div class="user_item">
        <span class="user_item_text">邮箱</span>
        <span>
      <input id="email" type="text" readonly="readonly" value=""/>
    </span>
      </div>

      <div class="user_item">
        <span class="user_item_text">昵称</span>
        <span>
      <input id="nickname" type="text"/>
    </span>
      </div>

      <div class="user_item">
        <span class="user_item_text">公司</span>
        <span>
      <input id="company" type="text"/>
    </span>
      </div>

      <div class="user_item">
        <span class="user_item_text">岗位</span>
        <span>
      <input id="job" type="text"/>
    </span>
      </div>

      <div class="user_item user_item_t">
        <div>简介</div>
        <div>
          <textarea id="intro" maxlength="200" placeholder="200字以内"></textarea>
        </div>
      </div>

      <a class="user_save">
        保存
      </a>
      <a class="update_password" href="/console/update_password.php">
        去修改密码
      </a>

      <div class="user_avatar">
        <img src="/images/no_avatar.jpg" id="upload"/>
        <input type="file" style="display:none;" id="upload_file"/>
        <div id="upload_tip" style="margin-top: 20px;color:#2A91EC;"></div>
      </div>

    </div>
    <script type="text/javascript">
      //如果没有登录，直接访问/user，则跳转到首页
      <?php
      session_start();
      if(!$_SESSION['_username']){?>
      location.href = '/';
      <?php }?>

      //获取用户数据
      var imgContainer = $('#upload');
      var email = $('#email');
      var nickname = $('#nickname');
      var company = $('#company');
      var job = $('#job');
      var intro = $('#intro');

      $.get('/api/user/user_get.php', function (data) {
        if(data.status){
          if(!data.data) return;
          var user = data.data;
          imgContainer[0].src = user.avatar || '/images/no_avatar.jpg';
          email.val(user.email);
          nickname.val(user.nickname);
          company.val(user.company);
          job.val(user.job);
          intro.val(user.intro);

        }else{
          var infoWindow = new Alert('提示', '服务器异常，查询数据失败, 请稍后再试', null, 1000);
          infoWindow.show();
        }
      });

      //上传头像
      var upload_file = $('#upload_file');
      var upload_tip = $('#upload_tip');
      var tip_html = '<span style="color:red;">上传失败，请重试</span>';
      imgContainer.on('click', function () {
        upload_file.click();
      });

      upload_file.on('change', function () {
        var data = new FormData();
        var files = upload_file[0].files;
        if(files.length <1 ){
          upload_tip.html(tip_html);
          return;
        }
        data.append('file', files[0]);
        $.ajax({
          url:'/api/upload_avatar.php',
          type:'POST',
          data:data,
          cache: false,
          contentType: false,
          processData: false,
          success:function(data){
            if(data.status){
              imgContainer[0].src = data.data;
              upload_tip.text('头像保存成功');
            }else{
              upload_tip.html(tip_html);
            }
          }
        });
      });

      //更新用户信息
      $('.user_save').on('click', function () {
        var obj = {
          nickname: nickname.val(),
          job: job.val(),
          company: company.val(),
          intro: intro.val()
        };
        $.post('/api/user/user_update.php', obj, function (data) {
          if(data.status){
            var infoWindow = new Alert('提示', '您的信息更新成功', null, 1500);
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
