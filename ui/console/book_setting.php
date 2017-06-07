
<style type="text/css">
  .table_view{
    width:100%;
  }
  .table_view_info{
    min-height:500px;
    width:1010px;
    color: #4B5357;
  }
  .table_view_title{
    margin-top: 40px;
    text-align: center;
    font-size:15px;
    font-weight: bold;
    width:80px;
    color: #fff;
    margin-left: auto;
    margin-right: auto;
    background-color: #E7505A;
    height:35px;
    line-height:35px;
    border-radius:3px;
  }
  .table_view_info table{
    width:950px;
    border:1px solid #ddd;
    border-top:0;
    border-right: 0;
    margin-top:20px;
    margin-left:20px;
    table-layout:fixed;
  }
  .table_view_info td{
    border-top:1px solid #ddd;
    border-right:1px solid #ddd;
    height:30px;
  }
  td{
    width:100%;
    word-break:keep-all;
    white-space:nowrap;
    overflow:hidden  !important;
    text-overflow:ellipsis !important;
    padding-left:2px;
  }
  .table_post, .table_delete{
    width:70px;
    height:20px;
    text-align: center;
    line-height:20px;
    margin-left:12px;
    cursor: pointer;
    color: #E7505A;
    border-radius:2px;
  }
  .table_delete{
    border:1px solid #E7505A;
  }
  .table_post{
    /*background-color:#44B549;*/
    border:1px solid #36C6D3;
    color: #36C6D3 !important;
  }
  .is_post{
    background-color: #A2A2A2;
  }
  .table_re_upload, .table_upload{
    width:70px;
    height:20px;
    line-height:20px;
    text-align: center;
    margin-left:1px;
    cursor: pointer;
    border-radius:2px;
  }
  .table_re_upload{
    border:1px solid #E7505A;
    color: #E7505A;
  }
  .table_upload{
    color: #36C6D3;
    border:1px solid #36C6D3;
  }

  .delete_btn{
    width:50px;
    height:20px;
    text-align: center;
    line-height:20px;
    color: #E7505A;
    border-radius:2px;
    margin-left: 15px;
    cursor: pointer;
    border:1px solid #E7505A;
  }
  .is_sure_delete{
    position: absolute;
    z-index: 9;
    left:200px;
    top:50%;
    margin-top:-50px;
    right:0;
    width:500px;
    height:100px;
    background-color:#fff;
    border: 1px solid #ddd;
    border-radius:3px;
    display: none;
  }
  .is_sure_delete input{
    height:35px;
    font-size:14px;
    padding-left: 5px;
    width: 470px;
    border:1px solid #ddd;
    border-radius:2px;
    margin-top:4px;
    margin-left:10px;
  }
  .sure_delete_btn>div{
    height:35px;
    width:60px;
    background-color:#F93B00;
    color: #fff;
    text-align: center;
    line-height:35px;
    border-radius:3px;
    margin-top:10px;
    margin-left:10px;
    margin-right:10px;
    cursor: pointer;
  }
  .mask{
    position: fixed;
    left:0;
    right:0;
    top:0;
    bottom: 0;
    height: 100%;
    background-color: #0B0B0C;
    opacity: 0.8;
    display: none;
  }
  .update_btn{
    width:50px;
    height:20px;
    line-height:20px;
    text-align: center;
    color: #31C5D2;
    margin-left:15px;
    cursor: pointer;
    border:1px solid #36C6D3;
  }
  .update_frame{
    position: absolute;
    left:150px;
    top:100px;
    width:600px;
    background-color: #fff;
    border:1px solid #ddd;
    height:400px;
    z-index:3;
    border-radius: 4px;
    font-size: 14px;
    padding-left:20px;
    font-weight: bold;
    display: none;
  }
  .update_book_name{
    margin-top:20px;
  }
  .update_book_name input{
    width:500px;
    height:32px;
    border:1px solid #ddd;
    padding-left:5px;
    border-radius:2px;
    font-size:14px;
  }
  .update_intro{
    margin-top:10px;
  }
  .update_intro textarea{
    width:540px;
    height:200px;
    border:1px solid #ddd;
    border-radius: 2px;
    resize: none;
    padding:5px;
    font-size:14px;
  }
  .update_type select{
    margin-top:10px;
    width:70px;
    height:35px;
  }
  .update_save, .update_close{
    display: inline-block;
    width:60px;
    height:30px;
    line-height:30px;
    color: #fff;
    text-align: center;
    background-color: #F37B1D;
    cursor: pointer;
    border-radius:3px;
    font-weight: normal !important;
    float: right;
    margin-right:50px;
    margin-top: 10px;
  }
  .update_save{
    background-color: #31C5D2 !important;
  }
  .edit_icon{
    display: inline-block;
    font-style: normal;
  }
  .edit_icon img{
    width:11px;
  }
