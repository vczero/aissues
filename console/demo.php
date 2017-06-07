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
      background-color:#fff;
      position: absolute;
      left:175px;
      right:0;
      top:1px;
      bottom:0;
    }
    .cook_book_right{
      background-color: #fff;
      min-height: 400px;
      padding-left:50px;
    }
    .cook_book_demo_view{
      padding-top:30px;
    }
    .cook_book_demo_item{
      line-height:90px;
      height:90px;
      width:90px;
      border-radius:90px;
      border:1px solid #fff;
      display: inline-block;
      text-align: center;
      color:#fff;
      cursor: pointer;
    }
    .cook_book_demo_arr{
      display: inline-block;
      width:50px;
      border-top:1px solid #ECECEC;
    }
    .cook_book_demo_title{
      margin-bottom:30px;
      font-size:14px;
      color:#000;
    }
    .cook_book_right>div{
      display: none;
    }
    .cook_book_demo_tips{
      margin-top:30px;
    }
    .cook_book_demo_tips>div{
      margin-bottom: 10px;
    }
    .cook_book_demo_tips ul{
      color: #424242;
      line-height:20px;
      font-size:13px;
    }
  </style>
</head>
<body>
<?php require_once('../ui/console/header.php');?>
<div class="main_view">
  <?php require_once('../ui/console/menu.php')?>
  <div class="main_right fl">
    <div class="cook_book_right">
      <div class="cook_book_demo_view" style="display: block;">
        <div class="cook_book_demo_title">可以按照如下流程编写一本小书</div>
        <a class="cook_book_demo_item" style="background-color: #5E656D;">创建书名</a>
        <a class="cook_book_demo_arr"></a>
        <a class="cook_book_demo_item" style="background-color: #FFB754;">编写小书</a>
        <a class="cook_book_demo_arr"></a>
        <a class="cook_book_demo_item" style="background-color: #1CBF54;">保存编辑</a>
        <a class="cook_book_demo_arr"></a>
        <a class="cook_book_demo_item" style="background-color: #566AC4;">上传封面</a>
        <a class="cook_book_demo_arr"></a>
        <a class="cook_book_demo_item" style="background-color: #FF657F;">发布小书</a>
        <div class="cook_book_demo_tips">
          <div>做一件有意义的事儿</div>
          <ul>
            <li>这个时代，知识应该得到充分的分享；每个人都可以【著书立说】，分享自己的经验；</li>
            <li>知识不应该碎片化，系统化知识结构才能得到更多的抽象和领悟；</li>
            <li>每一本浸透心血的小书值得被推荐，值得去推荐出版；</li>
            <li>分享，学习，从这里开始.....</li>
          </ul>
        </div>
      </div>

  </div>
</div>
</div>
<?php include_once('../ui/cnzz.php');?>
</body>
</html>
