<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('./meta.php') ?>
  <title>Aissues-用户小书</title>
  <link rel="stylesheet" type="text/css" href="/js/editor/css/wangEditor.min.css">
  <style type="text/css">
    body{
      background-color:#FAFBFB;
    }
    .book{
      min-height:300px;
      padding-top:46px;
    }
    .error{
      text-align: center;
      line-height:70px;
    }
    .copyright{
      text-align: center;
      font-size: 13px;
      margin-top:5px;
      color:#5F5F5F;
    }
    .item{
      height:162px;
      margin-top:10px;
      background-color:#fff;
      box-shadow: 2px 2px 2px #ddd;
      display: block;
    }
    .item_fm{
      position: absolute;
      left:0;
      width:120px;
      height:162px;
      margin-left:5px;
    }
    .item img{
      width:120px;
      height:160px;
    }
    .item_info{
      margin-left:10px;
      font-size:13px;
      color: #2E2E2E;
      position: absolute;
      margin-top:5px;
      left:130px;
      right:10px;
      height:162px;
    }
    .book_desc{
      word-wrap: break-word;
      word-break: normal;
      overflow: hidden;
      height:80px;
    }
    .userinfo{
      text-align: center;
      margin-top:20px;
    }
    .userinfo img{
      width:75px;
      height:75px;
      border-radius:40px;
    }
  </style>
</head>
<html>
<body>
<?php include('./header.php') ?>
<div class="book">
  <div class="userinfo">
    <script type="text/template" id="userinfo_tpl">
      <div>
        <img src="<%=userinfo.avatar%>"/>
      </div>
      <div style="margin-top:10px;margin-bottom:20px;font-size:15px;font-weight:bold;">
        <%=userinfo.nickname || '该大侠雁过不留名'%>
      </div>
    </script>
  </div>
  <div id="books">
    <div style="margin-top:100px;">
      <?php include('./../ui/loading.php');?>
    </div>
    <script type="text/template" id="book_item">
      <% _.each(books, function (item, i) { %>
      <a class="item" href="/m/book.php?id=<%=item.bookid%>">
        <div class="fl item_fm">
          <img src="<%=item.bookimg%>"/>
        </div>
        <div class="fl item_info">
          <div class="name_ell">书名：<%=item.bookname%></div>
          <div>分类：<%=item.type%></div>
          <div>时间：<%=item.time%></div>
          <div class="book_desc">
            图书简介：<%=item.bookdesc%>
          </div>
        </div>
      </a>
      <%});%>
    </script>
  </div>
  <div class="copyright">版权所有 © aissues.com</div>
</div>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script src="/js/highlight.min.js"></script>
<script src="/js/editor/js/wangEditor.min.js"></script>
<script type="text/javascript" src="/js/underscore-min.js"></script>
<script type="text/javascript">
  function getQueryString(name) {
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
  }
  var userinfo = {};
  var userid = getQueryString('id');
  $.post('/api/public/user_id.php', {userid: userid}, function (data) {
    if(data.status){
      userinfo = data.data;
      $('.userinfo').html((_.template($('#userinfo_tpl').html(), userinfo)()));
      //SEO
      $('title').text(userinfo.nickname + ' ' + userinfo.intro);
    }else{
      $('.userinfo').remove();
    }
  });
  //获取图书列表
  var books = [];
  $.get('/api/public/books_userid.php?userid='+ userid, function (data) {
    if(data.status){
      books = data.data;
      $('#books').html((_.template($('#book_item').html(), books)()));
    }
  });
</script>
<?php include_once('./../ui/cnzz.php');?>
</body>
</html>