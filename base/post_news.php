<?php
session_start();
//没有登录直接重定向
if(!$_SESSION['_admin_userid']){
  header('Location: /base/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aissues后台系统</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="assets/i/favicon.png">
    <script src="assets/js/echarts.min.js"></script>
    <link rel="stylesheet" href="assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="assets/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="/js/editor/css/wangEditor.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <script src="assets/js/jquery.min.js"></script>
</head>

<body data-type="widgets">
    <script src="assets/js/theme.js"></script>
    <div class="am-g tpl-g">
      <?php include_once('header.php');?>
      <?php include_once('menu.php');?>
        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">发布文章</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">

                                <form class="am-form tpl-form-border-form">
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">标题 <span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-12">
                                            <input id="title" type="text" class="tpl-form-input am-margin-top-xs" placeholder="请输入标题文字">
                                            <small>请填写标题文字10-20字左右。</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-12 am-form-label am-text-left">作者 <span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-12  am-margin-top-xs">
                                          <input id="author" type="text" class="am-margin-top-xs" placeholder="作者">
                                          <small>发布时间为必填</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label class="am-u-sm-12 am-form-label  am-text-left">SEO关键字 <span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-12">
                                            <input id="keywords" type="text" class="am-margin-top-xs" placeholder="输入SEO关键字">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-weibo" class="am-u-sm-12 am-form-label  am-text-left">封面图 <span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-12 am-margin-top-xs">
                                            <div class="am-form-group am-form-file">
                                                <div class="tpl-form-file-img">
                                                    <img id="img_container" src="/images/site/article.jpg" alt="">
                                                </div>
                                                <button id="upload_btn" type="button" class="am-btn am-btn-danger am-btn-sm ">
                                                    <i class="am-icon-cloud-upload"></i> 添加封面图片
                                                </button>
                                                <span id="upload_tip"></span>
                                            </div>
                                            <input id="upload_file" type="file" style="display: none;">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <div class="am-u-sm-12">
                                          <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                            <select id="type" data-am-selected="{btnSize: 'sm'}">
                                              <option value="科技">科技</option>
                                              <option value="互联网">互联网</option>
                                              <option value="weex">weex</option>
                                              <option value="开源项目">开源项目</option>
                                              <option value="JavaScript">JavaScript</option>
                                              <option value="CSS">CSS</option>
                                              <option value="Java">Java</option>
                                              <option value="Go">Go</option>
                                              <option value="Android">Android</option>
                                              <option value="iOS">iOS</option>
                                              <option value="React Native">React Native</option>
                                              <option value="Swift">Swift</option>
                                              <option value="生活">生活</option>
                                              <option value="电影">电影</option>
                                              <option value="AR_VR">AR_VR</option>
                                              <option value="鬼才学IT">鬼才学IT</option>
                                              <option value="职业规划">职业规划</option>
                                              <option value="微信小程序">微信小程序</option>
                                              <option value="H5">H5</option>
                                              <option value="后端">后端</option>
                                              <option value="运维">运维</option>
                                              <option value="产品">产品</option>
                                              <option value="管理">管理</option>
                                              <option value="专访">专访</option>
                                              <option value="本站新闻">本站新闻</option>
                                            </select>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-12 am-form-label  am-text-left">文章内容</label>
                                        <div class="am-u-sm-12 am-margin-top-xs">
                                          <div id="editor" style="height:700px;color:#000"></div>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <div class="am-u-sm-12 am-u-sm-push-12">
                                            <button type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript" src="/js/editor/js/wangEditor.min.js"></script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script type="text/javascript">
      //文本编辑器
      wangEditor.config.mapAk = 'DrLq7BuqEA5TrOl7ohgrOyu9tlKDSmYN';
      var editor = new wangEditor('editor');
      editor.config.uploadImgUrl = '/base/api/upload_img.php';
      editor.config.uploadImgFileName = 'file';
      editor.create();

      //保存文章
      $('.tpl-btn-bg-color-success').on('click', function () {
        var title = $('#title').val();
        var author = $('#author').val();
        var content = editor.$txt.html();
        var keywords = $('#keywords').val();
        var type = $('#type').find('option:selected').text();
        var img = $('#img_container').attr('imgurl');
        var obj = {
          title: title,
          author: author,
          content: content,
          keywords: keywords,
          type: type,
          imgurl: img
        };

        if(!title || !author || !content || !keywords || !type){
          return (new Alert('提示', '所有字段都不能为空')).show();
        }
        
        $.post('/base/api/save_news.php', obj, function (data) {
          if(data.status){
            (new Alert('提示', '文章创建成功', function () {
              location.reload();
            })).show();
          }else{
            (new Alert('提示', data.info)).show();
          }
        });
      });

      //上传图片
      var upload_file = $('#upload_file');
      var upload_tip = $('#upload_tip');
      var imgContainer = $('#img_container');
      var tip_html = '<span style="color:red;">上传失败，请重试</span>';
      $('#upload_btn').on('click', function () {
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
        $.ajax({
          url:'/base/api/upload_news_fm.php',
          type:'POST',
          data:data,
          cache: false,
          contentType: false,
          processData: false,
          success:function(data){
            if(data.status){
              imgContainer[0].src = data.data;
              imgContainer.attr('imgurl', data.data);
              upload_tip.text('图片保存成功');
            }else{
              upload_tip.html(tip_html);
            }
          }
        });
      });
    </script>
</body>
</html>