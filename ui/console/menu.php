<style type="text/css" rel="stylesheet">
  .main_left a{
    text-decoration: none !important;
  }
  .main_left a:link{text-decoration:none ; color:#fff ;}
  .main_left a:visited {text-decoration:none ; color:#fff ;}
  .main_left a:hover {text-decoration:underline ; color:#fff ;}
  .main_left a:active {text-decoration:none ; color:#fff ;}

  .main_left{
    position: absolute;
    left:0;
    top:0;
    width:175px;
    bottom: 0;
    background-color: #293038;
    overflow-y: scroll;
    min-height:500px;
    color:#fff;
  }
  .main_left>a{
    padding-left:15px;
    display:block;
  }
  .main_left_title{
    height:40px;
    margin-top:10px;
    line-height:40px;
    background-color:#22282E;
    cursor:pointer;
  }
  .main_left_title i{
    margin-right:5px;
    vertical-align: middle;
  }
  .main_left_title img{
    width:15px;
  }
  .main_left ul{
    list-style: none;
    font-size: 12px;
  }
  .main_left .main_left_item a{
    height:30px;
    line-height:30px;
    display: block;
    cursor: pointer;
    padding-left:15px;
  }
  .main_left .main_left_item a:hover{
    background-color: #394555;
  }
  .main_left_item i{
    margin-right:5px;
    vertical-align: middle;
  }
  .main_left_item img{
    width:15px;
  }
</style>
<div class="main_left fl">
  <a class="main_left_title">
    <i><img src="/images/site/category.png"/></i>
    创建小书
  </a>
  <div class="main_left_item">
    <a href="/console/demo.php">
      <i><img src="/images/site/demo.png"/></i>流程示例
    </a>
    <a href="/console/book_create.php">
      <i><img src="/images/site/add.png"/></i>创建小书
    </a>
  </div>
  <a class="main_left_title">
    <i><img src="/images/site/category.png"/></i>
    管理小书
  </a>
  <div class="main_left_item">
    <a  href="/console/book_list.php">
      <i>
        <img src="/images/site/form.png">
      </i>
      编写小书
    </a>
    <a href="/console/book_setting.php">
      <i>
        <img src="/images/site/set.png">
      </i>
      小书设置
    </a>
    <a href="/console/book_publish.php">
      <i>
        <img src="/images/site/share.png">
      </i>
      已发布
    </a>
  </div>
  <a class="main_left_title">
    <i><img src="/images/site/category.png"/></i>
    用户中心
  </a>
  <div class="main_left_item">
    <a href="/console/uc.php">
      <i>
        <img src="/images/site/user.png">
      </i>
      修改资料
    </a>
    <a href="/console/update_password.php">
      <i>
        <img src="/images/site/set.png">
      </i>
      修改密码
    </a>
    <a href="/console/exit.php">
      <i>
        <img src="/images/site/exit.png">
      </i>
      退出登录
    </a>
  </div>
</div>