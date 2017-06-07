<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('./meta.php') ?>
  <title>Aissues-一个把书读薄的网站</title>
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
    }
    .item_fm{
      position: absolute;
      left:0;
      width:120px;
      height:162px;
      margin-left:5px;
      display: block;
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
  </style>
</head>
<html>
<body>
<?php include('./header.php') ?>
<div class="book">
  <div id="books">
    <div style="margin-top:100px;">
      <?php include('./../ui/loading.php');?>
    </div>
    <script type="text/template" id="book_item">
      <% _.each(books, function (item, i) { %>
      <div class="item">
        <a class="fl item_fm" href="/m/book.php?id=<%=item.bookid%>">
          <img src="<%=item.bookimg%>"/>
        </a>
        <div class="fl item_info">
          <div class="name_ell">书名：<%=item.bookname%></div>
          <div>分类：<%=item.type%></div>
          <div>时间：<%=item.time%></div>
          <div class="book_desc">
            图书简介：<%=item.bookdesc%>
          </div>
        </div>
      </div>
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
  var type_en = getQueryString('type');
  var type_cn = '前端';
  switch (type_en){
    case 'fe':
      type_cn = '前端';
      break;
    case 'be':
      type_cn = '后端';
      break;
    case 'ios':
      type_cn = 'iOS';
      break;
    case 'android':
      type_cn = 'Android';
      break;
    case 'm':
      type_cn = '移动端';
      break;
    case 'ops':
      type_cn = '运维';
      break;
    default:
      break;
  }
  //获取图书列表
  var books = [];
  $.get('/api/public/books_type_page.php?type='+ type_cn + '&page=1', function (data) {
    if(data.status){
      books = data.data;
      $('#books').html((_.template($('#book_item').html(), books)()));
      $('title').text('Aissues 提供的' + type_cn + '小书有这些，你看过么');
    }
  });
</script>
<?php include_once('./../ui/cnzz.php');?>
</body>
</html>