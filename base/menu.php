<!-- 侧边导航栏 -->
<div class="left-sidebar">
  <!-- 用户信息 -->
  <div class="tpl-sidebar-user-panel">
    <div class="tpl-user-panel-slide-toggleable">
      <div class="tpl-user-panel-profile-picture">
        <img src="assets/img/user03.png" alt="">
      </div>
      <span class="user-panel-logged-in-text">
              <i class="am-icon-circle-o am-text-success tpl-user-panel-status-icon"></i>
              超级管理员
          </span>
      <a href="javascript:;" class="tpl-user-panel-action-link"> <span class="am-icon-pencil"></span> 账号设置</a>
    </div>
  </div>

  <!-- 菜单 -->
  <ul class="sidebar-nav">
    <li class="sidebar-nav-heading">菜单 <span class="sidebar-nav-heading-info"></span></li>
    <li class="sidebar-nav-link">
      <a id="base" href="/base">
        <i class="am-icon-home sidebar-nav-link-logo"></i> 首页
      </a>
    </li>
    <li class="sidebar-nav-link">
      <a id="user_list" href="/base/user-list.php">
        <i class="am-icon-table sidebar-nav-link-logo"></i> 用户管理
      </a>
    </li>
    <li class="sidebar-nav-link">
      <a id="book_list" href="/base/book-list.php">
        <i class="am-icon-book sidebar-nav-link-logo"></i> 小书管理
      </a>
    </li>
    <li class="sidebar-nav-link">
      <a id="post_news" href="/base/post_news.php">
        <i class="am-icon-bookmark sidebar-nav-link-logo"></i> 发表文章

      </a>
    </li>
    <li class="sidebar-nav-link">
      <a id="news_list" href="/base/news-list.php">
        <i class="am-icon-pagelines sidebar-nav-link-logo"></i> 文章管理
      </a>
    </li>
    <li class="sidebar-nav-link">
      <a id="index-set" href="/base/index-set.php">
        <i class="am-icon-edit sidebar-nav-link-logo"></i>首页配置
      </a>
    </li>
  </ul>
</div>
<script type="text/javascript">
  var href = location.href;
  if(href.indexOf('/user-list') > 0){
    $('#user_list').addClass('active');
  }else if(href.indexOf('/book-list') > 0){
    $('#book_list').addClass('active');
  }else if(href.indexOf('/post_news') > 0){
    $('#post_news').addClass('active');
  }else if(href.indexOf('/news-list') > 0){
    $('#news_list').addClass('active');
  }else if(href.indexOf('index-set') > 0){
    $('#index-set').addClass('active');
  } else{
    $('#base').addClass('active');
  }
</script>