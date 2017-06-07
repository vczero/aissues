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
  <link rel="stylesheet" type="text/css" href="/js/editor/css/wangEditor.min.css">
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
    .main_right{
      background-color:#F6F6F6;
      position: absolute;
      left:175px;
      right:0;
      top:1px;
      bottom:0;
    }

    .main_catalog{
      width:250px;
      min-height:400px;
      overflow-y: scroll;
      background-color:#fff;
      border-right:1px solid #ddd !important;
      border-bottom:1px solid #ddd !important;
    }

    .main_catalog_title{
      margin-top:20px;
      margin-left:10px;
      margin-right:10px;
      text-align: center;
    }

    .main_catalog select{
      width:180px;
      height:30px;
      border:1px solid #ddd;
    }

    .main_catalog_btn img{
      width:21px;
    }
    .main_catalog_item>span{
      display: block;
      float: left;
    }
    .main_catalog_item input{
      font-size:14px;
      width:180px;
      height:30px;
      outline: none;
      padding-left:5px;
    }

    .main_content{
      width:750px;
      min-height:500px;
      position: absolute;
      left:260px;
      top:0;
      bottom: 0;
      border:1px solid #ddd;
      border-top:0;
      border-bottom: 0;
      background-color: #fff;
    }
    .main_content_title input{
      width:700px;
      height:35px;
      line-height:35px;
      font-size:22px;
      font-weight: bold;
      border:0;
      color: #5E5E5E;
      background-color: #fff;
      outline: none;
      margin-top:20px;
    }

    .main_content_btns img{
      width:21px;
      vertical-align: middle;
    }

    #book_name{
      font-size:16px;
      font-weight:bold;
      color: #0166FF;
    }

    .wangEditor-container{
      height: 100% !important;
      border:0 !important;
    }
    .wangEditor-container img{
      max-width:734px !important;
    }
    pre code{
      display: block;
      overflow-x: scroll !important;
      max-width:840px;
    }
    #editor{
      position: absolute;
      left:0;
      top:65px;
      bottom:0;
      right: 0;
      border-bottom:1px solid #ddd;
    }

    .btns{
      position: absolute;
      bottom:0;
      height:50px;
      width:750px;
      z-index: 999999999999999;
    }
    .btns>div{
      height:32px;
      line-height:32px;
      width:70px;
      text-align: center;
      background-color: #E7505A;
      color:#fff;
      cursor: pointer;
      border-radius:2px;
    }
    .btns_save{
      margin-left: 30px;
    }


    .main_catalog_list{
      width:245px;
      height:260px;
      border:1px solid #fff;
    }
    .book_img{
      width:150px;
      height:200px;
      margin-left:auto;
      margin-right:auto;
      margin-top:10px;
      border:1px solid #ddd;
    }
    #upload{
      width:150px;
      height:200px;
    }

    .btns_post{
      float: right;
      margin-right: 20px;
      background-color:#31C5D2 !important;
    }
  </style>
</head>
<body>
<?php require_once('../ui/console/header.php');?>
<div class="main_view">
  <?php require_once('../ui/console/menu.php')?>
  <div class="main_right fl">
    <div class="fl main_catalog">
      <div class="main_catalog_title">
        <span id="book_name"></span>
      </div>
      <div class="main_catalog_list">
          <div class="book_fm">
            <div class="book_img">
              <img src="/images/book.png" id="upload"/>
              <input type="file" style="display:none;" id="upload_file"/>
            </div>
            <div style="text-align: center;">
              <span id="upload_tip">请上传小书封面(150*200)</span>
            </div>
            <div id="some_tips" style="margin-left:10px;margin-top:10px;margin-right:10px;"></div>
          </div>
      </div>
    </div>
    <div class="fl main_content">
      <div id="editor"></div>
      <div class="btns">
        <div class="fl btns_save">保存</div>
        <div class="fl btns_post">发布</div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="/js/underscore-min.js"></script>
<script type="text/javascript" src="/js/editor/js/wangEditor.min.js"></script>
<script type="text/javascript">
  var book_id = "<?php echo $_REQUEST['book_id'];?>";
  var img_container = $('#upload');

  //文本编辑器
  wangEditor.config.mapAk = 'DrLq7BuqEA5TrOl7ohgrOyu9tlKDSmYN';
  var editor = new wangEditor('editor');
  editor.config.uploadImgUrl = '/api/book/upload_article_img.php';
  editor.config.uploadImgFileName = 'file';
  editor.create();

  //初始化数据
  $.get('/api/book/getone.php?book_id='+ book_id, function (data) {
    if(data.status){
      var obj = data.data;
      //设置书名
      $('#book_name').html('' + obj.bookname + '');
      //设置封面
      if(obj.bookimg){
        img_container[0].src = obj.bookimg;
        $('#upload_tip').text('小书封面(150*200)');
      }else{
        $('#some_tips').text('图片的比例，宽 ： 高 = 0.75 即可。这样展示更好的效果；同时，可以上传自己设计的封面。');
      }
      //设置图书内容
      if(obj.content){
        editor.$txt.html(obj.content);
      }else{
        editor.$txt.html('请在这里输入正文内容，请不要输入标题（编写正文时，删除该行）');
      }
    }
  });
  
  //上传头像
  var upload_file = $('#upload_file');
  var upload_tip = $('#upload_tip');
  var tip_html = '<span style="color:red;">上传失败，请重试</span>';
  img_container.on('click', function () {
    upload_file.click();
  });

  upload_file.on('change', function () {
    var data = new FormData();
    var files = upload_file[0].files;
    if(files.length <1 ){
      upload_tip.html(tip_html);
      return;
    }
    data.append('file', files[0]);
    data.append('bookid', book_id || '');
    $.ajax({
      url:'/api/book/upload_img.php',
      type:'POST',
      data:data,
      cache: false,
      contentType: false,
      processData: false,
      success:function(data){
        console.log(data);
        if(data.status){
          img_container[0].src = data.data;
          upload_tip.text('封面保存成功');
        }else{
          upload_tip.html(tip_html);
        }
      }
    });
  });

  //保存小书内容到数据库
  $('.btns_save').on('click', function () {
    var html = editor.$txt.html();
    var obj =  {
      bookid: book_id,
      content: html
    };
    $.post('/api/book/save.php',  obj, function (data) {
      if(data.status){
        var infoWindow = new Alert('提示', '保存小书编辑成功', null, 2000);
        infoWindow.show();
      }else{
        var infoWindow = new Alert('提示', data.info);
        infoWindow.show();
      }
    });
  });

  //发布小书
  $('.btns_post').on('click', function () {
    var html = editor.$txt.html();
    var obj =  {
      bookid: book_id,
      content: html
    };
    $.post('/api/book/save_post.php',  obj, function (data) {
      if(data.status){
        var infoWindow = new Alert('恭喜你', '发布小书成功');
        infoWindow.show();
      }else{
        var infoWindow = new Alert('提示', data.info);
        infoWindow.show();
      }
    });
  });


</script>
<?php include_once('../ui/cnzz.php');?>
</body>
</html>
