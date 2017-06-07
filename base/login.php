<?php
session_start();
//登录了直接重定向首页
if($_SESSION['_admin_userid']){
  header('Location: /base');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aissues后台系统</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="assets/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="assets/css/app.css">
    <script src="assets/js/jquery.min.js"></script>

</head>

<body data-type="login">
    <script src="assets/js/theme.js"></script>
    <div class="am-g tpl-g">
        <!-- 风格切换 -->
        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">
            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    选择主题
                </div>
                <div class="tpl-skiner-content-bar">
                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>
        <div class="tpl-login">
            <div class="tpl-login-content">
                <div class="tpl-login-logo">
                </div>
                <form class="am-form tpl-form-line-form">
                    <div class="am-form-group">
                        <input type="text" class="tpl-form-input" id="user-name" placeholder="请输入账号">

                    </div>

                    <div class="am-form-group">
                        <input type="password" class="tpl-form-input" id="user-password" placeholder="请输入密码">

                    </div>
                    <div class="am-form-group tpl-login-remember-me">
                        <label for="remember-me">
                          验证码
                         </label>
                      <img src="/api/user/captcha.php" onclick="this.src='/api/user/captcha.php?' + Math.random();"/>
                    </div>
                    <div style="height:50px;">
                      <div>
                        <input id="login_code" placeholder="请入验证码" style="border:1px solid #ddd; height:30px;width:300px;font-size:14px;border-radius:3px;"/>
                      </div>
                    </div>
                    <div class="am-form-group">
                        <button type="button" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success  tpl-login-btn">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include_once('alert.php');?>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script type="text/javascript">
      $('.tpl-login-btn').on('click', function () {
        var obj = {
          email: $('#user-name').val(),
          password: $('#user-password').val(),
          code: $('#login_code').val()
        };
        $.post('/base/api/login.php', obj, function (data) {
          if(data.status){
            location.href = '/base';
          }else{
            (new Alert('提示', data.info)).show();
          }
        });
      });
    </script>
</body>
</html>