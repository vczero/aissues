<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('./ui/meta.php') ?>
  <title>Aissues-新闻列表</title>
  <style type="text/css">
    body{
      background-color: #EEEEEE;
    }
    a{
      text-decoration: none;
      color: #2E2E2E;
    }
    .main{
      width:1200px;
      margin-left:auto;
      margin-right: auto;
      padding-top:60px;
    }

    .book_info{
      background-color: #fff;
      min-height:300px;
      width:880px;
      padding:10px;
    }
    .wangEditor-container{
      border:0 !important;
    }
    pre code{
      display: block;
      overflow-x: scroll !important;
      max-width:840px;
    }
    .book_info img{
      max-width:880px !important;
    }
    .avatar{
      margin-top:10px;
      width:100%;
      height:80px;
      text-align: center;
      display: block;
    }
    .avatar img{
      width:80px;
      height:80px;
      border-radius:40px;
      vertical-align: middle;
    }
    .news_title{
      font-size:14px;
      color: #5F5F5F;
      display: inline-block;
      width:700px;
      line-height:25px;
    }
    .news_info{
      color: #5F5F5F;
      display: inline-block;
      line-height:25px;
    }
    .book_container{
      margin-left:20px;
    }

    #big_title{
      font-size:20px;
      text-align: center;
      margin-top:10px;
      margin-bottom:20px;
      color: #1789EA;
    }
    .title_tip{
      font-size:12px;
      color: #7C7C7C;
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
<link rel="stylesheet" type="text/css" href="/js/editor/css/wangEditor.min.css">

<script src="/js/highlight.min.js"></script>
<script src="/js/editor/js/wangEditor.min.js"></script>
<script type="text/javascript" src="/js/underscore-min.js"></script>
<div class="main">
  <div class="book_info fl" id="news_container">
    <div id="big_title"></div>
    <script type="text/template" id="news_tpl">
      <% _.each(news, function (item, i) { %>
      <a style="display: block;" href="/news.php?id=<%=item.newsid%>">
        <span class="news_title name_ell"><%=item.title%></span>
        <span class="news_info"><%=item.time%></span>
      </a>
      <%});%>
    </script>
  </div>
  <div class="book_container fl">
    <script type="text/template" id="book_tpl">
      <% _.each(books, function (item, i) { %>
      <a style="display: block;margin-bottom:20px;background-color:#fff;height:230px;width:150px;" href="/book.php?id=<%=item.bookid%>">
        <div>
          <img src="<%=item.bookimg%>" style="width:150px;height:200px;"/>
        </div>
        <div style="text-align: center;" class="name_ell"><%=item.bookname%></div>
      </a>
      <%});%>
    </script>
  </div>
  <script type="text/javascript">
    function getQueryString(key){
      var reg = new RegExp("(^|&)"+key+"=([^&]*)(&|$)");
      var result = window.location.search.substr(1).match(reg);
      return result?decodeURIComponent(result[2]):null;
    }
    var books = [];
    //随机获取3本推荐的小书
    $.get('/api/public/random_book.php', function (data) {
      if(data.status){
        books = data.data;
        $('.book_container').html((_.template($('#book_tpl').html(), books)()));
      }
    });

    var type = getQueryString('type');
    $('#big_title').html(type + '<span class="title_tip">（只展示最近的35条新闻）</span>');
    var news = [];
    $.post('/api/public/news_type.php', {
      type: type
    }, function (data) {
      if(data.status){
        news = data.data;
        $('#news_container').append((_.template($('#news_tpl').html(), news)()));
      }
    });
  </script>
  <?php include_once('./ui/cnzz.php');?>
</div>
</body>
</html>