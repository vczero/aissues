<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('./ui/meta.php') ?>
  <title>Aissues-首页</title>
  <style type="text/css">
    body{
      background-color: #EEEEEE;
    }
    a{
      text-decoration: none;
      color: #2E2E2E;
    }
    .main{
      min-height:500px;
      width:1200px;
      margin-left:auto;
      margin-right: auto;
      padding-top:70px;
    }
    .author_info{
      width:300px;
      height:300px;
      background-color:#fff;
      box-shadow: 2px 2px 2px #ddd;
      color: #565656;
    }
    .avatar img{
      width:80px;
      height:80px;
      border:1px solid #ddd;
      margin-top:20px;
    }
    .avatar{
      width:100%;
      text-align: center;
    }
    .nickname{
      text-align: center;
      font-size:16px;
      font-weight: bold;
      margin-top:10px;
    }
    .book_list{
      width:880px;
      min-height:300px;
      background-color: #fff;
      box-shadow: 2px 2px 2px #ddd;
      padding-bottom:20px;
    }
    .job{
      text-align: center;
      margin-top: 20px;
      font-size:13px;
    }
    .intro{
      text-align: center !important;
      font: normal normal normal 14px/1 FontAwesome;
      font-size:13px;
      margin-right:10px;
      height:54px;
      line-height:18px;
      word-break:break-all;
      overflow:hidden;
      text-overflow:ellipsis;
      margin-left:10px;
    }
    .qr{
      margin-top:74px;
      background-color:#fff;
      text-align: center;
      padding-top:10px;
      padding-bottom:10px;
      box-shadow: 2px 2px 1px #ccc;
    }
    .book_item{
      height:225px;
      width:150px;
      margin-top:20px;
      margin-left:19px;
      float: left;
    }
    .book_item img{
      width:150px;
      height:200px;
      box-shadow: 2px 2px 2px #ddd;
    }
    .book_item_title{
      text-align: center;
      line-height:25px;
      color:#373737;
    }
  </style>
</head>
<body>
<?php require_once('./ui/header.php');?>
<?php require_once('./ui/login.php');?>
<script type="text/javascript">
  $('.header_menu_').css('background-color', '#0166FF');
  $('.header_menu_').css('color', '#fff');
</script>
<script type="text/javascript" src="/js/underscore-min.js"></script>
<script type="text/javascript" src="/js/jquery.qrcode.js"></script>
<div class="main">
  <div class="fl author_info">
    <div class="author_container">
      <script type="text/template" id="user_tpl">
        <div class="avatar">
          <img src="<%=userinfo.avatar%>"/>
        </div>
        <div class="nickname">
          <%=userinfo.nickname || '该大侠不留名'%>
        </div>
        <div class="job name_ell">
          <%=userinfo.job || '默认程序员'%>@<%=userinfo.company || '自由开发者'%>
        </div>
        <div class="intro">
          <%=userinfo.intro || '用户比较纯，连自我介绍都没有'%>
        </div>
      </script>
    </div>
    <div class="qr">
      <div id="qrcode"></div>
      <div style="font-size:12px;">分享该作者图书列表</div>
    </div>
  </div>
  <div class="book_list fr">
    <div id="books_container">
      <div style="margin-top:100px;">
        <?php include('./ui/loading.php');?>
      </div>
    </div>
    <script type="text/template" id="books">
      <% _.each(books, function (item, i) { %>
      <div class="book_item" book-id="<%=item.bookid%>">
        <a href="/book.php?id=<%=item.bookid%>">
          <img src="<%=item.bookimg%>"/>
        </a>
        <div class="book_item_title name_ell">
          <%=item.bookname%>
        </div>
      </div>
      <%});%>
    </script>
  </div>
  <div style="clear: both;"></div>
</div>
<?php include_once('./ui/footer.php');?>
<script type="text/javascript">
  var userinfo = {};
  //获取用户信息
  function getQueryString(name) {
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
  }
  var userid = getQueryString('id');
  $.post('/api/public/user_id.php', {userid: userid}, function (data) {
    if(data.status) userinfo = data.data;
    $('.author_container').html((_.template($('#user_tpl').html(), userinfo)()));
    //SEO
    $('title').text(userinfo.nickname + ' ' + userinfo.intro + ' aissues.com');
  });
  $('#qrcode').qrcode({
    text: 'http://aissues.com/m/user_books.php?id=' + userid,
    width: 120,
    height: 120
  });
  //获取图书列表
  var books = [];
  $.get('/api/public/books_userid.php?userid='+ userid, function (data) {
    if(data.status){
      books = data.data;
      $('#books_container').html((_.template($('#books').html(), books)()));
    }
  });
</script>
<?php include_once('./ui/cnzz.php');?>
</body>
</html>