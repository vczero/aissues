<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('./ui/meta.php') ?>
  <title>Aissues-搜索页面</title>
  <style type="text/css">
    body{
      background-color: #EEEEEE;
    }
    .main{
      width:1200px;
      margin-left:auto;
      margin-right: auto;
      padding-top:70px;
    }
    .result{
      width:100%;
      height: 100%;
      background-color:#fff;
      min-height:200px;
      padding-top:20px;
    }
    .item{
      margin-left:10px;
      margin-bottom:10px;
      color: #5A5A5A;
    }
    .item_title{
      color:#5A5A5A;
      line-height:25px;
    }
    .item_type{
      height:20px;
      padding-left:5px;
      padding-right:5px;
      border-radius:3px;
      background-color:#E6196F;
      text-align: center;
      line-height:20px;
      color:#fff;
      display: inline-block;
      margin-left:10px;
    }
    .item_time{
      font-size:12px;
    }
    .no_result{
      line-height: 70px;
      text-align: center;
    }
    .footer{
      position: absolute;
      bottom:0;
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
<div class="main">
  <div class="result">
    <script type="text/template" id="item_tpl">
      <% _.each(results, function (item, i) { %>
      <div class="item">
        <a class="item_title" href="/book.php?id=<%=item.bookid%>"><%=item.bookname%><span class="item_type"><%=item.type%></span></a>
        <div class="item_desc"><%=item.bookdesc%></div>
        <div class="item_time"><%=item.time%></div>
      </div>
      <%});%>
    </script>
  </div>
</div>
<?php include_once('./ui/footer.php');?>
<script type="text/javascript" src="/js/underscore-min.js"></script>
<script type="text/javascript">
  var results = [];
  (function () {
    function getQueryString(key){
      var reg = new RegExp("(^|&)"+key+"=([^&]*)(&|$)");
      var result = window.location.search.substr(1).match(reg);
      return result?decodeURIComponent(result[2]):null;
    }
    var result = $('.result');
    $.get('/api/public/search_book.php?bookname=' + getQueryString('bookname'), function (data) {
      if(data.status) {
        results = data.data;
        result.html((_.template($('#item_tpl').html(), results)()));
      }else {
        result.html(' <div class="no_result">没有查询相关小书，建议换一个关键词试试～<div>');
      }
    });
  })();
</script>
<?php include_once('./ui/cnzz.php');?>
</body>
</html>