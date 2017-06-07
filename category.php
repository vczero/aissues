<!DOCTYPE html>
<html lang="ch">
<head>
  <?php include('./ui/meta.php') ?>
  <title>Aissues-小书分类</title>
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
      padding-top:70px;
    }
    .author_info{
      width:300px;
      /*height:300px;*/
      background-color:#fff;
      box-shadow: 2px 2px 2px #ddd;
      color: #565656;
    }
    .book_list{
      width:880px;
      min-height:300px;
      background-color: #fff;
      box-shadow: 2px 2px 2px #ddd;
      padding-bottom:20px;
    }
    .qr{
      background-color:#fff;
      text-align: center;
      padding-top:10px;
      padding-bottom:10px;
      box-shadow: 2px 2px 1px #ccc;
      position: fixed;
      width:300px;
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
<script type="text/javascript" src="/js/underscore-min.js"></script>
<script type="text/javascript" src="/js/jquery.qrcode.js"></script>
<div class="main">
  <div class="fl author_info">
    <div class="qr">
      <div id="qrcode"></div>
      <div style="font-size:12px;">分享该分类图书</div>
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
  function getQueryString(name) {
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
  }
  //设置菜单
  var header_menu = '.header_menu_' + getQueryString('type');
  $(header_menu).css('background-color', '#3388FF');
  $(header_menu).css('color', '#fff');
  //二维码
  $('#qrcode').qrcode({
    text: 'http://aissues.com/m/book_list.php?type=' + getQueryString('type'),
    width: 120,
    height: 120
  });
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
      $('#books_container').html((_.template($('#books').html(), books)()));
    }
  });
</script>
<?php include_once('./ui/cnzz.php');?>
</body>
</html>