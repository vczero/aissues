<!DOCTYPE html>
<html lang="ch">
<head>
  <?php include('./meta.php') ?>
  <title>Aissues-新闻</title>
  <style type="text/css">
    .book{
      width:96%;
      margin-left:2%;
      min-height:300px;
      padding-top:46px;
    }
    .error{
      text-align: center;
      line-height:70px;
    }
    .wangEditor-container{
      border:0 !important;
    }
    .wangEditor-container img{
      max-width:100% !important;
    }
    pre code{
      display: block;
      overflow-x: scroll !important;
      max-width:100% !important;
    }
    .zhuan{
      position: relative;
      width:45px;
      height:35px;
      background-color:#E51970;
      color:#fff;
      text-align: center;
      margin-top:5px;
      right: 0;
      line-height:35px;
    }
    .copyright{
      text-align: center;
      font-size: 13px;
      margin-top:5px;
      color:#5F5F5F;
    }
    #dituContent{
     width:100%;
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
  </style>
  <link rel="stylesheet" type="text/css" href="/js/editor/css/wangEditor.min.css">
  <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>
<body>
<?php require_once('./header.php');?>
<script src="/js/highlight.min.js"></script>
<script src="/js/editor/js/wangEditor.min.js"></script>
<script type="text/javascript" src="/js/underscore-min.js"></script>
<div class="book">
  <div id="news_title"></div>
  <div class="news_info">
    <span id="news_author"></span>
    <span id="news_time" style="font-size:12px;"></span>
  </div>
  <div id="editor" class="wangEditor-txt" contenteditable="true">
    <div style="margin-top:100px;">
      <?php include('./../ui/loading.php');?>
    </div>
  </div>
  <div class="ds-thread" data-thread-key="bookid" data-title="bookname" data-url="pageurl"></div>
  <div class="copyright">版权所有 © aissues.com</div>
</div>
<script type="text/javascript">
    function getQueryString(name) {
      var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
      var r = window.location.search.substr(1).match(reg);
      if(r!=null)return  unescape(r[2]); return null;
    }

    //如果内嵌到主app, 则隐藏头部
    var play = getQueryString('play');
    if(play && play.indexOf('main_app_') > -1){
      $('.book').css('padding-top', '0px');
      $('#news_title').css('display', 'none');
      $('.news_info').css('display', 'none');
    }else{
      $('.header').css('display', 'block');
      $('.zhuan').css('display', 'block');
    }

    function justifyImg() {
      //重新设置所有不合规的图片宽度
      var clientwidth = document.body.clientWidth;
      var imgs = $('.wangEditor-container img');
      $.each(imgs, function (i, v) {
        var el = $(v);
        var imgWidth = parseInt(el[0].style.width);
        if(imgWidth > (clientwidth * 0.96)){
          el.css('width', '');
          el.css('height', '');
          el.css('max-width', '100% !important');
        }
      });
    }
    $.get('/api/public/news_id.php?newsid=' + getQueryString('id'), function (data) {
      if(data.status){
        var content = data.data.content || '';
        content += '<?php require_once('./../ui/link.php');?>';
        $('#editor').html(content);
        var editor = new wangEditor('editor');
        editor.renderTxt();
        editor.renderEditorContainer();
        editor.disable();

        justifyImg();

        setTimeout(function () {
          justifyImg();
        }, 5000);

        $('#news_title').html(data.data.title);
        $('#news_author').html(data.data.author);
        $('#news_time').html(data.data.time);
        //SEO
        var obj = data.data;
        $('title').text(obj.title);
        //设置SEO关键字
        $('[name="Keywords"]').attr('content', data.data.keywords);
        $('[name="Description"]').attr('content', data.data.title + ' aissues.com');

      }else{
         $('.book').html('<div class="error">不好意思，请检查网址是否正确~~~</div>');
       }
    });

  </script>
  <?php include_once('./../ui/cnzz.php');?>
</body>
</html>