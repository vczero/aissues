<!DOCTYPE html>
<html lang="ch">
<head>
  <?php include('./ui/meta.php') ?>
  <title>Aissues-小书</title>
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
    .author_info{
      width:270px;
      height:250px;
      background-color:#fff;
      color: #555555;
      box-shadow: 2px 2px 2px #ccc;
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
    .nickname{
      text-align: center;
      margin-top:20px;
      color: #555555;
      font-size:16px;
      font-weight: bold;
      display: block;
    }
    .job, .intro{
      margin-top:10px;
      text-align: center;
      margin-left:10px;
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
    }
    .name_cell{
      overflow-x: hidden;
      text-overflow: ellipsis;
      word-break:keep-all;
      white-space:nowrap;
    }
    .zhuan{
      position: relative;margin-left:840px;
      width:50px;height:40px;background-color:#3AB6FA;
      color:#fff;text-align: center;
      margin-top:-10px;line-height:40px;
    }
    .qr{
      margin-top:30px;
      background-color:#fff;
      text-align: center;
      padding-top:10px;
      padding-bottom:10px;
      box-shadow: 2px 2px 1px #ccc;
    }

  </style>
</head>
<body>
<?php require_once('./ui/header.php');?>
<?php require_once('./ui/login.php');?>
<script type="text/javascript">
  $('.header_menu_').css('background-color', '#3388FF');
  $('.header_menu_').css('color', '#fff');
</script>
<link rel="stylesheet" type="text/css" href="/js/editor/css/wangEditor.min.css">
<script src="/js/highlight.min.js"></script>
<script src="/js/editor/js/wangEditor.min.js"></script>
<script type="text/javascript" src="/js/underscore-min.js"></script>
<script type="text/javascript" src="/js/jquery.qrcode.js"></script>
<div class="main">
  <div class="book_info fl">
    <div class="zhuan">转载</div>
    <div id="editor" class="wangEditor-txt" contenteditable="true" >
      <div style="margin-top:100px;">
        <?php include('./ui/loading.php');?>
      </div>
    </div>
    <!-- 多说评论框 start -->
    <div id="duo_shuo_view"></div>
    <!-- 多说评论框 end -->
  </div>
  <div class="author_info fr">
    <div class="author_container">
      <script type="text/template" id="author_info_tpl">
        <a class="avatar" href="/user.php?id=<%=userinfo.userid%>">
          <img src="<%=userinfo.avatar%>"/>
        </a>
        <a class="nickname" href="/user.php?id=<%=userinfo.userid%>">
          <%=userinfo.nickname || '该大侠不留名'%>
        </a>
        <div class="job name_cell">
          <%=userinfo.job || '默认程序员'%>@<%=userinfo.company || '自由开发者'%>
        </div>
        <div class="intro">
          <%=userinfo.intro || '用户比较纯，连自我介绍都没有'%>
        </div>
      </script>
    </div>
    <div class="qr">
      <div id="qrcode"></div>
      <div style="font-size:12px;">分享该小书</div>
    </div>
  </div>
  <script type="text/javascript">
    var userinfo = null;
    var duoshuoQuery = {short_name:"aissues"};
    // var duoshuo = $('.ds-thread');
    function getQueryString(name) {
      var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
      var r = window.location.search.substr(1).match(reg);
      if(r!=null)return  unescape(r[2]); return null;
    }
    
    $.get('/api/public/book_id.php?bookid=' + getQueryString('id'), function (data) {
      if(data.status){
        var content = data.data.content || '';
        content += '<?php require_once('./ui/link.php');?>';
        $('#editor').html(content);
        var editor = new wangEditor('editor');
        editor.renderTxt();
        editor.renderEditorContainer();
        editor.disable();
        //显示转载
        if(parseInt(data.data.repost)){
          $('.zhuan').html('转载');
        }else{
          $('.zhuan').remove();
        }
        //SEO
        var obj = data.data;
        $('title').text(obj.bookname + '   aissues.com 一个把书读薄的网站');
        //多说
        var duoshuo = '<div class="ds-thread" data-thread-key="'+ getQueryString('id') + '" data-title="'+ obj.bookname +'" data-url="'+ location.href +'"></div>';
        $('#duo_shuo_view').html(duoshuo);
        var ds = document.createElement('script');
        ds.type = 'text/javascript';ds.async = true;
        ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
        ds.charset = 'UTF-8';
        (document.getElementsByTagName('head')[0]
        || document.getElementsByTagName('body')[0]).appendChild(ds);
        //展示用户信息
        showUser(data.data.userid);
      }
    });
    //展示作者信息
    function showUser(userid) {
      $.post('/api/public/user_id.php', {userid: userid}, function (data) {
        if(data.status) userinfo = data.data;
        $('.author_container').html((_.template($('#author_info_tpl').html(), userinfo)()));
      });
    }

    $('#qrcode').qrcode({
      text: 'http://aissues.com/m/book.php?id=' + getQueryString('id'),
      width: 120,
      height: 120
    });

  </script>
</div>
<?php include_once('./ui/cnzz.php');?>
</body>
</html>