</style>
<div class="table_view">
  <div class="table_view_info">
    <div class="table_view_title">
      <span>小书集合</span>
    </div>
    <div>
      <table width="900px;" border="0" cellpadding="0" cellspacing="0">
        <tr style="font-weight: bold;text-align: center;">
          <td style="width:35px;">序号</td>
          <td style="width:160px;">名称</td>
          <td style="width:180px;">描述</td>
          <td style="width:60px;">封面</td>
          <td style="width:50px;">出处</td>
          <td style="width:50px;">分类</td>
          <td style="width:70px;">操作</td>
          <td style="width:60px;">更新简介</td>
          <td style="width:60px;">慎重操作</td>
        </tr>
        <script type="text/template" id="table_tpl">
          <% _.each(objs, function (item, i) { %>
            <tr>
              <td><%=(parseInt(i) + 1)%></td>
              <td><%=item.bookname%></td>
              <td><%=item.bookdesc%></td>
              <td>
              <% if(item.bookimg){%>
                <div class="table_re_upload" book_id="<%=item.bookid%>">
                  <i class="edit_icon">
                    <img src="/images/site/redo.png"/>
                  </i>
                  <span>重新上传</span>
                </div>
              <%}else{%>
                <div class="table_upload" book_id="<%=item.bookid%>">
                  <i class="edit_icon">
                    <img src="/images/site/upload.png"/>
                  </i>
                  <span>上传</span>
                </div>
              <%}%>
              </td>
              <td style="text-align: center;">
                <%if(parseInt(item.repost)){%>
                <div style="color: #E7505A;">转载</div>
                <%}else{%>
                <div>原创</div>
                <%}%>
              </td>
              <td>
                <%=item.type%>
              </td>
              <td>
                <% if(parseInt(item.ispost)){%>
                <div class="fl table_delete table_delete_btn" book_id="<%=item.bookid%>">
                  <i class="edit_icon">
                    <img src="/images/site/cancel.png"/>
                  </i>
                  <span>取消公开</span>
                </div>
                <%}else{%>
                <div class="fl table_post table_post_btn" book_id="<%=item.bookid%>">
                  <i class="edit_icon">
                    <img src="/images/site/post.png"/>
                  </i>
                  <span>发布</span>
                </div>
                <%}%>
              </td>
              <td>
                <div class="update_btn" book_id="<%=item.bookid%>" book_name="<%=item.bookname%>">
                  <i class="edit_icon">
                    <img src="/images/site/pen.png"/>
                  </i>
                  <span>编辑</span>
                </div>
              </td>
              <td>
                  <div class="delete_btn" book_id="<%=item.bookid%>" book_name="<%=item.bookname%>">
                    <i class="edit_icon">
                      <img src="/images/site/delete_red.png"/>
                    </i>
                    <span>删除</span>
                  </div>
              </td>
            </tr>
          <%});%>
        </script>
      </table>
      <div id="loading_view" style="margin-top:100px;">
        <?php include(dirname(__FILE__).'./../loading.php');?>
      </div>
      <div style="height:40px;"></div>
    </div>
    <div class="mask"></div>
  </div>
  <div class="fl table_view_create"></div>
  <!--询问是否删除-->
  <div class="is_sure_delete">
    <div>
      <input id="book_name" placeholder="请输入你要删除的小书名称"/>
    </div>
    <div class="sure_delete_btn">
      <div class="fl sure_delete_btn_ok">确定删除</div>
      <div class="fr sure_delete_btn_cancel" style="background-color: #025CE8;">关闭</div>
    </div>
  </div>
  <!---修改图书简介-->
  <div class="update_frame">
    <div style="text-align: center;margin-top:10px;color: #025BE6;font-weight:bold;">修改小书摘要信息</div>
    <div class="update_book_name">
      <span>书名</span>
      <input id="update_bookname"/>
    </div>
    <div class="update_intro">
      <div>简介</div>
      <div>
        <textarea id="update_book_desc"></textarea>
      </div>
    </div>
    <div class="update_type">
      <span>分类</span>
      <select id="type">
        <option>前端</option>
        <option>后端</option>
        <option>前端</option>
        <option>iOS</option>
        <option>Android</option>
        <option>运维</option>
        <option>移动端</option>
      </select>
      <span style="display:inline-block;margin-left:20px;">出处</span>
      <select id="repost">
        <option>原创</option>
        <option>转载</option>
      </select>
      <span class="update_close">关闭</span>
      <span class="update_save">保存</span>
    </div>
  </div>
