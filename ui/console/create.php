<?php
session_start();
//没有登录直接重定向
if(!$_SESSION['_userid']){
  header('Location: /');
}
?>
<style type="text/css" rel="stylesheet">
  .book_create_fm_title{
    margin-top:50px;
    color: #E7505A;

    font-size:15px;
    font-weight: bold;
    border-left:8px solid #E7505A;
    padding-left:10px;
    height:40px;
    line-height:40px;
    border-bottom:1px solid #ddd;
    width:800px;
  }
  .book_create_fm{
    margin-left:25px;
  }
  .book_create_fm input{
    width:450px;
    height:35px;
    border:1px solid #ddd;
    padding-left:5px;
    font-size:14px;
    border-radius:3px;
  }

  .book_create_fm textarea{
    border:1px solid #ddd;
    width:450px;
    height:180px;
    font-size:14px;
    padding:5px;
    border-radius:3px;
    resize: none;
  }
  .book_create_fm_item{
    margin-top:20px;
  }
  .book_create_fm_item span{
    display: inline-block;
    width:40px;
    vertical-align: top;
  }

  .book_create_fm_btn{
    width:100%;
    height: 60px;
  }
  .book_create_fm_btn>div{
    width:300px;
    height:35px;
    line-height:35px;
    background-color: #E7505A;
    text-align: center;
    color: #fff;
    border-radius:1px;
    cursor: pointer;
  }
  select{
    width:70px;
    height:35px;
  }
  .repost_view>div{
    display: inline-block;
    width:40px;
    height:30px;
    text-align: center;
    line-height:30px;
    margin-top:20px;
    cursor: pointer;
    position: relative;
    top:-50px;
    left:180px;
  }
  .repost_0{
    background-color: #36C6D3;
    color: #fff;
    border:1px solid #36C6D3 ;
    border-radius:2px;
  }
  .repost_1{
    background-color: #fff;
    margin-left:-6px;
    border:1px solid #ddd;
    border-left:0;
  }


</style>
<div class="book_create_fm">
  <div class="book_create_fm_title">给小书起一个优美的名字。</div>
  <div class="book_create_fm_item">
    <span>书名</span>
    <span>
      <input id="book_name" placeholder="请输入书名" maxlength="100"/>
    </span>
  </div>
  <div class="book_create_fm_item">
    <span>摘要</span>
    <span>
      <textarea id="book_desc" placeholder="介绍你的图书，200字以内"></textarea>
    </span>
  </div>
  <div class="book_create_fm_item">
    <span>分类</span>
    <select id="type">
      <option>前端</option>
      <option>后端</option>
      <option>iOS</option>
      <option>Android</option>
      <option>运维</option>
      <option>移动端</option>
    </select>
  </div>
  <div class="repost_view">
    <div class="repost_0">原创</div>
    <div class="repost_1">转载</div>
  </div>
  <div class="book_create_fm_btn">
    <div>创建小书</div>
  </div>
</div>

<script type="text/javascript">
  var repost = 0;
  var repost_0 = $('.repost_0');
  var repost_1 = $('.repost_1');
  //原创
  repost_0.on('click', function () {
    repost = 0;
    repost_0.css('background-color', '#36C6D3');
    repost_0.css('color', '#FFF');
    repost_0.css('border', '1px solid #36C6D3');

    repost_1.css('background-color', '#fff');
    repost_1.css('color', '#000');
    repost_1.css('border', '1px solid #ddd');
  });

  //转载
  repost_1.on('click', function () {
    repost = 1;
    repost_1.css('background-color', '#36C6D3');
    repost_1.css('color', '#FFF');
    repost_1.css('border', '1px solid #36C6D3');

    repost_0.css('background-color', '#fff');
    repost_0.css('color', '#000');
    repost_0.css('border', '1px solid #ddd');
  });

  $('.book_create_fm_btn').on('click', function () {
    var selectText = $('#type').find('option:selected').text();
    var obj = {
      bookname: $('#book_name').val(),
      bookdesc: $('#book_desc').val(),
      type: selectText,
      repost: repost
    };

    console.log(obj);
    $.post('/api/book/create.php', obj, function (data) {
      if(data.status){
        var infoWindow = new Alert('提示', data.info, function () {
          location.reload();
        });
        infoWindow.show();

      }else{
        var infoWindow = new Alert('提示', data.info);
        infoWindow.show();
      }
    });
  });


</script>

