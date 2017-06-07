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
    }
    a{
      text-decoration: none;
      color: #2E2E2E;
    }
    .main_right{
      background-color:#fff;
      position: absolute;
      left:175px;
      right:0;
      top:1px;
      bottom:0;
      overflow-y: scroll;
    }
    .cook_book_right{
      background-color: #fff;
      min-height: 400px;
      padding-left:50px;
    }
    .cook_book_demo_view{
      padding-top:30px;
    }
    .cook_book_demo_item{
      line-height:90px;
      height:90px;
      width:90px;
      border-radius:90px;
      border:1px solid #fff;
      display: inline-block;
      text-align: center;
      color:#fff;
      cursor: pointer;
    }
    .cook_book_demo_arr{
      display: inline-block;
      width:50px;
      border-top:1px solid #ECECEC;
    }
    .cook_book_demo_title{
      margin-bottom:30px;
      font-size:14px;
      color:#000;
    }
    .cook_book_right>div{
      display: none;
    }
    .cook_book_demo_tips{
      margin-top:30px;
    }
    .cook_book_demo_tips>div{
      margin-bottom: 10px;
    }
    .cook_book_demo_tips ul{
      color: #424242;
      line-height:20px;
      font-size:13px;
    }
    .exit_btn{
      width:200px;height:35px;margin-top:20px;background-color: #E7505A;
      border-radius:3px;line-height:35px;text-align: center;margin-left:20px;color:#fff;
      cursor: pointer;
    }
    .book_img{
      width:150px;
      height:200px;
      border:1px solid #ddd;
      text-align: center;
    }
    .book_img img{
      width:30px;
      margin-top:90px;
    }
    .book_item{
      margin-left:20px;
      margin-top:30px;
      height:240px;
      display: block;
    }

    .book_item{
      text-decoration: none;
    }
    .name{
      text-align: center;
      line-height:30px;
      font-size:14px;
      overflow-x: hidden;
      text-overflow: ellipsis;
      word-break:keep-all;
      white-space:nowrap;
    }
    #list{
      height:auto;
    }
  </style>
</head>
<body>
<?php require_once('../ui/console/header.php');?>
<div class="main_view">
  <?php require_once('../ui/console/menu.php')?>
  <div class="main_right fl">
    <div>
      <div class="exit_btn">确定退出</div>
    </div>
    <div id="list"></div>
    <script type="text/template" id="tpl">
      <% _.each(objs, function (item, i) { %>
      <a class="fl book_item" href="/book.php/id=<%=item.bookid%>">
        <div class="book_img">
          <%if(item.bookimg){%>
          <img src="<%=item.bookimg%>"/>
          <%}else{%>
          <img src="/images/book.png"/>
          <%}%>
        </div>
        <div class="name name_ell" style="width:150px;">
          <%=item.bookname%>
        </div>
      </a>
      <%});%>
    </script>
  </div>
</div>
 <script type="text/javascript" src="/js/underscore-min.js"></script>
<script type="text/javascript">
  $('.exit_btn').on('click', function () {
    $.get('/api/user/logout.php', function (data) {
      if(parseInt(data.status)){
        location.href = '/';
      }
    });
  });
  var objs = [];
  $.get('/api/book/tuijian.php', function (data) {
    if(data.status){
      objs = data.data;
      $('#list').append((_.template($('#tpl').html(), objs)()));
    }else{
      //(new Alert('提示', data.info)).show();
    }
  });

</script>
<?php include_once('../ui/cnzz.php');?>
</body>
</html>
