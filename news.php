<!DOCTYPE html>
<html lang="ch">
<head>
  <?php include('./ui/meta.php') ?>
  <title>Aissues-新闻</title>
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
    #news_title{
      text-align: center;
      font-size:18px;
      font-weight: bold;
      margin-top:20px;
    }
    .news_info{
      color: #5F5F5F;
      text-align: center;
      margin-top: 30px;
      margin-bottom:30px;
    }
    .book_container{
      margin-left:20px;
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
<script type="text/javascript" src="/js/jquery.qrcode.js"></script>
<div class="main">
  <div class="book_info fl">
    <div id="news_title"></div>
    <div class="news_info">
      <span id="news_author"></span>
      <span id="news_time" style="font-size:12px;"></span>
    </div>
    <div id="editor" class="wangEditor-txt" contenteditable="true" >
      <div style="margin-top:100px;">
        <?php include('./ui/loading.php');?>
      </div>
    </div>
  </div>
  <div class="book_container fl">
    <div style="height:120px;height:160px;background-color:#fff;margin-bottom:20px;text-align:center;padding-top:10px;">
      <div id="qrcode"></div>
      <div>扫码分享到手机</div>
    </div>
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
    //文章需要seo关键字
    var books = [];
    function getQueryString(name) {
      var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
      var r = window.location.search.substr(1).match(reg);
      if(r!=null)return  unescape(r[2]); return null;
    }
    $.get('/api/public/news_id.php?newsid=' + getQueryString('id'), function (data) {
      if(data.status){
        var content = data.data.content || '';
        content += '<?php require_once('./ui/link.php');?>';
        $('#editor').html(content);
        var editor = new wangEditor('editor');
        editor.renderTxt();
        editor.renderEditorContainer();
        editor.disable();
        $('#news_title').html(data.data.title);
        $('#news_author').html(data.data.author);
        $('#news_time').html(data.data.time);

        //设置SEO关键字
        $('[name="Keywords"]').attr('content', data.data.keywords);
        $('[name="Description"]').attr('content', data.data.title + ' aissues.com');
        $('title').text(data.data.title + '  aissues.com');
      }
    });
    //随机获取3本推荐的小书
    $.get('/api/public/random_book.php', function (data) {
      if(data.status){
        books = data.data;
        $('.book_container').append((_.template($('#book_tpl').html(), books)()));
      }
    });

    $('#qrcode').qrcode({
      text: 'http://aissues.com/m/news.php?id=' + getQueryString('id'),
      width: 120,
      height: 120
    });
  </script>
  <?php include_once('./ui/cnzz.php');?>
</div>
</body>
</html>