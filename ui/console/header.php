<style type="text/css">
  .header_container{
    width:100%;
    height:55px;
    border-bottom:1px solid #ddd;
    min-width:1200px;
    position: fixed;
  }
  .header{
    width:100%;
    height:55px;
  }
  .header_left{
    height:55px;
  }
  .header_left a{
    height:100%;
    display:inline-block;
    padding-left:15px;
    padding-right:15px;
    vertical-align:top;
    line-height:55px;
    cursor:pointer;
    color: #000;
  }

  .header_right a{
    height:100%;
    display:inline-block;
    padding-left:5px;
    padding-right:5px;
    vertical-align:top;
    line-height:55px;
    cursor:pointer;
    color: #000;
  }
  .header a{
       text-decoration: none;
  }
  .header a:link{
      color: #000;
  }
  .header a:visited{
      color: #000;
  }
  .header a:hover{
    background-color:#0166FF;
    color:#fff;
  }
  .header_logo{
    height:100%;
    /*margin-left:30px;*/
    width:80px;
    text-align:center;
  }
  .header_logo img{
    max-height:45px;
  }
  .header_search input{
    width:300px;
    height:35px;
    border:1px solid #ddd;
    outline:none;
    padding-left:23px;
    font-size:14px;
    margin-top:11px;
    margin-right:40px;
    border-radius:5px;

    background-image: url("/images/site/search.png");
    background-size:21px 21px;
    background-repeat: no-repeat;
    background-position: 3px;
  }

</style>
<header class="header_container">
  <div class="header">
    <div class="fl header_left">
      <a href="/" class="fl header_logo" style="padding-left:0;">
        <img src="/images/logo.png"/>
      </a>
      <a class="header_menu_" href="/">首页</a>
      <a class="header_menu_fe" href="/category.php?type=fe">前端</a>
      <a class="header_menu_be" href="/category.php?type=be">后端</a>
      <a class="header_menu_ios" href="/category.php?type=ios">iOS</a>
      <a class="header_menu_android" href="/category.php?type=android">Android</a>
      <a class="header_menu_ops" href="/category.php?type=ops">运维</a>
      <a class="header_menu_m" href="/category.php?type=m">移动端</a>
    </div>
    <div class="fr header_right header_login">
      <?php
        session_start();
        if(!$_SESSION['_username']){?>
        <a class="go_login">登录</a>
        <a class="go_login">注册</a>
      <?php }else{?>
        <style type="text/css">
          .header_search input{
            margin-left:120px !important;
          }
        </style>
        <a href="/console/demo.php" class="header_menu_console_demo" >控制台</a>

        <a href="/console/uc.php" class="header_menu_user name_ell" style="display: inline-block;max-width:70px;">
          <?php
            //session_destroy();
            $arr = explode('@', $_SESSION['_username']);
            $username = $arr[0];
            $len = strlen($username);
            if($len > 10){
              $username = mb_substr($username , 0 , 10);
            }
            echo 'Hi, '.$username;
          ?>
         </a>
      <?php }?>
    </div>
    <div class="fr header_search">
      <input placeholder="搜索" id="search_input"/>

    </div>
  </div>
</header>
<script type="text/javascript">
  //菜单项背景颜色改变
  var logo = $('.header_logo');
  logo.on('mouseenter', function(){
    logo.text('后台系统');
  });
  logo.on('mouseleave', function(){
    logo.html('<img src="/images/logo.png"/>');
  });
  //弹出登录窗体
  $('.go_login').on('click', function(){
    $('.login').css('display', 'block');
    $('.login_mask').css('display', 'block');
  });

  var menu = location.href.split('/')[3];
  $('.header_menu_' + menu).css('background-color', '#0166FF');
  $('.header_menu_' + menu).css('color', '#fff');

  if(location.href.indexOf('/console/') > 0){
    $('.header_menu_console_demo').css('background-color', '#0166FF');
    $('.header_menu_console_demo').css('color', '#fff');
  }

  $('#search_input').keydown(function(e){
    if(e.keyCode==13){
      var keywords = $('#search_input').val();
      location.href = '/search.php?bookname=' + keywords;
    }
  });
</script>
