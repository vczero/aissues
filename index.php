<!DOCTYPE html>
<html lang="ch">
<head>
  <?php include('./ui/meta.php') ?>
  <style type="text/css">
    body{
      background-color: #fff;
    }
    a{
      text-decoration: none;
      color: #2E2E2E;
    }
    .main{
      width:1160px;
      margin-left:auto;
      margin-right: auto;
      padding-top:50px;
    }
    .books{
      height:500px;
      width:1150px;
    }
    .books_re{
      width:820px;
      height:500px;
      background-color:#fff;
      margin-top:10px;
      border:1px solid #E9E9E9;
      box-shadow: 2px 2px 2px #ddd;
    }
    .books_new{
      width:320px;
      height:500px;
      background-color:#fff;
      margin-top:10px;
      border:1px solid #E9E9E9;
      border-radius:3px;
      box-shadow: 2px 2px 2px #ddd;
    }
    .books_fe, .books_be,.books_ios,.books_android,.books_mobile,.books_ops{
      width: 1150px;
      margin-top:15px;
      height:285px;
      background-color:#fff;
      border:1px solid #E9E9E9;
      border-radius:2px;
    }
    .book_item{
      height:225px;
      width:150px;
      margin-top:20px;
      margin-left:12px;
      float: left;
    }
    .book_item img{
      width:150px;
      height:200px;
      box-shadow: 2px 2px 2px #ddd;
    }
    .book_item_title{
      text-align: center;
      line-height:25px;
      color:#373737;
    }
    .news{
      width:1155px;
      margin-top:30px;
      background-color:#fff;
    }
    .type_tag{
      font-size:12px;
      position: relative;
      height:30px;width:55px;text-align: center;line-height:30px;color:#fff;
      background-color:#2C85FF;
    }
    .books_be, .books_ios{
      display:none;
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
  <script type="text/javascript" src="/js/underscore-min.js"></script>
  <div class="main">
    <?php require_once('./ui/index/banner.php');?>
    <!--集中推荐图书-->
    <div class="books">
      <div class="fl books_new">
        <?php include_once('./ui/index/new_books.php');?>
      </div>
      <div class="fr books_re">
        <?php include_once('./ui/index/book_recommend.php');?>
      </div>
    </div>
    <div class="news">
      <?php include_once('./ui/index/news.php');?>
    </div>
    <!--分类展示-->
    <!--前端小书展示-->
    <div class="books_fe">
      <?php include_once('./ui/index/book_fe.php');?>
    </div>
    <div class="books_be">
      <?php include_once('./ui/index/book_be.php');?>
    </div>
    <div class="books_ios">
      <?php include_once('./ui/index/book_ios.php');?>
    </div>
    <div class="books_android">
      <?php include_once('./ui/index/book_android.php');?>
    </div>
    <div class="books_mobile">
      <?php include_once('./ui/index/book_mobile.php');?>
    </div>
    <div class="books_ops">
      <?php include_once('./ui/index/book_ops.php');?>
    </div>
    <?php include_once('./ui/footer.php');?>
  </div>
  <?php include_once('./ui/cnzz.php');?>
</body>
</html>