<!-- 头部 -->
<header>
  <!-- logo -->
  <div class="am-fl tpl-header-logo">
    <a href="javascript:;"><img src="/images/logo.png" style="width:50px;"></a>
  </div>
  <!-- 右侧内容 -->
  <div class="tpl-header-fluid">
    <!-- 侧边切换 -->
    <div class="am-fl tpl-header-switch-button am-icon-list">
     <span></span>
    </div>
    <!-- 搜索 -->
    <div class="am-fl tpl-header-search">
      <form class="tpl-header-search-form" action="javascript:;">
        <button class="tpl-header-search-btn am-icon-search"></button>
        <input class="tpl-header-search-box" type="text" placeholder="搜索内容...">
      </form>
    </div>
    <!-- 其它功能-->
    <div class="am-fr tpl-header-navbar">
      <ul>
        <!-- 欢迎语 -->
        <li class="am-text-sm tpl-header-navbar-welcome">
          <a href="javascript:;">欢迎你,
            <span><?php session_start(); echo $_SESSION['_admin_email']?></span>
          </a>
        </li>
        <!-- 退出 -->
        <li class="am-text-sm _am-text-sm-out">
          <a href="javascript:;">
            <span class="am-icon-sign-out"></span> 退出
          </a>
        </li>
      </ul>
    </div>
  </div>

</header>
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
<script type="text/javascript">
  $('._am-text-sm-out').on('click', function () {
    $.get('/base/api/logout.php', function (data) {
      if(data.status){
        location.href = '/base/login.php';
      }else{
        (new Alert('提示', data.info)).show();
      }
    });
  });
</script>
<?php include_once('./../ui/alert.php');?>