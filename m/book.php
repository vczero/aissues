<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('./meta.php') ?>
  <title>Aissues.com 一个把书读薄的网站，一个把知识系统化的网站</title>
  <link rel="stylesheet" type="text/css" href="/js/editor/css/wangEditor.min.css">
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
      display:none;
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
  </style>
</head>
<html>
<body>
  <?php include('./header.php') ?>
  <div class="book">
    <div class="zhuan">转载</div>
    <div id="editor" class="wangEditor-txt" contenteditable="true">
      <div style="margin-top:100px;">
        <?php include('./../ui/loading.php');?>
      </div>
    </div>
    <div id="duo_shuo_view"></div>
    <div class="copyright">版权所有 © aissues.com</div>
  </div>
  <script type="text/javascript" src="/js/jquery.min.js"></script>
  <script src="/js/highlight.min.js"></script>
  <script src="/js/editor/js/wangEditor.min.js"></script>
  <script>
    var userinfo = null;
    var duoshuoQuery = {short_name:"aissues"};
    function get_query_string(name) {
      var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
      var r = window.location.search.substr(1).match(reg);
      if(r!=null)return  unescape(r[2]); return null;
    }
    //如果内嵌到主app, 则隐藏头部
    var play = get_query_string('play');
    if(play && play.indexOf('main_app_') > -1){
      $('.book').css('padding-top', '0px');
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

    $.get('/api/public/book_id.php?bookid=' + get_query_string('id'), function (data) {
      if(data.status){
        var content = data.data.content || '';
        content += '<?php require_once('./../ui/link.php');?>';
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
        justifyImg();

        setTimeout(function () {
          justifyImg();
        }, 5000);

        //SEO
        var obj = data.data;
        var obj = data.data;
        $('title').text(obj.bookname);
       
       //多说
       var urlid = location.href.replace('/m/', '/');
        var duoshuo = '<div class="ds-thread" data-thread-key="'+ get_query_string('id') + '" data-title="'+ obj.bookname +'" data-url="'+ urlid +'"></div>';
        $('#duo_shuo_view').html(duoshuo);
        var ds = document.createElement('script');
        ds.type = 'text/javascript';ds.async = true;
        ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
        ds.charset = 'UTF-8';
        (document.getElementsByTagName('head')[0]
        || document.getElementsByTagName('body')[0]).appendChild(ds);
        
      }else{
        $('.ds-thread').css('display', 'none');
        $('.book').html('<div class="error">不好意思，请检查网址是否正确~~~</div>');
      }
    });
  </script>
  <?php include_once('./../ui/cnzz.php');?>
</body>
</html>