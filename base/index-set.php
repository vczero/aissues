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
  <title>Aissues</title>
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="assets/i/favicon.png">
  <script src="assets/js/echarts.min.js"></script>
  <link rel="stylesheet" href="assets/css/amazeui.min.css" />
  <link rel="stylesheet" href="assets/css/amazeui.datatables.min.css" />
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
              <div class="widget-title  am-cf" style="color: red;">首页配置</div>
            </div>
            <div>
              <form class="am-form tpl-form-border-form">
                <div class="am-form-group">
                  <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">标题<span class="tpl-form-line-small-title"></span></label>
                  <div class="am-u-sm-12">
                    <input id="title" type="text" class="tpl-form-input am-margin-top-xs" placeholder="请输入标题文字">
                    <small>请填写标题文字10-20字左右。</small>
                  </div>
                </div>
                <div class="am-form-group">
                  <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">Banner图片<span class="tpl-form-line-small-title"></span></label>
                  <div class="am-u-sm-12">
                    <input id="imgurl" type="text" class="tpl-form-input am-margin-top-xs" placeholder="请输入Banner图片链接">
                    <small>Banner展示的图片链接</small>
                  </div>
                </div>
                <div class="am-form-group">
                  <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">Banner链接<span class="tpl-form-line-small-title"></span></label>
                  <div class="am-u-sm-12">
                    <input id="link" type="text" class="tpl-form-input am-margin-top-xs" placeholder="请输入Banner链接">
                    <small>Banner的链接</small>
                  </div>
                </div>
                <div class="am-form-group">
                  <div class="am-u-sm-12 am-u-sm-push-12">
                    <button id="save_btn" type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success">提交</button>
                  </div>
                </div>
              </form>

              <div class="widget-head am-cf">
                <div class="widget-title  am-cf" style="color: red;">Banner数据</div>
              </div>
              <div class="am-u-sm-13">
                <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                  <thead>
                  <tr>
                    <th>编号</th>
                    <th>标题</th>
                    <th>链接</th>
                    <th>图片</th>
                    <th>时间</th>
                  </tr>
                  </thead>
                  <tbody id="list_content"></tbody>
                  <script type="text/template" id="list">
                    <% _.each(objs, function (item, i) { %>
                    <tr class="gradeX">
                      <td><%=parseInt(i)+1%></td>
                      <td><%=item.title%></td>
                      <td><%=item.link%></td>
                      <td><%=item.imgurl%></td>
                      <td><%=item.time%></td>
                    </tr>
                    <%});%>
                  </script>
                </table>
              </div>

              <div class="widget-head am-cf">
                <div class="widget-title  am-cf" style="color: red;">推荐小书配置</div>
              </div>
              <div>
                <form class="am-form tpl-form-border-form">
                  <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">NO.1<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                      <input id="bookid_1" type="text" class="tpl-form-input am-margin-top-xs" placeholder="小书ID">
                    </div>
                  </div>
                  <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">NO.2<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                      <input id="bookid_2" type="text" class="tpl-form-input am-margin-top-xs" placeholder="小书ID">
                    </div>
                  </div>
                  <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">NO.3<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                      <input id="bookid_3" type="text" class="tpl-form-input am-margin-top-xs" placeholder="小书ID">
                    </div>
                  </div>
                  <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">NO.4<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                      <input id="bookid_4" type="text" class="tpl-form-input am-margin-top-xs" placeholder="小书ID">
                    </div>
                  </div>
                  <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">NO.5<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                      <input id="bookid_5" type="text" class="tpl-form-input am-margin-top-xs" placeholder="小书ID">
                    </div>
                  </div>
                  <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">NO.6<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                      <input id="bookid_6" type="text" class="tpl-form-input am-margin-top-xs" placeholder="小书ID">
                    </div>
                  </div>
                  <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">NO.7<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                      <input id="bookid_7" type="text" class="tpl-form-input am-margin-top-xs" placeholder="小书ID">
                    </div>
                  </div>
                  <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">NO.8<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                      <input id="bookid_8" type="text" class="tpl-form-input am-margin-top-xs" placeholder="小书ID">
                    </div>
                  </div>
                  <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">NO.9<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                      <input id="bookid_9" type="text" class="tpl-form-input am-margin-top-xs" placeholder="小书ID">
                    </div>
                  </div>
                  <div class="am-form-group">
                    <label for="user-name" class="am-u-sm-12 am-form-label am-text-left">NO.10<span class="tpl-form-line-small-title"></span></label>
                    <div class="am-u-sm-12">
                      <input id="bookid_10" type="text" class="tpl-form-input am-margin-top-xs" placeholder="小书ID">
                    </div>
                  </div>
                  <div class="am-form-group">
                    <div class="am-u-sm-12 am-u-sm-push-12">
                      <button id="save_books_btn" type="button" class="am-btn am-btn-primary tpl-btn-bg-color-success">提交</button>
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
<script src="assets/js/amazeui.min.js"></script>
<script src="assets/js/amazeui.datatables.min.js"></script>
<script src="assets/js/dataTables.responsive.min.js"></script>
<script src="assets/js/app.js"></script>
<script type="text/javascript" src="/js/underscore-min.js"></script>
<script type="text/javascript">
  var objs = [];
  $('#save_btn').on('click', function () {
    var obj = {
      title: $('#title').val(),
      link: $('#link').val(),
      imgurl: $('#imgurl').val()
    };
    $.post('/base/api/ad/banner_write.php', obj, function (data) {
      if(data.status){
        new Alert('提示', data.info, function () {
          location.reload();
        }).show();
      }else{
        new Alert('提示', data.info).show()
      }
    });
  });

  $.get('/base/api/ad/banner_get.php?num=10', function (data) {
    if(data.status){
      objs = data.data;
      $('#list_content').html((_.template($('#list').html(), objs)()));
    }
  });

  $.get('/base/api/index_set/get.php', function (data) {
    if(data.status){
      for(var i in data.data){
        $('#bookid_' + (parseInt(i) + 1)).val(data.data[i]);
      }
    }
  });
  
  $('#save_books_btn').on('click', function () {
    var ids = [];
    for(var i = 0; i <10; i++){
      var id = $('#bookid_' + (parseInt(i) + 1)).val();
      if(!id){
        return (new Alert('提示', '10个字段必须填全')).show();
      }
      ids.push(id);
    }
    $.post('/base/api/index_set/write.php', {books: ids}, function (data) {
      if(data.status){
        (new Alert('提示', data.info, function () {
          location.reload();
        })).show();
      }else{
        (new Alert('提示', data.info)).show();
      }
    });
  });
</script>
</body>

</html>