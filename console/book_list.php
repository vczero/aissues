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
  <?php include_once('../ui/meta.php') ?>
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
      color: #FFFFFF;
    }
    .main_right{
      position: absolute;
      left:175px;
      right:0;
      top:1px;
      bottom:0;
      overflow-y: scroll;
      color: #000;
    }
    .book_item{
      width:150px;
      height:230px;
      border:1px solid #ddd;
      margin-left:20px;
      margin-top:20px;
    }
    .book_item_img img{
      width:150px;
      height:200px;
      border-bottom:1px solid #ddd;
    }
    .book_fm{
      width:150px !important;
      height:200px !important;
    }
    .book_no_fm{
      background-color:#ECECEC;
      width:150px;
      height:200px;
      text-align: center;
    }

    .book_no_fm img{
      width:150px;
      height:200px;
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
  </style>
</head>
<body>
<?php require_once('../ui/console/header.php');?>
<div class="main_view">
  <?php require_once('../ui/console/menu.php')?>
  <div class="main_right fl">
      <div style="margin-top:100px;">
        <?php include('./../ui/loading.php');?>
      </div>
  </div>
  <script type="text/template" id="list">
    <% _.each(objs, function (item, i) { %>
    <div class="book_item fl" book_id="<%=item.bookid%>">
      <div class="book_item_img">
        <%if(item.bookimg){%>
          <img class="book_fm" src="<%=item.bookimg%>"/>
        <%}else{%>
          <div class="book_no_fm" style="background-color:#fff;border-bottom:1px solid #ddd;">
            <img style="width:30px;height:30px;margin-top:70px;" src="/images/book.png"/>
            <div style="color:#5F5F5F;">无封面，请上传</div>
          </div>
        <%}%>
      </div>
      <div class="name">
        <%=item.bookname%>
      </div>
    </div>
    <%});%>
  </script>
</div>
<script type="text/javascript" src="/js/underscore-min.js"></script>
<script type="text/javascript">
  var objs = [];
  $.get('/api/book/get.php', function (data) {
    if(data.status){
      objs = data.data;
      $('.main_right').html((_.template($('#list').html(), objs)()));
      $('.main_right .book_item').on('click', function () {
        var book_id = $(this).attr('book_id');
        window.location = '/console/edit.php?book_id=' + book_id;
      });
    }else{
      var infoWindow = new Alert('提示', data.info);
      infoWindow.show();
    }
  });
</script>
<?php include_once('../ui/cnzz.php');?>
</body>
</html>
