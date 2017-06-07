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
                                <div class="widget-title  am-cf">用户列表</div>
                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar"></div>
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select"></div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input id="user_id" type="text" class="am-form-field" placeholder="用户ID" />
                                        <span class="am-input-group-btn">
            <button id="search_btn" class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button"></button>
          </span>
                                    </div>
                                </div>

                                <div class="am-u-sm-13">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black " id="example-r">
                                        <thead>
                                            <tr>
                                                <th>编号</th>
                                                <th>邮箱</th>
                                                <th>用户ID</th>
                                                <th>昵称</th>
                                                <th>岗位</th>
                                                <th>公司</th>
                                                <th>时间</th>
                                                <th>ip</th>
                                                <th>是否禁言</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list_content"></tbody>
                                        <script type="text/template" id="list">
                                          <% _.each(objs, function (item, i) { %>
                                            <tr class="gradeX">
                                              <td><%=parseInt(i)+1%></td>
                                              <td><%=item.email%></td>
                                              <td><%=item.userid%></td>
                                              <td><%=item.nickname%></td>
                                              <td><%=item.job%></td>
                                              <td><%=item.company%></td>
                                              <td><%=item.time%></td>
                                              <td><%=item.ip%></td>
                                              <td><%=item.is_close%></td>
                                              <td>
                                                <div class="tpl-table-black-operation">
                                                  <%if(parseInt(item.is_close)){%>
                                                  <a is-close="0" href="javascript:;" class="tpl-table-black-operation-del" user-id="<%=item.userid%>">
                                                    <i class="am-icon-trash"></i> 恢复
                                                  </a>
                                                  <%}else{%>
                                                  <a is-close="1" href="javascript:;" user-id="<%=item.userid%>">
                                                    <i class="am-icon-pencil"></i> 禁言
                                                  </a>
                                                  <%}%>
                                                </div>
                                              </td>
                                            </tr>
                                          <%});%>
                                        </script>
                                    </table>
                                </div>
                                <div class="am-u-lg-12 am-cf">
                                    <div class="am-fr">
                                        <ul id="page_nums" class="am-pagination tpl-pagination"></ul>
                                        <span id="pages"></span>
                                    </div>
                                </div>
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
      var current_page = 1;
      var pages = 1;
      var url = '/base/api/get_users.php?page=';
      //更改表格数据
      function doshow() {
        $.get(url + current_page, function (data) {
          if(data.status){
            objs = data.data.rows;
            $('#list_content').html((_.template($('#list').html(), objs)()));
            //设置总页数、记录数
            pages = data.data.pages;
            var total = data.data.total;
            $('#pages').text('总共：' + pages + ' 页， ' +  total + '条记录');
            //设置页码块
            var page_nums = $('#page_nums');
            //先置空
            page_nums.html('');
            //前一页
            page_nums.append('<li><a>«</a></li>');
            //当前页
            page_nums.append('<li class="am-active"><a>' + current_page + '</a></li>');
            //后一页
            page_nums.append('<li><a>»</a></li>');

          }
        });
      }
      doshow();

      //绑定事件
      $('#page_nums').on('click', function (e) {
        if(e.target && e.target.nodeName.toLowerCase() == 'a'){
          var num = $(e.target).text();
          if(num == '«'){
            current_page = current_page - 1;
            if(current_page < 1){
              current_page = 1;
              (new Alert('提示', '已经是第一页了')).show();
            }else{
              doshow();
            }
          }else if(num == '»'){
            current_page = current_page + 1;
            if(current_page > pages){
              current_page = current_page - 1;
              (new Alert('提示', '已经是最后一页了')).show();
            }else{
              doshow();
            }
          }
        }
      });

      $('#search_btn').on('click', function () {
        var userid = $('#user_id').val();
        if(!userid)return;
        $.get('/base/api/get_users_id.php?userid='+ userid, function (data) {
          if(data.status){
            objs = data.data;
            $('#list_content').html((_.template($('#list').html(), objs)()));
            $('#page_nums').html('');
            $('#pages').html('');
          }else{
            (new Alert('提示', '没有查到相关用户')).show();
          }
        });
      });

      $('table').on('click', function (e) {
        if(e.target && e.target.nodeName.toLowerCase() == 'a'){
          var elm = $(e.target);
          var userid = elm.attr('user-id');
          var is_close = elm.attr('is-close');
          var obj = {
            userid: userid,
            isclose: parseInt(is_close)
          };

          $.post('/base/api/close_user.php', obj, function (data) {
            if(data.status){
              return (new Alert('提示', data.info, function () {
                location.reload();
              })).show();
            }
            (new Alert('提示', data.info)).show();
          });
        }

      });

    </script>
</body>

</html>