</div>
<script type="text/javascript" src="/js/underscore-min.js"></script>
<script type="text/javascript">
  //获取数据
  var objs = [];
  var book_name = '';
  var bookid = '';
  //获取新数据
  var bookname = $('#update_bookname');
  var bookdesc = $('#update_book_desc');
  var type = $('#type');
  var repost = $('#repost');
  $.get('/api/book/get.php', function (data) {
    if(data.status){
      objs = data.data;
      $('.table_view_info table').append((_.template($('#table_tpl').html(), objs)()));
      $('#loading_view').css('display', 'none');
      //暂时做法
      //上传或者重新上传封面
      $('.table_re_upload').on('click', function () {
        var bookid = $(this).attr('book_id');
        window.location = '/console/edit.php?book_id=' + bookid;
      });
      $('.table_upload').on('click', function () {
        var bookid = $(this).attr('book_id');
        window.location = '/console/edit.php?book_id=' + bookid;
      });

      //发布小书
      $('.table_post_btn').on('click', function () {
        var bookid = $(this).attr('book_id');
        var obj =  {
          bookid: bookid
        };
        $.post('/api/book/post.php',  obj, function (data) {
          if(data.status){
            var infoWindow = new Alert('恭喜你', '发布小书成功', function () {
              location.reload();
            });
            infoWindow.show();
          }else{
            var infoWindow = new Alert('提示', data.info);
            infoWindow.show();
          }
        });
      });

      //隐藏小书
      $('.table_delete_btn').on('click', function () {
        var bookid = $(this).attr('book_id');
        var obj =  {
          bookid: bookid
        };
        $.post('/api/book/private.php',  obj, function (data) {
          if(data.status){
            var infoWindow = new Alert('提示', '您隐藏该本小书', function () {
              location.reload();
            });
            infoWindow.show();
          }else{
            var infoWindow = new Alert('提示', data.info);
            infoWindow.show();
          }
        });
      });
      
      //删除动作
      $('.delete_btn').on('click', function () {
        //缓存书名
        book_name = $(this).attr('book_name');
        bookid = $(this).attr('book_id');
        //弹出坦弹层
        $('#book_name').val('');
        $('.is_sure_delete').css('display', 'block');
        $('.mask').css('display', 'block');
      });
      
      //更新数据操作
      $('.update_btn').on('click', function () {
        bookid = $(this).attr('book_id')
        $('.update_frame').css('display', 'block');
        $('.mask').css('display', 'block');

        $.get('/api/book/getone.php?book_id=' + bookid, function (data) {
          if(data.status){
            //还原数据
            bookname.val(data.data.bookname);
            bookdesc.val(data.data.bookdesc);
            type.find('option:selected').text(data.data.type);
            if(parseInt(data.data.repost)){
              repost.find('option:selected').text('转载');
            }else{
              repost.find('option:selected').text('原创');
            }

          }else{
            var infoWindow = new Alert('提示', '服务或者网络出现问题，无法获取图书数据');
            infoWindow.show();
          }
        });
      });
    }
  });

  //删除小书
  $('.sure_delete_btn_ok').on('click', function () {
    var book_name2 =  $('#book_name').val();
    if(book_name == book_name2){
      $.get('/api/book/delete.php?bookid=' + bookid, function (data) {
        if(data.status){
          $('.is_sure_delete').css('display', 'none');
          $('.mask').css('display', 'none');
          var infoWindow = new Alert('提示', '您已删除了该本小书', function () {
            location.reload();
          });
          infoWindow.show();
        }else{
          var infoWindow = new Alert('提示', '服务出现异常，删除失败，请稍后再试');
          infoWindow.show();
        }
      });
    }else{
      var infoWindow = new Alert('提示', '您输入的书名有误');
      infoWindow.show();
    }
  });

  //更新简介数据
  $('.update_save').on('click', function () {
    var repost_value = repost.find('option:selected').text();
    if(repost_value == '转载'){
      repost_value = 1;
    }else{
      repost_value = 0;
    }
    var obj = {
      bookid: bookid,
      bookname: bookname.val(),
      bookdesc: bookdesc.val(),
      type: type.find('option:selected').text(),
      repost: repost_value
    };
    //更新数据
    $.post('/api/book/update.php', obj, function (data) {
      if(data.status){
        var infoWindow = new Alert('提示', '更新小书简介成功', function () {
          location.reload();
        });
        infoWindow.show();
      }else{
        var infoWindow = new Alert('提示', data.info);
        infoWindow.show();
      }
    });

  });

  $('.sure_delete_btn_cancel').on('click', function () {
    $('.is_sure_delete').css('display', 'none');
    $('.mask').css('display', 'none');
  });

  $('.update_close').on('click', function () {
    $('.update_frame').css('display', 'none');
    $('.mask').css('display', 'none');
  });


</script>