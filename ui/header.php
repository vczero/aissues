<style type="text/css">
  .header_container{
    width:100%;
    height:38px;
    min-width:1200px;
    position: fixed;
    z-index: 2;
    color:#555555;
    background-color:#fff;
    border-bottom: 1px solid #EBEBEB;
    font-size:13px;
  }
  .header{
    width:1200px;
    margin-left:auto;
    margin-right:auto;
    height:38px;
  }
  .header_left{
    height:38px;
  }
  .header_left a{
    height:100%;
    display:inline-block;
    padding-left:15px;
    padding-right:15px;
    vertical-align:top;
    line-height:38px;
    cursor:pointer;
    color: #555555;
  }

  .header_right a{
    height:100%;
    display:inline-block;
    padding-left:5px;
    padding-right:5px;
    vertical-align:top;
    line-height:38px;
    cursor:pointer;
    color: #555555;
  }
  .header a{
       text-decoration: none;
  }
  .header a:link{
      color: #555555;
  }
  .header a:visited{
      color: #555555;
  }
  .header a:hover{
    background-color:#3888FF;
    color:#fff;
  }
  .header_logo{
    height:100%;
    width:50px;
    text-align:center;
    margin-right:5px;
  }
  .header_logo img{
    max-height:38px;
  }
  .header_search input{
    width:200px;
    height:25px;
    margin-top:5px;
    outline:none;
    padding-left:17px;
    font-size:12px;
    margin-left:50px;
    border-radius:5px;
    background-image: url("/images/site/search.png");
    background-size:12px 12px;
    background-repeat: no-repeat;
    background-position: 3px;
    border:1px solid #ddd;
  }
  .header_menu_user{
    display: inline-block;
    max-width:80px;
  }
</style>
<header class="header_container">
  <div class="header">
    <div class="fl header_left">
      <a href="/" class="fl header_logo">
        Aissues
      </a>
      <a class="header_menu_" href="/">首页</a>
      <a class="header_menu_fe" href="/category.php?type=fe">前端</a>
    <!---  <a class="header_menu_be" href="/category.php?type=be">后端</a>---->
    <!---  <a class="header_menu_ios" href="/category.php?type=ios">iOS</a>---->
      <a class="header_menu_android" href="/category.php?type=android">Android</a>
      <a class="header_menu_m" href="/category.php?type=m">移动端</a>
      <a class="header_menu_ops" href="/category.php?type=ops">运维</a>
    </div>
    <div class="fl header_search">
      <input id="search_input" placeholder="搜索"/>
    </div>
    <div class="fr header_right header_login">
      <?php
        session_start();
        if(!$_SESSION['_username']){?>
        <a class="go_login">登录</a>
        <a class="go_login">注册</a>
      <?php }else{?>
        <a href="/console/demo.php" class="header_menu_console_demo" >控制台</a>
        <a href="/console/uc.php" class="header_menu_user name_ell" >
          <?php
            //session_destroy();
            $arr = explode('@', $_SESSION['_username']);
            $username = $arr[0];
            // $len = strlen($username);
            // if($len > 8){
            //   $username = mb_substr($username , 0 , 8);
            // }
            echo 'Hi, '.$username;
          ?>
         </a>
      <?php }?>
    </div>
  </div>
</header>
<script type="text/javascript">
  //菜单项背景颜色改变
//  var logo = $('.header_logo');
//  logo.on('mouseenter', function(){
//    logo.text('一休网');
//  });
//  logo.on('mouseleave', function(){
//    logo.html('<img src="/images/logo.png"/>');
//  });
  //弹出登录窗体
  $('.go_login').on('click', function(){
    $('.login').css('display', 'block');
    $('.login_mask').css('display', 'block');
  });


  $('#search_input').keydown(function(e){
    if(e.keyCode==13){
      var keywords = $('#search_input').val();
      location.href = '/search.php?bookname=' + keywords;
    }
  });
</script>
