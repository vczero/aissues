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
    <title>Aissues后台管理系统</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <script src="assets/js/echarts.min.js"></script>
    <link rel="stylesheet" href="assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="assets/css/amazeui.datatables.min.css" />
    <link rel="stylesheet" href="assets/css/app.css">
    <script src="assets/js/jquery.min.js"></script>

</head>

<body data-type="index">
    <script src="assets/js/theme.js"></script>
    <div class="am-g tpl-g">
      <?php include_once('header.php');?>
      <?php include_once('menu.php');?>
      <!-- 内容区域 -->
      <div class="tpl-content-wrapper">

        <div class="container-fluid am-cf">
          <div class="row">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
              <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 管理后台首页 <small>Aissues.com</small></div>
              <p class="page-header-description">致力于帮助程序员把书读薄</p>
            </div>

          </div>

        </div>

        <div class="row-content am-cf">
          <div class="row  am-cf">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-4">
              <div class="widget am-cf">
                <div class="widget-head am-cf">
                  <div class="widget-title am-fl">文章量</div>
                  <div class="widget-function am-fr">
                    <a href="javascript:;" class="am-icon-cog"></a>
                  </div>
                </div>
                <div class="widget-body am-fr">
                  <div class="am-fl">
                    <div class="widget-fluctuation-period-text">
                      <span id="news_count"></span>
                      <button class="widget-fluctuation-tpl-btn">
                        <i class="am-icon-calendar"></i>

                      </button>
                    </div>
                  </div>
                  <div class="am-fr am-cf">
                    <div class="widget-fluctuation-description-amount text-success" am-cf>


                    </div>
                    <div class="widget-fluctuation-description-text am-text-right">

                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
              <div class="widget widget-primary am-cf">
                <div class="widget-statistic-header">
                  用户量
                </div>
                <div class="widget-statistic-body">
                  <div class="widget-statistic-value" id="user_count"></div>
                  <div class="widget-statistic-description">

                  </div>
                  <span class="widget-statistic-icon am-icon-credit-card-alt"></span>
                </div>
              </div>
            </div>
            <div class="am-u-sm-12 am-u-md-6 am-u-lg-4">
              <div class="widget widget-purple am-cf">
                <div class="widget-statistic-header">
                  小书量
                </div>
                <div class="widget-statistic-body">
                  <div class="widget-statistic-value" id="book_counts"></div>
                  <div class="widget-statistic-description">

                  </div>
                  <span class="widget-statistic-icon am-icon-support"></span>
                </div>
              </div>
            </div>
          </div>

          <div class="row am-cf">
            <div class="am-u-sm-12 am-u-md-8">
              <div class="widget am-cf">
                <div class="widget-head am-cf">
                  <div class="widget-title am-fl">用户注册走势</div>
                  <div class="widget-function am-fr">
                    <a href="javascript:;" class="am-icon-cog"></a>
                  </div>
                </div>
                <div class="widget-body-md widget-body tpl-amendment-echarts am-fr" id="tpl-echarts">

                </div>
              </div>
            </div>

            <div class="am-u-sm-12 am-u-md-4">
              <div class="widget am-cf">
                <div class="widget-head am-cf">
                  <div class="widget-title am-fl">相关指标</div>
                  <div class="widget-function am-fr">
                    <a href="javascript:;" class="am-icon-cog"></a>
                  </div>
                </div>
                <div class="widget-body widget-body-md am-fr">

                  <div class="am-progress-title">CPU Load <span class="am-fr am-progress-title-more">28% / 100%</span></div>
                  <div class="am-progress">
                    <div class="am-progress-bar" style="width: 15%"></div>
                  </div>
                  <div class="am-progress-title">CPU Load <span class="am-fr am-progress-title-more">28% / 100%</span></div>
                  <div class="am-progress">
                    <div class="am-progress-bar  am-progress-bar-warning" style="width: 75%"></div>
                  </div>
                  <div class="am-progress-title">CPU Load <span class="am-fr am-progress-title-more">28% / 100%</span></div>
                  <div class="am-progress">
                    <div class="am-progress-bar am-progress-bar-danger" style="width: 35%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="row am-cf">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-4 widget-margin-bottom-lg ">
              <div class="tpl-user-card am-text-center widget-body-lg">
                <div class="tpl-user-card-title">
                                <span>
                                  <?php session_start(); echo $_SESSION['_admin_email']?>
                              </span>
                </div>
                <div class="achievement-subheading">
                  坚持，坚持，再坚持
                </div>
                <img class="achievement-image" src="assets/img/user07.png" alt="">
                <div class="achievement-description">
                  坚持多少天，
                  <strong>打井</strong> 才会有
                  <strong>水</strong>喝。
                </div>
              </div>
            </div>

            <div class="am-u-sm-12 am-u-md-12 am-u-lg-8 widget-margin-bottom-lg">

              <div class="widget am-cf widget-body-lg">

                <div class="widget-body  am-fr">
                  <div class="am-scrollable-horizontal ">
                    <table width="100%" class="am-table am-table-compact am-text-nowrap tpl-table-black " id="example-r">
                      <thead>
                      <tr>
                        <th>编号</th>
                        <th>书名</th>
                        <th>作者</th>
                        <th>时间</th>
                        <th>类型</th>
                      </tr>
                      </thead>
                      <tbody id="list_content"></tbody>
                      <script type="text/template" id="list">
                        <% _.each(objs, function (item, i) { %>
                        <tr class="gradeX">
                          <td><%=parseInt(i) + 1%></td>
                          <td><%=item.bookname%></td>
                          <td><%=item.userid%></td>
                          <td><%=item.time%></td>
                          <td><%=item.type%></td>
                        </tr>
                        <%});%>
                      </script>
                    </table>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <?php include_once('alert.php');?>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/amazeui.datatables.min.js"></script>
    <script src="assets/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script type="text/javascript" src="/js/underscore-min.js"></script>
    <script type="text/javascript">
      $.get('/base/api/get_book_count.php', function (data) {
        $('#book_counts').text(data.data['count(*)'] + '本');
      });

      $.get('/base/api/get_user_count.php', function (data) {
        $('#user_count').text(data.data['count(*)'] + '人');
      });

      $.get('/base/api/get_news_count.php', function (data) {
        $('#news_count').text(data.data['count(*)'] + '篇');
      });
      var objs = [];
      $.get('/base/api/get_news_by_count.php', function (data) {
        if(data.status){
          objs = data.data;
          $('#list_content').html((_.template($('#list').html(), objs)()));
        }
      })
    </script>
</body>

</html>